<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReceivableRequest;
use App\Http\Requests\UpdateReceivableRequest;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountReceivable extends Controller
{
    private $transaction;

    public function __construct(TransactionService $transactionService)
    {
        $this->transaction = $transactionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            return $this->transaction->listReceiptToDataTable();
        }

        return view('transaction.receivable.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account = new Transaction();

        $payments = PaymentMethod::get()->toArray();
        $payments = array_map(function($item) {
            return [$item['id'], $item['name']];
        }, $payments);  

        return view('transaction.receivable.create', compact('account', 'payments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceivableRequest $request)
    {
        if(!$account = $this->transaction->storeTransaction($request->except(['_token']))) {
            return redirect()->route('receivable.index')->with('warning','Erro ao cadastrar a conta');
        }

    
        return redirect()->route('receivable.show', $account)->with('warning','Conta cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$account = $this->transaction->findTransaction($id)) {
            return redirect()->route('receivable.index')->with('warning','Conta não encontrado!');
        }

       

        return view('transaction.receivable.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$account = $this->transaction->findTransaction($id)) {
            return redirect()->route('receivable.index')->with('warning','Conta não encontrado!');
        }

        $payments = PaymentMethod::get()->toArray();
        $payments = array_map(function($item) {
            return [$item['id'], $item['name']];
        }, $payments);  

        return view('transaction.receivable.edit', compact('account', 'payments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceivableRequest $request, $id)
    {

        if(!$account = $this->transaction->findTransaction($id)) {
            return redirect()->route('receivable.index')->with('warning','Conta não encontrado!');
        }


        if($this->transaction->updateTransaction($account, $request->except(['_token', '_method']))) {
            return redirect()->route('receivable.show', $account)->with('success', 'Conta alterada com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$account = $this->transaction->findTransaction($id)) {
            return redirect()->route('receivable.index')->with('warning','Conta não encontrado!');
        }

        $this->transaction->deleteTransaction($account);

        return redirect()->route('receivable.index')->with('success', 'Conta removida com sucesso!');

    }

    public function receive($id) {
        if(!$account = $this->transaction->findTransaction($id)) {
            return redirect()->route('receivable.index')->with('warning','Conta não encontrado!');
        }

        
        $account->pay_date = date('Y-m-d');

        $fees = $this->transaction->calculateFees($account->date, $account->pay_date, $account->value);

        $account->fees = $fees['fees'];
        $account->amount = $fees['amount'];

        $payments = PaymentMethod::get()->toArray();
        $payments = array_map(function($item) {
            return [$item['id'], $item['name']];
        }, $payments);  

        return view('transaction.receivable.receive', compact('account', 'payments'));
    }

    public function fees(Request $request) {
        $fees = $this->transaction->calculateFees($request->input('date'), $request->input('pay_date'), currency($request->input('value'), true));

        foreach($fees as $i => $val) {
            $fees[$i] = currency($val);
        }

        return response()->json($fees);
    }
}
