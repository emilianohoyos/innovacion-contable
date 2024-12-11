<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
        return [
            'person_type_id' => 'required',
            'document_type_id' => 'required',
            'nit' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'email_company' => 'required|email',
            'vat_responsible' => 'nullable',
            'is_selfretaining' => 'nullable|boolean',
            'is_simple_taxation_regime' => 'nullable|boolean',
            'is_ica_withholding_agent' => 'nullable|boolean',
            'municipality_ica_withholding_agent' => 'nullable|string',
            'is_ica_selfretaining_agent' => 'nullable|boolean',
            'municipality_ica_selfretaining_agent' => 'nullable|string',
            'observation' => 'nullable|string',
            'firstname' => 'required_if:person_type_id,1',
            'lastname' => 'required_if:person_type_id,1',
            'job_title' => 'required_if:person_type_id,1',
            'email' => 'required_if:person_type_id,1',
            'cellphone' => 'required_if:person_type_id,1',
            'employee_id' => 'required|array',
            'contacts' => 'required_if:person_type_id,2|array',

        ];
    }
    public function messages()
    {
        return [
            'firstname.required_if' => 'El nombre es obligatorio para personas naturales.',
            'lastname.required_if' => 'El apellido es obligatorio para personas naturales.',
            'email.required_if' => 'El correo electrónico es obligatorio para personas naturales.',
            'contacts.required_if' => 'Los contactos son obligatorios para personas jurídicas.',
        ];
    }
}
