<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_responsibles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();

            $table->boolean('is_simple_taxation_regime')->default(false);
            $table->string('simple_taxation_regime_advances')->nullable();
            $table->string('simple_taxation_regime_consolidated_annual')->nullable();

            $table->boolean('is_industry_commerce')->default(false);
            $table->string('industry_commerce_periodicity')->nullable();
            $table->text('industry_commerce_places')->nullable();

            $table->boolean('is_industry_commerce_retainer')->default(false);
            $table->string('industry_commerce_retainer_periodicity')->nullable();
            $table->text('industry_commerce_retainer_places')->nullable();

            $table->boolean('is_industry_commerce_selfretaining')->default(false);
            $table->string('industry_commerce_selfretaining_periodicity')->nullable();
            $table->text('industry_commerce_selfretaining_places')->nullable();

            $table->boolean('vat_responsible')->default(false);
            $table->string('vat_responsible_periodicity')->nullable();
            $table->text('vat_responsible_observation')->nullable();

            $table->boolean('is_rent')->default(false);
            $table->string('rent_periodicity')->nullable();

            $table->boolean('is_supersociety')->default(false);
            $table->string('supersociety_periodicity')->nullable();

            $table->boolean('is_supertransport')->default(false);
            $table->string('supertransport_periodicity')->nullable();
            $table->text('supertransport_observation')->nullable();


            $table->boolean('is_superfinancial')->default(false);
            $table->string('superfinancial_periodicity')->nullable();

            $table->boolean('is_source_retention')->default(false);
            $table->string('source_retention_periodicity')->nullable();

            $table->boolean('is_dian_exogenous_information')->default(false);
            $table->string('dian_exogenous_information_periodicity')->nullable();

            $table->boolean('is_municipal_exogenous_information')->default(false);
            $table->string('municipal_exogenous_information_periodicity')->nullable();
            $table->text('municipal_exogenous_information_places')->nullable();

            $table->boolean('is_wealth_tax')->default(false);
            $table->string('wealth_tax_periodicity')->nullable();

            $table->boolean('is_radian')->default(false);
            $table->string('radian_periodicity')->nullable();

            $table->boolean('is_e_payroll')->default(false);
            $table->string('e_payroll_periodicity')->nullable();

            $table->boolean('is_single_registry_final_benefeciaries')->default(false);
            $table->string('single_registry_final_benefeciaries_periodicity')->nullable();

            $table->boolean('is_renovacion_esal')->default(false);
            $table->string('renovacion_esal_periodicity')->nullable();

            $table->boolean('is_assets_abroad')->default(false);
            $table->string('assets_abroad_periodicity')->nullable();

            $table->boolean('is_single_registry_proposers')->default(false);
            $table->string('single_registry_proposers_periodicity')->nullable();
            $table->text('single_registry_proposers_places')->nullable();

            $table->boolean('is_renewal_commercial_registration')->default(false);
            $table->string('renewal_commercial_registration_periodicity')->nullable();

            $table->boolean('is_national_tourism_fund')->default(false);
            $table->string('national_tourism_fund_periodicity')->nullable();

            $table->boolean('is_special_tax_regime')->default(false);

            $table->boolean('is_national_tourism_registry')->default(false);
            $table->string('national_tourism_registry_periodicity')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_responsibles', function (Blueprint $table) {
            // Eliminamos manualmente las claves foráneas antes de borrar la tabla
            $table->dropForeign(['client_id']);
        });
        Schema::dropIfExists('client_responsibles');
    }
};
