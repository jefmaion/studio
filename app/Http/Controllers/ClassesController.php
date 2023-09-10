<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Models\Instructor;
use App\Models\Modality;
use App\Models\Student;
use App\Services\ClassService;
use Illuminate\Http\Request;

class ClassesController extends Controller
{

    private $classes;

    public function __construct(ClassService $classService)
    {
        $this->classes = $classService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            return $this->classes->listToDataTable();
        }

        return view('classes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClassesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassesRequest $request)
    {
        return $this->classes->createTrialClass($request->except(['_method', '_token']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class = $this->classes->findClass($id);

        return view('classes.show', 'class');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $modalities = Modality::get()->toArray();
        $modalities = array_map(function($item) {
            return [$item['id'], $item['name']];
        }, $modalities);  

        $instructors = Instructor::with('user')->get()->toArray();
        
        $instructors = array_map(function($item) {
            return [$item['id'], $item['user']['name']];
        }, $instructors); 
        
        $students = Student::with('user')->get()->toArray();
        $students = array_map(function($item) {
            return [$item['id'], $item['user']['name']];
        }, $students); 

        $class = $this->classes->findClass($id);

        return view('classes.edit', compact('class', 'instructors', 'modalities', 'students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassesRequest  $request
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update($class, UpdateClassesRequest $request)
    {

        $update = $this->classes->update($class, $request->except(['_method', '_token']));

        if($request->ajax()) {
            return $update;
        }

        return redirect()->route('class.index', $class)->with('success','Aula atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $classes)
    {
        //
    }


    public function remark(Request $request) {
        $data = $request->except(['_method', '_token']);

        $class = $this->classes->findClass($data['class_id']);
        $new   = $class->replicate();

        $class->has_replacement = 1;

        $new->date                    = $data['date'];
        $new->time                    = $data['time'];
        $new->instructor_id           = $data['instructor_id'];
        $new->scheduled_instructor_id = $new->instructor_id;
        $new->type                    = 'RP';
        $new->status                  = 0;
        $new->finished                = 0;
        $new->absense_comments        = null;
        $new->classes_id              = $class->id;


        $new->save();
        return $class->save();




        
    }


}
