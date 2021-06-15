<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ApiRequest extends FormRequest
{


    protected function prepareForValidation()
    {

        // проверяем наличие елеммента массива transactions
        if (isset($this->transactions)){
            $transactions = $this->transactions;

            foreach ($transactions as $key => $transaction){
                // проверяем наличие елеммента массива id
                if (isset($transaction['id'])){
                    $transactions[$key]['transaction_id'] = $transaction['id'];
                }
            }

            $this->merge([
                'transactions' => $transactions
            ]);

        }

    }

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
            "transactions.*.transaction_id" => 'required|max:32|unique:transactions',
            "transactions.*.operation" => 'required|max:3',
            "transactions.*.status" => 'required|max:7',
            "transactions.*.descriptor" => 'required',

            "order.order_id" => 'required|max:32|unique:App\Models\Order,order_id',
            "order.status" => 'required|max:11',
            "order.amount" => 'required|max:11',
            "order.currency" => 'required|max:3',
            "order.descriptor" => 'required',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = collect($validator->errors())->collapse()->toArray();

        throw new HttpResponseException(redirect()->route('validation-error',[
            'status' => 'validation error',
            'transactions' => $this->transactions,
            'order' => $this->order,
            'errors' => $errors
        ]));
    }
}
