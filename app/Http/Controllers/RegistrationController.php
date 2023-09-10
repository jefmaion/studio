<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Requests\UpdateRegistrationRequest;
use App\Models\Instructor;
use App\Models\Modality;
use App\Models\PaymentMethod;
use App\Models\Student;
use App\Services\RegistrationService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    private $registration;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registration = $registrationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Student $student)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Student $student)
    {

        
        $modalities = Modality::get()->toArray();
        $modalities = array_map(function($item) {
            return [$item['id'], $item['name']];
        }, $modalities);  

        $payments = PaymentMethod::get()->toArray();
        $payments = array_map(function($item) {
            return [$item['id'], $item['name']];
        }, $payments);  

        $instructors = Instructor::with('user')->get()->toArray();
        
        $instructors = array_map(function($item) {
            return [$item['id'], $item['user']['name']];
        }, $instructors);  

        $registration = new Registration();
        $registration->start = date('Y-m-d');

        return view('registration.create', compact('student', 'modalities', 'payments', 'instructors', 'registration'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRegistrationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Student $student, StoreRegistrationRequest $request)
    {
        $data = $request->except(['_method', '_token']);
        
        if($this->registration->createRegistration($student, $data)) {
            return redirect()->route('student.show', $student)->with('success','Matrícula realizada com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student, Registration $registration)
    {
        $modalities = Modality::get()->toArray();
        $modalities = array_map(function($item) {
            return [$item['id'], $item['name']];
        }, $modalities);  

        $payments = PaymentMethod::get()->toArray();
        $payments = array_map(function($item) {
            return [$item['id'], $item['name']];
        }, $payments);  

        $instructors = Instructor::with('user')->get()->toArray();
        
        $instructors = array_map(function($item) {
            return [$item['id'], $item['user']['name']];
        }, $instructors);  


        $registration->weekclasses = (array) json_decode($registration->weekclasses);


        $registration->start = $registration->getLastClass()->addWeeks(1);

        return view('registration.renew', compact('student', 'modalities', 'payments', 'instructors', 'registration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegistrationRequest  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegistrationRequest $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student, Registration $registration, Request $request)
    {
        $this->registration->cancelRegistration($registration, $request->except(['_token', '_method']));
        return redirect()->route('student.show', $student)->with('success','Matrícula cancelada com sucesso!');
        
    }
}
