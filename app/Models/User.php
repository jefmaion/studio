<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    use SoftDeletes;
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function instructor() {
        return $this->belongsTo(Instructor::class, 'id', 'user_id');
    }

    public function student() {
        return $this->belongsTo(Student::class, 'id', 'user_id');
    }

    public function getAgeAttribute() {
        return Carbon::parse($this->birth_date)->age;
    }

    public function getFirstNameAttribute() {
        $name = explode(" ", $this->name);
        return $name[0];
    }

    public function getShortNameAttribute() {
        $name = explode(" ", $this->name);

        if(count($name) == 1) {
            return $name[0];
        }

        return $name[0] .' '.end($name);
    }

    public function getNicknameAttribute() {
        if(empty($this->nickname)) {
            return $this->firstName;
        }

        return $this->nickname;
    }

    public function getGenderNameAttribute() {

        $genders = [
            'F' => 'Feminino',
            'M' => 'Masculino'
        ];

        return $genders[$this->gender];

    }
}
