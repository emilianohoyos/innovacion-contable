<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientResponsible extends Model
{
    protected $fillable = [
        'client_id',
        'is_simple_taxation_regime',
        'simple_taxation_regime_advances',
        'simple_taxation_regime_consolidated_annual',

        'is_industry_commerce',
        'industry_commerce_periodicity',
        'industry_commerce_places',

        'is_industry_commerce_retainer',
        'industry_commerce_retainer_periodicity',
        'industry_commerce_retainer_places',

        'is_industry_commerce_selfretaining',
        'industry_commerce_selfretaining_periodicity',
        'industry_commerce_selfretaining_places',

        'vat_responsible',
        'vat_responsible_periodicity',
        'vat_responsible_observation',

        'is_rent',
        'rent_periodicity',

        'is_supersociety',
        'supersociety_periodicity',

        'is_supertransport',
        'supertransport_periodicity',

        'is_superfinancial',
        'superfinancial_periodicity',

        'is_source_retention',
        'source_retention_periodicity',

        'is_dian_exogenous_information',
        'dian_exogenous_information_periodicity',

        'is_municipal_exogenous_information',
        'municipal_exogenous_information_periodicity',
        'municipal_exogenous_information_places',

        'is_wealth_tax',
        'wealth_tax_periodicity',

        'is_radian',
        'radian_periodicity',

        'is_e_payroll',
        'e_payroll_periodicity',

        'is_single_registry_final_benefeciaries',
        'single_registry_final_benefeciaries_periodicity',

        'is_renovacion_esal',
        'renovacion_esal_periodicity',

        'is_assets_abroad',
        'assets_abroad_periodicity',

        'is_single_registry_proposers',
        'single_registry_proposers_periodicity',
        'single_registry_proposers_places',

        'is_renewal_commercial_registration',
        'renewal_commercial_registration_periodicity',

        'is_national_tourism_fund',
        'national_tourism_fund_periodicity',

        'is_special_tax_regime',

        'is_national_tourism_registry',
        'national_tourism_registry_periodicity',
    ];

    // protected $casts = [
    //     'industry_commerce_places' => 'array',
    //     'industry_commerce_retainer_places' => 'array',
    //     'industry_commerce_selfretaining_places' => 'array',
    //     'municipal_exogenous_information_places' => 'array',
    //     'single_registry_proposers_places' => 'array',

    // ];
}
