<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LotUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('lot');
        return [
            'lot_number' => ['required', 'string', 'max:200', Rule::unique('lots', 'lot_number')->ignore($userId)]
        ];
    }

    public function messages(){
        return[
            'lot_number.required' => 'Nomor lot tidak boleh kosong',
            'lot_number.unique' => 'Nomor lot sudah di tambahkan'
        ];
    }
}
