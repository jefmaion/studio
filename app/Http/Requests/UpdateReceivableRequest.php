<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReceivableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required',
            'description' => 'required|sometimes',
            'value' => 'required',
            'payment_method_id' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'value' => currency($this->value, true),
            'amount' => currency($this->amount, true),
            'fees' => currency($this->fees, true),
        ]);

    }

}
