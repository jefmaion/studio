<?php

namespace App\Services;

use App\Models\Transaction;
use Carbon\Carbon;

class TransactionService extends Service {


    public function findTransaction($id) {
        return Transaction::find($id);
    }

    public function storeTransaction($data) {
        return Transaction::create($data);
    }

    public function updateTransaction(Transaction $transaction, $data) {
        return $transaction->fill($data)->save();
    }

    public function deleteTransaction(Transaction $transaction) {
        return $transaction->delete();
    }

    public function calculateFees($dueDate, $payDate, $value) {
 
        $data = ['fees' => 0, 'amount' => $value];

        if($payDate > $dueDate) {
            $daysLate  = Carbon::parse($payDate)->diffInDays($dueDate);
            $fees      = $daysLate * (0.033/100);

            $data['fees'] = ($fees * $value) +  ($value * 0.02);
            $data['amount'] = $value  + $data['fees'];
        }

        return $data;
    }

    public function listReceiptToDataTable() {

        $data = Transaction::where('type', 'R')->get();
        $response = [];
        foreach($data as $item) {


            $response[] = [
                'id' => $item->id,
                'data' =>  '<a href="'.route('receivable.show', $item).'">'.$item->date->format('d/m/Y').'</a>',
                'description' => $item->description,
                'amount' => currency( (empty($item->amount) ? $item->value : $item->amount) ),
                'status' => '<span class="badge bagde-pill badge-'.$item->bgColor.'">'.$item->situation.'</span>',
                'actions' => '<a href="'.route('receivable.edit', $item).'">Editar</a> • <a href="'.route('receivable.receive', $item).'">Receber</a>'
            ];
        }


        return json_encode(['data' => $response]);


    }

}