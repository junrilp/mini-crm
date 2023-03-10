<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create', new Employee);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:60',
            'last_name'  => 'required|max:60',
            'company_id' => 'required|numeric|exists:companies,id',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|max:255',
        ];
    }
}
