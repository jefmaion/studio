<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InstructorModality extends Pivot
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    private $types = ['F' => ['label' => 'Valor Fixo', 'suffix' => 'R$'], 'P' =>  ['label' => 'Percentual de Aula', 'suffix' => '%']];


    public function getTypeAttribute() {
        return $this->types[$this->remuneration_type]['label'];
    }

    public function getValueSuffixAttribute() {
        return $this->types[$this->remuneration_type]['suffix'];
    }
}
