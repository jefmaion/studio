<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\User;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    private $student;

    public function __construct(StudentService $studentService)
    {
        $this->student = $studentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()) {
            return $this->student->listToDataTable();
        }

        return view('student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create', ['user' => new User()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        if($student = $this->student->storeNewStudent($request->except(['_token']))) {
            return redirect()->route('student.show', $student)->with('success','Aluno cadastrado com sucesso!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if(!$student = $this->student->findStudent($id)) {
            return redirect()->route('student.index')->with('warning','Aluno não encontrado!');
        }
        
        return view('student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if(!$student = $this->student->findStudent($id)) {
            return redirect()->route('student.index')->with('warning','Aluno não encontrado!');
        }

        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, $id)
    {

        if(!$student = $this->student->findStudent($id)) {
            return redirect()->route('student.index')->with('warning','Aluno não encontrado!');
        }

        if($this->student->updateStudent($student, $request->except(['_method', '_token']))) {
            return redirect()->route('student.show', $student)->with('success','Aluno atualizado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(!$student = $this->student->findStudent($id)) {
            return redirect()->route('student.index')->with('warning','Aluno não encontrado!');
        }

        if($this->student->deleteStudent($student)) {
            return redirect()->route('student.index')->with('success','Aluno excluido com sucesso!');
        }
    }
}
