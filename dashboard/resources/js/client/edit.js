
let person_type_id = $('#person_type_id');
let document_type_id = $('#document_type_id');
let nit = $('#nit');
let company_name = $('#company_name');
let address = $('#address');
let email_company = $('#email_company');
let category = $('#category');
let review = $('#review');
let observation = $('#observation');

let client_responsible_id = $('#client_responsible_id');

let is_simple_taxation_regime = $('#is_simple_taxation_regime');
let simple_taxation_regime_advances_lbl = $('#simple_taxation_regime_advances_lbl');
let simple_taxation_regime_advances = $('#simple_taxation_regime_advances');
let simple_taxation_regime_consolidated_annual_lbl = $('#simple_taxation_regime_consolidated_annual_lbl');
let simple_taxation_regime_consolidated_annual = $('#simple_taxation_regime_consolidated_annual');

let is_industry_commerce = $('#is_industry_commerce');
let industry_commerce_periodicity_lbl = $('#industry_commerce_periodicity_lbl');
let industry_commerce_periodicity = $('#industry_commerce_periodicity');
let industry_commerce_department_lbl = $('#industry_commerce_department_lbl');
let industry_commerce_department = $('#industry_commerce_department');
let industry_commerce_city_lbl = $('#industry_commerce_city_lbl');
let industry_commerce_city = $('#industry_commerce_city');
let industry_commerce_places_table = $('#industry_commerce_places_table');

let is_industry_commerce_retainer = $('#is_industry_commerce_retainer');
let industry_commerce_retainer_periodicity_lbl = $('#industry_commerce_retainer_periodicity_lbl');
let industry_commerce_retainer_periodicity = $('#industry_commerce_retainer_periodicity');
let industry_commerce_retainer_department_lbl = $('#industry_commerce_retainer_department_lbl');
let industry_commerce_retainer_department = $('#industry_commerce_retainer_department');
let industry_commerce_retainer_city_lbl = $('#industry_commerce_retainer_city_lbl');
let industry_commerce_retainer_city = $('#industry_commerce_retainer_city');
let industry_commerce_retainer_places_table = $('#industry_commerce_retainer_places_table');

let is_industry_commerce_selfretaining = $('#is_industry_commerce_selfretaining');
let industry_commerce_selfretaining_periodicity_lbl = $('#industry_commerce_selfretaining_periodicity_lbl');
let industry_commerce_selfretaining_periodicity = $('#industry_commerce_selfretaining_periodicity');
let industry_commerce_selfretaining_department_lbl = $('#industry_commerce_selfretaining_department_lbl');
let industry_commerce_selfretaining_department = $('#industry_commerce_selfretaining_department');
let industry_commerce_selfretaining_city_lbl = $('#industry_commerce_selfretaining_city_lbl');
let industry_commerce_selfretaining_city = $('#industry_commerce_selfretaining_city');
let industry_commerce_selfretaining_places_table = $('#industry_commerce_selfretaining_places_table');

let vat_responsible = $('#vat_responsible');
let vat_responsible_periodicity_lbl = $('#vat_responsible_periodicity_lbl');
let vat_responsible_periodicity = $('#vat_responsible_periodicity');
let vat_responsible_observation_lbl = $('#vat_responsible_observation_lbl');
let vat_responsible_observation = $('#vat_responsible_observation');

let is_rent = $('#is_rent');
let rent_periodicity_lbl = $('#rent_periodicity_lbl');
let rent_periodicity = $('#rent_periodicity');

let is_supersociety = $('#is_supersociety');
let supersociety_periodicity_lbl = $('#supersociety_periodicity_lbl');
let supersociety_periodicity = $('#supersociety_periodicity');

let is_supertransport = $('#is_supertransport');
let supertransport_periodicity_lbl = $('#supertransport_periodicity_lbl');
let supertransport_periodicity = $('#supertransport_periodicity');
let supertransport_observation_lbl = $('#supertransport_observation_lbl');
let supertransport_observation = $('#supertransport_observation');

