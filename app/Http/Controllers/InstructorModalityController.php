<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructorModalityRequest;
use App\Models\Instructor;
use App\Models\Modality;
use App\Services\InstructorService;
use Illuminate\Http\Request;

class InstructorModalityController extends Controller
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
    public function index(Instructor $instructor)
    {

        $modalities = Modality::get()->toArray();

        $modalities = array_map(function($item) {
            return [$item['id'], $item['name']];
        }, $modalities);       

        return view('instructor.modality.index', compact('instructor', 'modalities'));
    }

    public function create(Instructor $instructor) {

        $modalities = Modality::get()->toArray();

        $modalities = array_map(function($item) {
            return [$item['id'], $item['name']];
        }, $modalities);       


        return view('instructor.modality.form',compact('instructor', 'modalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Instructor $instructor, StoreInstructorModalityRequest $request)
    {
        $data = $request->except(['_method']);

        $this->instructor->addModality($instructor, $data);
        return redirect()->route('instructor.modality.index', $instructor)->with('success', 'Modalidade atribuída com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor, $id)
    {
        $this->instructor->removeModality($instructor, $id);
        return redirect()->route('instructor.modality.index', $instructor)->with('success', 'Modalidade removida com sucesso');
    }
}
