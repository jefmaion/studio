<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService extends Service {


    public function listReceiptToDataTable() {

        $data = Transaction::where('type', 'R')->get();

        foreach($data as $item) {


            $response[] = [
                'id' => $item->id,
                'data' =>  $item->date->format('d/m/Y'),
                'description' => $item->description,
                'amount' => currency($item->amount),
                'status' => '<span class="badge bagde-pill badge-'.$item->bgColor.'">'.$item->situation.'</span>',
            ];
        }


        return json_encode(['data' => $response]);


    }

}