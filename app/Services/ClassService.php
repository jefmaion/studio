<?php

namespace App\Services;

use App\Models\Classes;
use App\Models\Transaction;

class ClassService extends Service {

    private $student;

    public function __construct(StudentService $student)
    {
        $this->student = $student;
    }

    public function findClass($id) {
        return Classes::with(['student.user', 'instructor', 'registration', 'modality', 'parent'])->find($id);
    }

    public function listClasses() {
        return Classes::with(['student.user', 'registration', 'modality'])->get();
    }

    public function createTrialClass($data) {

        // dd($data);

        if(empty($data['student']['student_id'])) {
            $student = $this->student->storeNewStudent($data['student']);
            $studentId = $student->id;
        } else {
            $studentId = $data['student']['student_id'];
        }
    
        $data['class']['scheduled_instructor_id'] = $data['class']['instructor_id'];
        $data['class']['student_id']  = $studentId;
        $data['class']['weekday'] = date('w', strtotime($data['class']['date']));


        if(isset($data['transaction']['value'])) {

            $data['transaction']['value'] = currency($data['transaction']['value'], true);

            Transaction::create([
                'date' => $data['class']['date'],
                'type' => 'R',
                'value' => $data['transaction']['value'],
                'amount' => $data['transaction']['value'],
                'status' => 0,
                'description' => 'Aula Exp. ' . $data['student']['name'],
    
                'payment_method_id' => $data['transaction']['payment_method_id'],
                'student_id' => $studentId
            ]);
        }
        
     

        return Classes::create($data['class']);
       
    }

    public function update($class, $data) {

        $class = Classes::find($class);
        // $data['instructor_id'] = auth()->user()->instructor->id;

        return $class->fill($data)->save();

    }

    public function listNotRemarkableClasses() {
        return Classes::with('student.user', 'modality')->where('type', 'AN')->where('status', 2)->where('has_replacement', 0)->get();
    }

    public function listToDatatable() {
        $data = Classes::with(['student.user', 'instructor.user', 'registration', 'modality'])->get();

        $response = [];
        foreach($data as $item) {
            $response[] = [
                'id' => $item->id,
                'date' => '<a href="'.route('class.edit', $item).'">'. $item->date->format('d/m/Y').'</a>',
                'time' => $item->time,
                'student' => $item->student->user->shortName,
                'instructor' => $item->instructor->user->shortName,
                'modality' => $item->modality->name,
                'type' => $item->typeText,
                'status' => $item->situation
            ];
        }


        return json_encode(['data' => $response]);
    }

    public function listToCalendar($params) {

        $bgClassStatus = [
            0 => 'bg-primary',
            1 => 'bg-green',
            2 => 'bg-warning',
            3 => 'bg-red'
        ];

        $start = $params['start'];
        $end = $params['end'];

        $calendar = [];
        $rs     = Classes::with(['student.user', 'registration', 'modality'])->whereBetween('date', [$start, $end]);


        $params = array_diff_key($params, array_flip(['_', 'start', 'end']));

        foreach ($params as $key => $value) {
            if ($value == "") continue;
            $key = ltrim($key, $key[0]);
            $rs->where($key, $value);
        }


        $data = $rs->get();
        $iconPendency =  '<i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i> ';

        foreach($data as $item) {

            $icon = '';

            if($item->student->OverdueInstallments->count()) {
                $icon = $iconPendency;
            }

            if($item->pendencies()) {
                $icon = $iconPendency;
            }

    
            // @foreach( $class->pendencies() as $pendecy)
            // <span class="badge badge-pill badge-primary"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>  {{ $pendecy }}</span> 
            // @endforeach



            $title = '<div class="mb-0">'.$icon.'<b>' . date('H\h', strtotime($item->time)) .' '.  $item->student->user->firstName . '</b></div>';
            $title .= $item->modality->acronym;
            $title .= ' • ' . $item->type;

            $calendar[] = [
                'id' => $item->id,
                'title' =>  $title,
                'start'     => $item->date->format('Y-m-d') .  'T' . $item->time,
                'end'       => $item->date->format('Y-m-d') .  'T' . date('H:i', strtotime($item->time . '+1 hour')),
                'className' => ['bg-'.$item->bgColor],

                'raw' => [
                    'id' => $item->id,
                    'title' =>  $item->student->user->shortName. '|' .$item->modality->acronym,
                    'start'     => $item->date->format('Y-m-d') .  'T' . $item->time,
                    'end'       => $item->date->format('Y-m-d') .  'T' . date('H:i', strtotime($item->time . '+1 hour')),
                    'type' => $item->type,
                    'className' =>['fc-event-remark', 'bg-light']
                ]
            ];
        }

        

        return response()->json($calendar);
    }

}