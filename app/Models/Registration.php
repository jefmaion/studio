<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['start', 'end'];

    public function modality() {
        return $this->belongsTo(Modality::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function classes() {
        return $this->hasMany(Classes::class);
    }

    public function getLastClass() {
        return $this->classes()->orderBy('date', 'desc')->first()->date;
    }


    public function getPositionAttribute() {
        $today = Carbon::parse(date('Y-m-d'));

        if($today->between($this->start, $this->end)) {
            return 'Em andamento';
        }

        return null;
    }

}
