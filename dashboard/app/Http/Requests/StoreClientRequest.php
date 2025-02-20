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
            'observation' => 'nullable',
            'category' => 'required',
            'review' => 'nullable',

            'is_simple_taxation_regime' => 'required',
            'simple_taxation_regime_advances' => 'required_if:is_simple_taxation_regime,TRUE',
            'simple_taxation_regime_consolidated_annual' => 'required_if:is_simple_taxation_regime,TRUE',
            'is_industry_commerce' => 'required',
            'industry_commerce_periodicity' => 'required_if:is_industry_commerce,TRUE',
            'industry_commerce_retainer_places' => 'required_if:is_industry_commerce,TRUE|array',
            'is_industry_commerce_retainer' => 'required',
            'industry_commerce_retainer_periodicity' => 'required_if:is_industry_commerce_retainer,TRUE',
            'industry_commerce_retainer_places' => 'required_if:is_industry_commerce_retainer,TRUE|array',
            'is_industry_commerce_selfretaining' => 'required',
            'industry_commerce_selfretaining_periodicity' => 'required_if:is_industry_commerce_selfretaining,TRUE',
            'industry_commerce_selfretaining_places' => 'required_if:is_industry_commerce_selfretaining,TRUE|array',

            'vat_responsible' => 'required',
            'vat_responsible_periodicity' => 'required_if:vat_responsible,TRUE',
            'vat_responsible_observation' => 'nullable',


            'is_rent' => 'required',
            'rent_periodicity' => 'required_if:is_rent,TRUE',

            'is_supersociety' => 'required',
            'supersociety_periodicity' => 'required_if:is_supersociety,TRUE',

            'is_supertransport' => 'required',
            'supertransport_periodicity' => 'required_if:is_supertransport,TRUE',
            'supertransport_observation' => 'nullable',

            'is_superfinancial' => 'required',
            'superfinancial_periodicity' => 'required_if:is_superfinancial,TRUE',

            'is_source_retention' => 'required',
            'source_retention_periodicity' => 'required_if:is_source_retention,TRUE',

            'is_dian_exogenous_information' => 'required',
            'dian_exogenous_information_periodicity' => 'required_if:is_dian_exogenous_information,TRUE',

            'is_municipal_exogenous_information' => 'required',
            'municipal_exogenous_information_periodicity' => 'required_if:is_municipal_exogenous_information,TRUE',
            'municipal_exogenous_information_places' => 'required_if:is_municipal_exogenous_information,TRUE|array',

            'is_wealth_tax' => 'required',
            'wealth_tax_periodicity' => 'required_if:is_wealth_tax,TRUE',

            'is_radian' => 'required',
            'radian_periodicity' => 'required_if:is_radian,TRUE',

            'is_e_payroll' => 'required',
            'e_payroll_periodicity' => 'required_if:is_e_payroll,TRUE',

            'is_single_registry_final_benefeciaries' => 'required',
            'single_registry_final_benefeciaries_periodicity' => 'required_if:is_single_registry_final_benefeciaries,TRUE',

            'is_renovacion_esal' => 'required',
            'renovacion_esal_periodicity' => 'required_if:is_renovacion_esal,TRUE',

            'is_assets_abroad' => 'required',
            'assets_abroad_periodicity' => 'required_if:is_assets_abroad,TRUE',

            'is_single_registry_proposers' => 'required',
            'single_registry_proposers_periodicity' => 'required_if:is_single_registry_proposers,TRUE',
            'single_registry_proposers_places' => 'required_if:is_single_registry_proposers,TRUE|array',

            'is_renewal_commercial_registration' => 'required',
            'renewal_commercial_registration_periodicity' => 'required_if:is_renewal_commercial_registration,TRUE',

            'is_national_tourism_fund' => 'required',
            'national_tourism_fund_periodicity' => 'required_if:is_national_tourism_fund,TRUE',

            'is_special_tax_regime' => 'required',

            'is_national_tourism_registry' => 'required',
            'national_tourism_registry_periodicity' => 'required_if:is_national_tourism_registry,TRUE',


            'contact_document_type_id' => 'required_if:person_type_id,1',
            'identification' => 'required_if:person_type_id,1',
            'firstname' => 'required_if:person_type_id,1',
            'lastname' => 'required_if:person_type_id,1',
            'birthday' => 'required_if:person_type_id,1',
            'channel_communication' => 'nullable',
            'job_title' => 'required_if:person_type_id,1',
            'email' => 'required_if:person_type_id,1',
            'observationContact' => 'nullable',
            'cellphone' => 'required_if:person_type_id,1',
            'employee_id' => 'required',
            'contacts' => 'required_if:person_type_id,2|array',
            'industry_commerce_places' => 'nullable|array',
            'industry_commerce_selfretaining_places' => 'nullable|array',
            'municipal_exogenous_information_places' => 'nullable|array',
            'single_registry_proposers_places' => 'nullable|array',

        ];
    }
    public function messages()
    {
        return [
            'firstname.required_if' => 'El nombre es obligatorio para personas naturales.',
            'lastname.required_if' => 'El apellido es obligatorio para personas naturales.',
            'email.required_if' => 'El correo electrónico es obligatorio para personas naturales.',
            'email_company.unique' => 'El correo electrónico ya se encuentra registrado.',
            'contacts.required_if' => 'Los contactos son obligatorios para personas jurídicas.',
        ];
    }
}
