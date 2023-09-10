<?php

namespace App\Services;

use App\Models\Student;
use App\Models\User;

class StudentService extends Service {


    public function findStudent($id) {
        return Student::with('user', 'classes.modality', 'classes.instructor', 'registrations.modality', 'installments.method')->find($id);
        
    }

    public function storeNewStudent(array $studentData) {

        if(!$user = User::create($studentData)) {
            return false;
        }

        if(empty($data['nickname'])) {
            $name = explode(" ", $studentData['name']);
            $studentData['nickname'] =  $name[0] .' '.end($name);
        }

        $student = new Student();
        $student->fill($studentData)->user()->associate($user)->save();

        return $student;

    }

    public function updateStudent(Student $student, $data) {
        $student->fill($data)->save();
        return $student->user->fill($data)->save();
    }

    public function deleteStudent(Student $student) {

        $user = $student->user;

        $student->delete();
        $user->delete();

        return true;
    }

    public function listToDataTable() {

        $response = [];
        $data = Student::with(['user', 'registrations.modality'])->orderBy('created_at', 'desc')->get();

        foreach($data as $item) {

            

            $badge = '<span class="badge badge-pill badge-%s">%s</span>';

           

            $response[] = [
                'id' => $item->id,
                'name' => '<img alt="image" src="http://127.0.0.1:8000/template/assets/img/users/user-3.png" class="rounded-circle mr-2" width="35"><a href="'.route('student.show', $item).'">'. $item->user->name.'</a>',
                'modalities' => ($item->modalities) ?  implode(' • ', $item->modalities) : '',
                'phone_wpp' => $item->user->phone_wpp,
                'created_at' => $item->created_at->format('d/m/Y'),
                'age' => $item->user->age,
                'gender' => $item->user->genderName,
                'has_registration' => sprintf($badge, ($item->hasRegistration ? 'success' : 'light'), $item->statusRegistration)
            ];
        }


        return json_encode(['data' => $response]);
    }

    
}