let is_superfinancial = $('#is_superfinancial');
let superfinancial_periodicity_lbl = $('#superfinancial_periodicity_lbl');
let superfinancial_periodicity = $('#superfinancial_periodicity');

let is_source_retention = $('#is_source_retention');
let source_retention_periodicity_lbl = $('#source_retention_periodicity_lbl');
let source_retention_periodicity = $('#source_retention_periodicity');

let is_dian_exogenous_information = $('#is_dian_exogenous_information');
let dian_exogenous_information_periodicity_lbl = $('#dian_exogenous_information_periodicity_lbl');
let dian_exogenous_information_periodicity = $('#dian_exogenous_information_periodicity');

let is_municipal_exogenous_information = $('#is_municipal_exogenous_information');
let municipal_exogenous_information_periodicity_lbl = $('#municipal_exogenous_information_periodicity_lbl');
let municipal_exogenous_information_periodicity = $('#municipal_exogenous_information_periodicity');
let municipal_exogenous_information_department_lbl = $('#municipal_exogenous_information_department_lbl');
let municipal_exogenous_information_department = $('#municipal_exogenous_information_department');
let municipal_exogenous_information_city_lbl = $('#municipal_exogenous_information_city_lbl');
let municipal_exogenous_information_city = $('#municipal_exogenous_information_city');
let municipal_exogenous_information_places_table = $('#municipal_exogenous_information_places_table');

let is_wealth_tax = $('#is_wealth_tax');
let wealth_tax_periodicity_lbl = $('#wealth_tax_periodicity_lbl');
let wealth_tax_periodicity = $('#wealth_tax_periodicity');

let is_radian = $('#is_radian');
let radian_periodicity_lbl = $('#radian_periodicity_lbl');
let radian_periodicity = $('#radian_periodicity');

let is_e_payroll = $('#is_e_payroll');
let e_payroll_periodicity_lbl = $('#e_payroll_periodicity_lbl');
let e_payroll_periodicity = $('#e_payroll_periodicity');

let is_single_registry_final_benefeciaries = $('#is_single_registry_final_benefeciaries');
let single_registry_final_benefeciaries_periodicity_lbl = $('#single_registry_final_benefeciaries_periodicity_lbl');
let single_registry_final_benefeciaries_periodicity = $('#single_registry_final_benefeciaries_periodicity');

let is_renovacion_esal = $('#is_renovacion_esal');
let renovacion_esal_periodicity_lbl = $('#renovacion_esal_periodicity_lbl');
let renovacion_esal_periodicity = $('#renovacion_esal_periodicity');

let is_assets_abroad = $('#is_assets_abroad');
let assets_abroad_periodicity_lbl = $('#assets_abroad_periodicity_lbl');
let assets_abroad_periodicity = $('#assets_abroad_periodicity');

let is_single_registry_proposers = $('#is_single_registry_proposers');
let single_registry_proposers_periodicity_lbl = $('#single_registry_proposers_periodicity_lbl');
let single_registry_proposers_periodicity = $('#single_registry_proposers_periodicity');
let single_registry_proposers_department_lbl = $('#single_registry_proposers_department_lbl');
let single_registry_proposers_department = $('#single_registry_proposers_department');
let single_registry_proposers_city_lbl = $('#single_registry_proposers_city_lbl');
let single_registry_proposers_city = $('#single_registry_proposers_city');
let single_registry_proposers_places_table = $('#single_registry_proposers_places_table');

let is_renewal_commercial_registration = $('#is_renewal_commercial_registration');
let renewal_commercial_registration_periodicity_lbl = $('#renewal_commercial_registration_periodicity_lbl');
let renewal_commercial_registration_periodicity = $('#renewal_commercial_registration_periodicity');

let is_national_tourism_fund = $('#is_national_tourism_fund');
let national_tourism_fund_periodicity_lbl = $('#national_tourism_fund_periodicity_lbl');
let national_tourism_fund_periodicity = $('#national_tourism_fund_periodicity');

