<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['date'];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function parent() {
        return $this->belongsTo(Classes::class, 'classes_id', 'id');
    }

    public function instructor() {
        return $this->belongsTo(Instructor::class);
    }

    public function modality() {
        return $this->belongsTo(Modality::class);
    }

    public function registration() {
        return $this->belongsTo(Registration::class);
    }

    public function getTypeTextAttribute() {
        $types = [
            'AN' => 'Aula Normal',
            'AE' => 'Aula Experimental',
            'RP' => 'Reposição',
            'FJ' => 'Falta com aviso',
            'FF' => 'Falta'
        ];

        return $types[$this->type];
    }

    public function pendencies() {

        $pendencies = [];

        if($this->status == 2 && $this->has_replacement == 0 && $this->type != 'AE') {
            $pendencies[] = 'Aula de reposição não agendada';
        }

        return $pendencies;
    }
    

    public function getSituationAttribute() {

        switch ($this->status) {
            case 0:
                return 'Agendada';
                break;

            case 1:
                return 'Realizada';
                break; 

            case 2:
                return 'Falta Com Aviso';
                break;  
                
            case 3:
                return 'Falta';
                break;                
            
            default:
                return '(Não Definido)';
                break;
        }

    }

    public function getbgColorAttribute() {

        $bgClassStatus = [
            'AN' => 'bg-primary',
            'AE' => 'bg-green',
            'RP' => 'bg-warning',
            'FJ' => 'bg-red'
        ];

        if($this->status == 0 && $this->type != 'AE') {
            return 'primary';
        }

        if($this->status == 0 && $this->type == 'AE') {
            return 'grey';
        }

        if($this->status == 1) {
            return 'success';
        }

        if($this->status == 2) {
            return 'warning';
        }

        if($this->status == 3) {
            return 'danger';
        }

        if(!isset($bgClassStatus[$this->type])) {
            return 'primary';
        }

        return $bgClassStatus[$this->type];
    }
}
