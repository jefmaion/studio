<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassesRequest extends FormRequest
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
            'student.name' => 'required',
            'student.phone_wpp' => 'required',
            'student.gender' => 'required',
            'class.modality_id' => 'required',
            'class.instructor_id' => 'required',

            'transaction.payment_method_id' => 'nullable|required_with:transaction.value'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'value' => currency($this->value, true)
        ]);

       
    }

    public function attributes()
    {
        return [
            'student.name' => 'Nome',
            'student.phone_wpp' => 'Telefone',
            'student.gender' => 'Sexo',
            'class.modality_id' => 'Modalidade',
            'class.instructor_id' => 'Professor',
            'transaction.value' => 'Valor',
            'transaction.payment_method_id' => 'Forma de Pagamento'
        ];
    }
}
