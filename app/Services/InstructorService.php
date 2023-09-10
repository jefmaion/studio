<?php

namespace App\Services;

use App\Models\Instructor;
use App\Models\User;

class InstructorService extends Service {

    public function findInstructor($id) {
        return Instructor::with(['user', 'classes.modality', 'classes.student.user'])->find($id);
        
    }

    public function storeNewInstructor(array $data) {

        if(!$user = User::create($data)) {
            return false;
        }

        $instructor = new Instructor();
        $instructor->fill($data)->user()->associate($user)->save();

        return $instructor;

    }

    public function updateInstructor(Instructor $instructor, $data) {
        $instructor->fill($data)->save();
        return $instructor->user->fill($data)->save();
    }

    public function deleteInstructor(Instructor $instructor) {

        $user = $instructor->user;

        $instructor->delete();
        $user->delete();

        return true;
    }

    public function addModality(Instructor $instructor, $data) {
        return $instructor->modalities()->attach($instructor, $data);
    }

    public function removeModality(Instructor $instructor, $idModality) {

        return $instructor->modalities()->detach($idModality);
    }

    public function listToDataTable() {

        $response = [];
        $data = Instructor::with(['user'])->get();

        foreach($data as $item) {
            $response[] = [
                'id' => $item->id,
                'name' => '<a href="'.route('instructor.show', $item).'">'. $item->user->name.'</a>',
                'profession' => $item->profession,
                'phone_wpp' => $item->user->phone_wpp,
                'created_at' => $item->created_at->format('d/m/Y'),
            ];
        }


        return json_encode(['data' => $response]);
    }

    
}