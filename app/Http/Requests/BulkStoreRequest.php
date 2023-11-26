<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != NULL && $user->tokenCan("invoice:create");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.customerId' => ['required', 'integer'],
            '*.amount' => ['required', 'numeric'],
            '*.status' => ['required', Rule::in(['B', 'P', 'V', 'b', 'p', 'v'])],
            '*.billedAt' => ['required', 'date', 'date_format:Y-m-d H:i:s'],
            '*.paidAt' => ['date', 'date_format:Y-m-d H-i-s', 'nullable'],
        ];
    }

    public function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj['customer_id'] = $obj['customerId'] ?? null;
            $obj['billed_at'] = $obj['billedAt'] ?? null;
            $obj['paid_at'] = $obj['paidAt'] ?? null;

            $data[] = $obj;
        }

        $this->merge($data);
    }
}