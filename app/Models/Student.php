<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function registrations() {
        return $this->hasMany(Registration::class);
    }

    public function classes() {
        return $this->hasMany(Classes::class);
    }

    public function finishedClasses() {
        return $this->classes()->with(['instructor'])->where('finished', 1);
    }

    public function evolutions() {
        return $this->classes()->with(['instructor'])->whereRaw('evolution <> ""')->orderBy('date', 'desc');
    }

    public function installments() {
        return $this->hasMany(Transaction::class);
    }

    public function getOverdueInstallmentsAttribute() {
        return $this->installments()->where('status', 0)->whereDate('date', '<=', date('Y-m-d'));
    }


    public function getModalitiesAttribute() {

        if(!$this->hasRegistration) {
            return false;
        }

        $registrations = $this->registrations;

        $modalities = [];
        foreach($registrations as $reg) {
            $modalities[] = $reg->modality->name;
        }

        return $modalities;
    }

    public function getHasRegistrationAttribute() {
        return $this->registrations()->where('status', 1)->count();
    }

    public function getStatusRegistrationAttribute() {
        return ($this->hasRegistration) ? 'Matriculado' : 'Sem Matrícula';
    }
}
