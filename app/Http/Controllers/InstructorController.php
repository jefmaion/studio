<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use App\Models\User;
use App\Services\InstructorService;
use Illuminate\Http\Request;

class InstructorController extends Controller
{

    private $instructor;

    public function __construct(InstructorService $instructorService)
    {
        $this->instructor = $instructorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if($request->ajax()) {
            return $this->instructor->listToDataTable();
        }

        return view('instructor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instructor.create', ['user' => new User()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInstructorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInstructorRequest $request)
    {
        if($instructor = $this->instructor->storeNewinstructor($request->except(['_token']))) {
            return redirect()->route('instructor.show', $instructor)->with('success','Professor cadastrado com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if(!$instructor = $this->instructor->findInstructor($id)) {
            return redirect()->route('instructor.index')->with('warning','Professor não encontrado!');
        }

        return view('instructor.show', compact('instructor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if(!$instructor = $this->instructor->findInstructor($id)) {
            return redirect()->route('instructor.index')->with('warning','Professor não encontrado!');
        }

        return view('instructor.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInstructorRequest  $request
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInstructorRequest $request, $id)
    {
        if(!$instructor = $this->instructor->findInstructor($id)) {
            return redirect()->route('instructor.index')->with('warning','Professor não encontrado!');
        }

        if($this->instructor->updateInstructor($instructor, $request->except(['_method', '_token']))) {
            return redirect()->route('instructor.show', $instructor)->with('success','Professor atualizado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(!$instructor = $this->instructor->findInstructor($id)) {
            return redirect()->route('instructor.index')->with('warning','Professor não encontrado!');
        }

        if($this->instructor->deleteInstructor($instructor)) {
            return redirect()->route('instructor.index')->with('success','Professor excluido com sucesso!');
        }
    }
}
