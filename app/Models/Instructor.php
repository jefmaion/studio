<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function modalities() {
        return $this->belongsToMany(Modality::class, 'instructor_modalities')
                ->using(InstructorModality::class)
                ->withPivot(['id', 'remuneration_type', 'remuneration_value', 'calc_on_absense', 'enabled']);
    }

    public function classes() {
        return $this->hasMany(Classes::class);
    }
}
