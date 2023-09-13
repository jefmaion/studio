<?php

namespace App\Services;

use App\Models\Classes;
use App\Models\Registration;
use App\Models\Student;
use App\Models\Transaction;
use Carbon\Carbon;

class RegistrationService extends Service {



    public function createRegistration(Student $student, $data) {

        $student = $student->with('user')->find($student->id);

        $classes            = [];
        $data['end']        = date('Y-m-d', strtotime($data['start'] .  ' +'.$data['duration'].' months'));
        $data['student_id'] = $student->id;
        $data['description'] = date('m/Y', strtotime($data['start']));

        if(isset($data['class'])) {
            $classes = $data['class'];
            unset($data['class']);
        }

        $paymentMethod = 1;
        if(isset($data['first_payment_method_id'])) {
            $paymentMethod = $data['first_payment_method_id'];
            unset($data['first_payment_method_id']);
        }
        

        $data['weekclasses'] = json_encode($classes);

        


        $registration = Registration::create($data);

        $dueDate = date('Y-m-'.$data['due_day']);

        for($i=1; $i<=$data['duration'];$i++) {

            if($i > 1 && isset($data['other_payment_method_id'])) {
                $paymentMethod = $data['other_payment_method_id'];
            }

            Transaction::create([
                'date' => $dueDate,
                'type' => 'R',
                'value' => $data['value'],
                'amount' => $data['value'],
                'status' => 0,
                'description' => 'Mensalidade ' . $student->user->shortName,
    
                'payment_method_id' => $paymentMethod,
                'student_id' => $student->id,
                'registration_id' => $registration->id,
            ]);

            $dueDate = date('Y-m-d', strtotime($dueDate . ' + 1 months'));
        }

        


        $cls = [];

        foreach($classes as $item) {

         

            $startDate = (date('w', strtotime($data['start'])) == $item['weekday']) ? Carbon::parse($data['start']) :  Carbon::parse($data['start'])->next((int) $item['weekday']); // Get the first friday.
            $endDate   = Carbon::parse($data['end']);

            $numClasses = 0;
            for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {

                $status = ($date < date('Y-m-d')) ?  rand(1,3) : 0;
                $finished = ($date < date('Y-m-d')) ?  1 : 0;
                $evol = '';

                if($status == 1 && $finished == 1) {
                    $evol = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
                }

                $cls[] = [
                        'registration_id'         => $registration->id,
                        'student_id'              => $student->id,
                        'modality_id'             => $data['modality_id'],
                        'instructor_id'           => $item['instructor_id'],
                        'scheduled_instructor_id' => $item['instructor_id'],
                        'type'                    => 'AN',
                        'date'                    => $date->format('Y-m-d'),
                        'time'                    => $item['time'],

                        'weekday'                 => $item['weekday'],
                        'status' => $status,
                        'finished' => $finished,
                        'evolution' => $evol
                ];
            }
        }


        foreach($cls as $i => $class) {
            $class['value'] = $data['value'] / count($cls);
            Classes::create($class);
        }

        return $registration;

    }

    public function cancelRegistration(Registration $registration, $data) {
        $registration->classes()->where('finished', 0)->delete();

        return $registration->delete();
    }

    
}