let is_special_tax_regime = $('#is_special_tax_regime');

let is_national_tourism_registry = $('#is_national_tourism_registry');
let national_tourism_registry_periodicity_lbl = $('#national_tourism_registry_periodicity_lbl');
let national_tourism_registry_periodicity = $('#national_tourism_registry_periodicity');
// Obtener valores de los campos

let contact_info_id = $('#contact_info_id'); // Obtiene el ID
let contactDocumentTypeId = $('#contact_document_type_id'); // Obtiene el ID
let identification = $('#identification');
let firstname = $('#firstname');
let lastname = $('#lastname');
let jobTitle = $('#job_title');
let email = $('#email');
let cellphone = $('#cellphone');
let birthday = $('#birthday');
let observationContact = $('#observationContact');
let channel_communication = $('#channel_communication');

let contact_table = $('#contact-table');

let employee_id = $('#employee_id');
let employee_client_id = $('#employee_client_id');



fetch(`/client/all/${client_id}`)
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al obtener los datos del cliente');
        }
        return response.json();
    })
    .then(clientData => {
        console.log(clientData)
        person_type_id.val(clientData.person_type_id).trigger('change')
        document_type_id.val(clientData.document_type_id).trigger('change')
        nit.val(clientData.nit)
        company_name.val(clientData.company_name)
        address.val(clientData.address)
        email_company.val(clientData.email)
        category.val(clientData.category).trigger('change')
        review.val(clientData.review)
        observation.val(clientData.observation)

        client_responsible_id.val(clientData.client_responsible.id)

        is_simple_taxation_regime.val(clientData.client_responsible.is_simple_taxation_regime ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_simple_taxation_regime) {
            simple_taxation_regime_advances.val(clientData.client_responsible.simple_taxation_regime_advances).trigger('change')
            simple_taxation_regime_consolidated_annual.val(clientData.client_responsible.simple_taxation_regime_consolidated_annual).trigger('change')
            // simple_taxation_regime_advances_lbl.css('display', 'flex');
            // simple_taxation_regime_consolidated_annual_lbl.css('display', 'flex');
            // simple_taxation_regime_advances.css('display', 'flex');
            // simple_taxation_regime_consolidated_annual.css('display', 'flex');
        }

        is_industry_commerce.val(clientData.client_responsible.is_industry_commerce ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_industry_commerce) {
            industry_commerce_periodicity.val(clientData.client_responsible.industry_commerce_periodicity).trigger('change')
            let placesArray = JSON.parse(clientData.client_responsible.industry_commerce_places);
            $('#industry_commerce_places_table tbody').empty();
            placesArray.forEach(place => {
                $('#industry_commerce_places_table tbody').append(`
                    <tr>
                        <td>${place.deparment}</td>
                        <td>${place.city}</td>
                        <td><button class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                    </tr>
                `);
            });
        }

        is_industry_commerce_retainer.val(clientData.client_responsible.is_industry_commerce_retainer ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_industry_commerce_retainer) {
            industry_commerce_retainer_periodicity.val(clientData.client_responsible.industry_commerce_retainer_periodicity).trigger('change')
            let placesArray = JSON.parse(clientData.client_responsible.industry_commerce_retainer_places);
            $('#industry_commerce_retainer_places_table tbody').empty();
            placesArray.forEach(place => {
                $('#industry_commerce_retainer_places_table tbody').append(`
                    <tr>
                        <td>${place.deparment}</td>
                        <td>${place.city}</td>
                        <td><button class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                    </tr>
                `);
            });
        }

        is_industry_commerce_selfretaining.val(clientData.client_responsible.is_industry_commerce_selfretaining ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_industry_commerce_selfretaining) {
            industry_commerce_selfretaining_periodicity.val(clientData.client_responsible.industry_commerce_selfretaining_periodicity).trigger('change')
            let placesArray = JSON.parse(clientData.client_responsible.industry_commerce_selfretaining_places);
            $('#industry_commerce_selfretaining_places_table tbody').empty();
            placesArray.forEach(place => {
                $('#industry_commerce_selfretaining_places_table tbody').append(`
                    <tr>
                        <td>${place.deparment}</td>
                        <td>${place.city}</td>
                        <td><button class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                    </tr>
                `);
            });
        }

        vat_responsible.val(clientData.client_responsible.vat_responsible ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.vat_responsible) {
            vat_responsible_periodicity.val(clientData.client_responsible.vat_responsible_periodicity).trigger('change')
            vat_responsible_observation.val(clientData.client_responsible.vat_responsible_observation)
        }

        is_rent.val(clientData.client_responsible.is_rent ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_rent) {
            rent_periodicity.val(clientData.client_responsible.rent_periodicity).trigger('change')
        }

        is_supersociety.val(clientData.client_responsible.is_supersociety ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_supersociety) {
            supersociety_periodicity.val(clientData.client_responsible.supersociety_periodicity).trigger('change')
        }

        is_supertransport.val(clientData.client_responsible.is_supertransport ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_supertransport) {
            supertransport_periodicity.val(clientData.client_responsible.supertransport_periodicity).trigger('change')
            supertransport_observation.val(clientData.client_responsible.supertransport_observation)
        }

        is_superfinancial.val(clientData.client_responsible.is_superfinancial ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_superfinancial) {
            superfinancial_periodicity.val(clientData.client_responsible.superfinancial_periodicity).trigger('change')
        }

        is_source_retention.val(clientData.client_responsible.is_source_retention ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_source_retention) {
            source_retention_periodicity.val(clientData.client_responsible.source_retention_periodicity).trigger('change')
        }

        is_dian_exogenous_information.val(clientData.client_responsible.is_dian_exogenous_information ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_dian_exogenous_information) {
            dian_exogenous_information_periodicity.val(clientData.client_responsible.dian_exogenous_information_periodicity).trigger('change')
        }

        is_municipal_exogenous_information.val(clientData.client_responsible.is_municipal_exogenous_information ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_municipal_exogenous_information) {
            dian_exogenous_information_periodicity.val(clientData.client_responsible.municipal_exogenous_information_periodicity).trigger('change')
        }

        is_municipal_exogenous_information.val(clientData.client_responsible.is_municipal_exogenous_information ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_municipal_exogenous_information) {
            municipal_exogenous_information_periodicity.val(clientData.client_responsible.municipal_exogenous_information_periodicity).trigger('change')
            let placesArray = JSON.parse(clientData.client_responsible.municipal_exogenous_information_places);
            $('#municipal_exogenous_information_places_table tbody').empty();
            placesArray.forEach(place => {
                $('#municipal_exogenous_information_places_table tbody').append(`
                    <tr>
                        <td>${place.deparment}</td>
                        <td>${place.city}</td>
                        <td><button class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                    </tr>
                `);
            });
        }

        is_wealth_tax.val(clientData.client_responsible.is_wealth_tax ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_wealth_tax) {
            wealth_tax_periodicity.val(clientData.client_responsible.wealth_tax_periodicity).trigger('change')
        }

        is_radian.val(clientData.client_responsible.is_radian ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_radian) {
            radian_periodicity.val(clientData.client_responsible.radian_periodicity).trigger('change')
        }

        is_e_payroll.val(clientData.client_responsible.is_e_payroll ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_e_payroll) {
            e_payroll_periodicity.val(clientData.client_responsible.e_payroll_periodicity).trigger('change')
        }

        is_single_registry_final_benefeciaries.val(clientData.client_responsible.is_single_registry_final_benefeciaries ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_single_registry_final_benefeciaries) {
            single_registry_final_benefeciaries_periodicity.val(clientData.client_responsible.single_registry_final_benefeciaries_periodicity).trigger('change')
        }

        is_renovacion_esal.val(clientData.client_responsible.is_renovacion_esal ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_renovacion_esal) {
            renovacion_esal_periodicity.val(clientData.client_responsible.renovacion_esal_periodicity).trigger('change')
        }

        is_assets_abroad.val(clientData.client_responsible.is_assets_abroad ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_assets_abroad) {
            assets_abroad_periodicity.val(clientData.client_responsible.assets_abroad_periodicity).trigger('change')
        }

        is_single_registry_proposers.val(clientData.client_responsible.is_single_registry_proposers ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_single_registry_proposers) {
            single_registry_proposers_periodicity.val(clientData.client_responsible.single_registry_proposers_periodicity).trigger('change')
            let placesArray = JSON.parse(clientData.client_responsible.single_registry_proposers_places);
            $('#single_registry_proposers_places_table tbody').empty();
            placesArray.forEach(place => {
                $('#single_registry_proposers_places_table tbody').append(`
                    <tr>
                        <td>${place.deparment}</td>
                        <td>${place.city}</td>
                        <td><button class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                    </tr>
                `);
            });
        }

        is_renewal_commercial_registration.val(clientData.client_responsible.is_renewal_commercial_registration ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_renewal_commercial_registration) {
            renewal_commercial_registration_periodicity.val(clientData.client_responsible.renewal_commercial_registration_periodicity).trigger('change')
        }

        is_national_tourism_fund.val(clientData.client_responsible.is_national_tourism_fund ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_national_tourism_fund) {
            national_tourism_fund_periodicity.val(clientData.client_responsible.national_tourism_fund_periodicity).trigger('change')
        }

        is_special_tax_regime.val(clientData.client_responsible.is_special_tax_regime ? 'TRUE' : 'FALSE').trigger('change')

        is_national_tourism_registry.val(clientData.client_responsible.is_national_tourism_registry ? 'TRUE' : 'FALSE').trigger('change')
        if (clientData.client_responsible.is_national_tourism_registry) {
            national_tourism_fund_periodicity.val(clientData.client_responsible.national_tourism_registry_periodicity).trigger('change')
        }

        if (clientData.person_type_id == 1) {
            clientData.contact_info.forEach(contact => {
                contact_info_id.val(contact.id)
                contactDocumentTypeId.val(contact.document_type_id).trigger('change') // Obtiene el ID
                identification.val(contact.identification);
                firstname.val(contact.firstname);
                lastname.val(contact.lastname);
                jobTitle.val(contact.jobTitle);
                email.val(contact.email);
                cellphone.val(contact.cellphone);
                birthday.val(contact.birthday);
                observationContact.val(contact.observation);
                // Cargar checkboxes de "channel_communication"
                let selectedChannels = contact.channel_communication.text().split(', ');
                $('input[name="channel_communication[]"]').each(function () {
                    $(this).prop('checked', selectedChannels.includes($(this).val()));
                });
            });

        }

        if (clientData.person_type_id == 2) {

            $('#contact-table tbody').empty();
            clientData.contact_info.forEach(contact => {
                $('#contact-table tbody').append(`
                    <tr>
                        <td class="hidden-contact-id" style="display:none;">${contact.id}</td> <!-- ID oculto -->
                        <td class="hidden-id" style="display:none;">${contact.document_type_id}</td> <!-- ID oculto -->
                        <td>${contact.document_type.name}</td>
                        <td>${contact.identification}</td>
                        <td>${contact.firstname}</td>
                        <td>${contact.lastname}</td>
                        <td>${contact.birthday}</td>
                        <td>${contact.job_title}</td>
                        <td>${contact.email}</td>
                        <td>${contact.cellphone}</td>
                        <td>${contact.channel_communication}</td>
                        <td>${contact.observation}</td>
                        <td>   <button class="btn btn-warning btn-sm edit-row">Editar</button><button class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                    </tr>
                `);



            });
        }
        clientData.employees.forEach(employee => {
            employee_id.val(employee.employee_id).trigger('change');
            employee_client_id.val(employee.id);
        });


    });
