<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Transaction extends BaseModel
{
    use HasFactory;

    protected $dates = ['date', 'pay_date'];

    private $_type = [
        'R' => [
            'label' => 'Receitas',
            'color' => 'success'
        ],

        'D' => [
            'label' => 'Despesas',
            'color' => 'danger'
        ]
    ];

    public function method() {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }

    public function getTypeTransactionAttribute() {
        return $this->_type[$this->type]['label'];
    }

    public function getColorTransactionAttribute() {
        return $this->_type[$this->type]['color'];
    }

    public function getSituationAttribute() {

        if($this->status == 1) {
            return 'Pago';
        }

        $dueDate = date('Y-m-d', strtotime($this->date->format('Y-m-d')));

       

        if($this->date->format('Y-m-d') === date('Y-m-d') && $this->status == 0) {
            return 'Pagar Hoje';
        }

        if($this->date->format('Y-m-d') > date('Y-m-d') && $this->status == 0) {
            return 'Aberto';
        }

        if($this->date->format('Y-m-d') < date('Y-m-d') && $this->status == 0) {
            return 'Atrasada';
        }

    }

    public function getBgColorAttribute() {

        if($this->status == 1) {
            return 'success';
        }

        $dueDate = date('Y-m-d', strtotime($this->date->format('Y-m-d')));

       

        if($this->date->format('Y-m-d') === date('Y-m-d') && $this->status == 0) {
            return 'warning';
        }

        if($this->date->format('Y-m-d') > date('Y-m-d') && $this->status == 0) {
            return 'light';
        }

        if($this->date->format('Y-m-d') < date('Y-m-d') && $this->status == 0) {
            return 'danger';
        }

    }
}
