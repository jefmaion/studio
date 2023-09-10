<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Instructor;
use App\Models\Modality;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Services\ClassService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
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
            return $this->classes->listToCalendar($request->input('start'), $request->input('end'));
        }

        return view('calendar.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $class = $this->classes->findClass($id);

        // dd($class->pendecies);

        // dd($class->finished);

        return view('calendar.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $class = Classes::find($id);
        
        $view = $request->input('action');

        if($view == 'presence') {
            
            $data = [
                'title'  => 'Marcar Presença',
                'status' => 1
            ];
        }

        if($view == 'absense') {
            $data = [
                'title'  => 'Marcar Falta',
                'status' => 2
            ];
        }


        return view('calendar.'.$view, compact('class', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function context($data) {

        $data =  Carbon::parse($data);
        return view('calendar.context', compact('data'));
    }

    public function remark($data) {

        $data = explode(' ', $data);
        $classes = $this->classes->listNotRemarkableClasses()->toArray();
        $classes = array_map(function($item) {
            return [$item['id'], date('d/m/Y', strtotime($item['date'])) . ' - ' . $item['student']['user']['name']. ' - ' .$item['modality']['acronym']];

        }, $classes);
        


        $instructors = Instructor::with('user')->get()->toArray();
        
        $instructors = array_map(function($item) {
            return [$item['id'], $item['user']['name']];
        }, $instructors);  

        return view('calendar.remark', compact('data', 'classes', 'instructors'));
    }

    public function trial($data) {
        $data = explode(' ', $data);

        $instructors = Instructor::with('user')->get()->toArray();
        
        $instructors = array_map(function($item) {
            return [$item['id'], $item['user']['name']];
        }, $instructors);  


        $modalities = Modality::get()->toArray();
        $modalities = array_map(function($item) {
            return [$item['id'], $item['name']];
        }, $modalities);  

        $payments = PaymentMethod::get()->toArray();
        $payments = array_map(function($item) {
            return [$item['id'], $item['name']];
        }, $payments); 

        return view('calendar.trial', compact('data', 'payments', 'modalities', 'instructors'));
    }


    private function listToCalendar($data) {

        $bgClassStatus = [
            0 => 'bg-primary',
            1 => 'bg-green',
            2 => 'bg-warning',
            3 => 'bg-red'
        ];

        $calendar = [];
        $raw = [];

        foreach($data as $item) {


            $title = '<div class="mb-0"><b>' .  $item->student->user->shortName . '</b></div>';
            $title .= $item->modality->acronym;
            $title .= ' • ' . $item->type;

            $calendar[] = [
                'id' => $item->id,
                'title' =>  $title,
                'start'     => $item->date->format('Y-m-d') .  'T' . $item->time,
                'end'       => $item->date->format('Y-m-d') .  'T' . date('H:i', strtotime($item->time . '+1 hour')),
                'className' => ['bg-'.$item->bgColor],
            ];
        }

        

        return response()->json($calendar);
    }
}
