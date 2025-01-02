@extends('layouts.master')

@section('title', 'Alternate')
@section('css')
    <link href="{{ URL::asset('dist/plugins/bs-stepper/css/bs-stepper.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dist/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dist/plugins/select2/css/select2-bootstrap-5-theme.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('dist/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />


@endsection
@section('content')
    <x-page-title title="Clientes" pagetitle="Registro de Clientes" />
    <!--start stepper one-->
    <div id="stepper1" class="bs-stepper">
        <div class="card">

            <div class="card-header">
                <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
                    <div class="step" data-target="#test-l-1">
                        <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                            <div class="bs-stepper-circle">1</div>
                            <div class="">
                                <h5 class="mb-0 steper-title">Informacion cliente</h5>
                                <p class="mb-0 steper-sub-title">Ingrese la informacion del clientes</p>
                            </div>
                        </div>
                    </div>
                    <div class="bs-stepper-line"></div>
                    <div class="step" data-target="#test-l-2">
                        <div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                            <div class="bs-stepper-circle">2</div>
                            <div class="">
                                <h5 class="mb-0 steper-title">Datos de contacto</h5>
                                <p class="mb-0 steper-sub-title">Agrega los datos de contacto</p>
                            </div>
                        </div>
                    </div>

                    <div class="bs-stepper-line"></div>
                    <div class="step" data-target="#test-l-3">
                        <div class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-2">
                            <div class="bs-stepper-circle">3</div>
                            <div class="">
                                <h5 class="mb-0 steper-title">Asociar Empleado que atiende</h5>
                                <p class="mb-0 steper-sub-title">Agrega los empleados que atienden</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card-body">

                <div class="bs-stepper-content">
                    <form id="formClient" onSubmit="return false">
                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                            <h5 class="mb-1">Informacion cliente</h5>
                            <p class="mb-4">Ingrese la información del cliente</p>
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="person_type_id" class="form-label">Tipo Persona</label>
                                    <select name="person_type_id" id="person_type_id" class="form-control">
                                        <option value="">Seleccione...</option>
                                        @foreach ($person_type as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="document_type_id" class="form-label">Tipo documento</label>
                                    <select name="document_type_id" id="document_type_id" class="form-control">
                                        <option value="">Seleccione...</option>
                                        @foreach ($document_type as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="nit" class="form-label">NIT/Identificacion</label>
                                    <input type="text" class="form-control" id="nit" name="nit"
                                        placeholder="Ingrese Nit">
                                </div>
                                <div class="col-md-6">
                                    <label for="company_name" class="form-label">Razon social/Nombre</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name"
                                        placeholder="Ingrese Razon Social">
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Ingrese Dirección">
                                </div>
                                <div class="col-md-6">
                                    <label for="email_company" class="form-label">Email</label>
                                    <input type="email_company" class="form-control" id="email_company"
                                        name="email_company" placeholder="Ingrese Dirección">
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <div class="form-check form-switch form-check-info">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="vat_responsible" name="vat_responsible">
                                        <label class="form-check-label" for="vat_responsible">Responsable de IVA</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check form-switch form-check-info">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="is_selfretaining" name="is_selfretaining">
                                        <label class="form-check-label" for="is_selfretaining">Es autorretenedor?</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check form-switch form-check-info">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="is_simple_taxation_regime" name="is_simple_taxation_regime">
                                        <label class="form-check-label" for="is_simple_taxation_regime">Es Regimen
                                            Simple?</label>
                                    </div>
                                </div>
                                <div class="col-md-12 row g-3">
                                    <div class="col-md-3">
                                        <div class="form-check form-switch form-check-info">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="is_ica_withholding_agent" name="is_ica_withholding_agent">
                                            <label class="form-check-label" for="is_ica_withholding_agent">Es Agente
                                                retenedor
                                                de
                                                ICA
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="municipality_ica_withholding_agent" class="form-label">Municipio en el
                                            cual es
                                            agente retenedor</label>
                                        <input type="text" class="form-control"
                                            name="municipality_ica_withholding_agent"
                                            id="municipality_ica_withholding_agent" placeholder="Ingrese municipio">
                                    </div>
                                </div>
                                <div class="col-md-12 row g-4">
                                    <div class="col-md-3">
                                        <div class="form-check form-switch form-check-info">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="is_ica_selfretaining_agent" name="is_ica_selfretaining_agent">
                                            <label class="form-check-label" for="is_ica_selfretaining_agent">Es Agente
                                                Autoretenedor de
                                                ICA
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="municipality_ica_selfretaining_agent" class="form-label">Municipio en
                                            el
                                            cual es
                                            agente Autoretenedor</label>
                                        <input type="text" class="form-control"
                                            name="municipality_ica_selfretaining_agent"
                                            id="municipality_ica_selfretaining_agent" placeholder="Ingrese municipio">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="category" class="form-label">Categoria (prioridad)</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="ALTA">ALTA</option>
                                        <option value="MEDIA">MEDIA</option>
                                        <option value="BAJA">BAJA</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="review" class="form-label">Reseña</label>
                                    <textarea class="form-control" id="review" name="review" placeholder="Ingrese Reseña" rows="3"></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="observation" class="form-label">Observaciones</label>
                                    <textarea class="form-control" id="observation" name="observation" placeholder="Ingrese observaciones."
                                        rows="3"></textarea>
                                </div>
                                <div class="col-12 col-lg-12 text-end">
                                    <button class="btn btn-primary px-4" onclick="stepper1.next()">
                                        Siguiente<i class='bx bx-right-arrow-alt ms-2'></i>
                                    </button>
                                </div>
                            </div><!---end row-->

                        </div>
                        <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">

                            <h5 class="mb-1">Informacion de contacto</h5>
                            <p class="mb-4">Ingrese la información de contacto</p>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="firstname" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        placeholder="Ingrese Nombres">
                                </div>
                                <div class="col-md-6">
                                    <label for="lastname" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        placeholder="Ingrese Apellidos">
                                </div>
                                <div class="col-md-6">
                                    <label for="birthday" class="form-label">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday"
                                        placeholder="fecha de nacimiento">
                                </div>
                                <div class="col-md-6">
                                    <label for="job_title" class="form-label">Cargo</label>
                                    <input type="text" class="form-control" id="job_title" name="job_title"
                                        placeholder="Ingrese Cargo">
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Ingrese Correo">
                                </div>
                                <div class="col-md-6">
                                    <label for="cellphone" class="form-label">Celular</label>
                                    <input type="text" class="form-control" id="cellphone" name="cellphone"
                                        placeholder="Ingrese Celular">
                                </div>
                                <div class="col-md-6">
                                    <label for="cellphone" class="form-label">Seleccione Medio de comunicacion
                                        preferido</label>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="emailCheck"
                                            name="channel_communication[]" value="email">
                                        <label class="form-check-label" for="emailCheck">Correo</label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="whatsappCheck"
                                            name="channel_communication[]" value="whatsapp">
                                        <label class="form-check-label" for="whatsappCheck">WhatsApp</label>
                                    </div>
                                </div>
                                <div class="col-md-12 " id="typeJuridic" style="display:none">
                                    <button id="add-row" class="btn btn-primary px-4 w-100">Agregar</button>

                                    <div class="table-responsive mt-2">
                                        <table class="table table-bordered table-striped" id="contact-table">
                                            <thead>
                                                <tr>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Fecha de nacimiento</th>
                                                    <th>Cargo</th>
                                                    <th>Medio de contacto</th>
                                                    <th>Correo</th>
                                                    <th>Celular</th>
                                                    <th>Eliminar</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <!-- Botón Anterior alineado a la izquierda -->
                                        <button class="btn btn-primary px-4" onclick="stepper1.previous()">
                                            <i class='bx bx-left-arrow-alt me-2'></i>Anterior
                                        </button>

                                        <!-- Botón Guardar o Siguiente alineado a la derecha -->
                                        <button class="btn btn-success px-4" onclick="stepper1.next()">Siguiente</button>
                                    </div>

                                </div>
                            </div><!---end row-->
                        </div>
                        <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">

                            <h5 class="mb-1">Asociar Empleado que atiende</h5>
                            <p class="mb-4">Agregue los empleados que pueden atender </p>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="employee_id" class="form-label">Empleado que atiende</label>
                                    <select name="employee_id" id="employee_id" class="form-control">
                                        <option value="">Seleccione...</option>
                                        @foreach ($employees as $item)
                                            <option value="{{ $item->id }}">{{ $item->firstname }}
                                                {{ $item->lastname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <!-- Botón Anterior alineado a la izquierda -->
                                        <button class="btn btn-primary px-4" onclick="stepper1.previous()">
                                            <i class='bx bx-left-arrow-alt me-2'></i>Anterior
                                        </button>

                                        <!-- Botón Guardar o Siguiente alineado a la derecha -->
                                        <button class="btn btn-success px-4" id="saveClient">Guardar</button>
                                    </div>
                                </div>
                            </div><!---end row-->
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--end stepper one-->
@endsection
@section('scripts')
    <script src="{{ URL::asset('dist/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <script src="{{ URL::asset('dist/plugins/bs-stepper/js/main.js') }}"></script>
    <script src="{{ URL::asset('dist/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('dist/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        var stepper1
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar el Stepper principal
            stepper1 = new Stepper(document.querySelector('#stepper1'));

            var stepperFormEl = document.querySelector('#formClient');
            stepperForm = new Stepper(stepperFormEl, {
                animation: true
            });

            var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'));
            var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'));
            var form = stepperFormEl.querySelector('.bs-stepper-content form');


            // Avanzar al siguiente paso del wizard
            btnNextList.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    stepperForm.next();
                });
            });

            // Evento que se ejecuta al mostrar un nuevo paso
            stepperFormEl.addEventListener('show.bs-stepper', function(event) {
                form.classList.remove('was-validated');
                var nextStep = event.detail.indexStep;
                var currentStep = nextStep;

                if (currentStep > 0) {
                    currentStep--;

                }

                var stepperPan = stepperPanList[currentStep];

                // Actualizar el dropdownParent de Select2 al contenedor del paso visible
                // $('#employee_id').select2({
                //     theme: 'bootstrap-5',
                //     placeholder: "Selecciona opciones",
                //     allowClear: true,
                //     closeOnSelect: false, // No cierra el menú al seleccionar una opción
                //     // Contenedor del paso actual
                // });
            });
            $('#person_type_id').select2();
            // Captura el evento de cambio
            $('#person_type_id').on('change', function() {
                const personType = $(this).val();
                const typeJuridic = document.getElementById('typeJuridic');
                if (personType === "2") { // Jurídica
                    typeJuridic.style.display = 'block'; // Mostrar el elemento
                } else {
                    typeJuridic.style.display = 'none'; // Ocultar el elemento
                }
            });

            $('#add-row').on('click', function(e) {
                e.preventDefault();

                // Obtener valores de los campos
                const firstname = $('#firstname').val();
                const lastname = $('#lastname').val();
                const jobTitle = $('#job_title').val();
                const email = $('#email').val();
                const cellphone = $('#cellphone').val();
                const birthday = $('#birthday').val();
                const channelCommunication = [];
                $('input[name="channel_communication[]"]:checked').each(function() {
                    channelCommunication.push($(this).val());
                });

                if (firstname && lastname && email && cellphone) {
                    // Agregar fila a la tabla
                    $('#contact-table tbody').append(`
                        <tr>
                            <td>${firstname}</td>
                            <td>${lastname}</td>
                            <td>${birthday}</td>
                            <td>${jobTitle}</td>
                            <td>${email}</td>
                            <td>${cellphone}</td>
                            <td>${channelCommunication.join(', ')}</td>
                            <td><button class="btn btn-danger btn-sm remove-row">Eliminar</button></td>
                        </tr>
                    `);

                    // Limpiar campos
                    $('#firstname, #lastname, #job_title, #email, #cellphone,#birthday')
                        .val('');
                    $('input[name="channel_communication[]"]').prop('checked', false);
                } else {
                    alert('Por favor, complete todos los campos requeridos.');
                }
            });
            // Eliminar fila de la tabla
            $('#contact-table').on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });
            $('#saveClient').on('click', function(e) {
                e.preventDefault();
                isLoading(true)

                const form = document.getElementById('formClient'); // Obtener el formulario
                const formData = new FormData(form); // Crear el objeto FormData

                const data = {};

                // Procesar los valores del formulario
                formData.forEach((value, key) => {
                    if (key === 'channel_communication[]') {
                        if (!data['channel_communication']) {
                            data['channel_communication'] = [];
                        }
                        data['channel_communication'].push(value); // Agregar valores seleccionados
                    } else if (value === "on") {
                        data[key] = true; // Convertir checkboxes marcados a booleano true
                    } else if (!formData.has(key) && $(`[name="${key}"]`).attr('type') ===
                        'checkbox') {
                        data[key] = false; // Convertir checkboxes no marcados a booleano false
                    } else {
                        data[key] = value; // Otros valores
                    }
                });
                // Agregar valores múltiples al objeto data
                const personType = $('#person_type_id').val();
                // Agregar contactos si el tipo de persona es jurídica
                if (personType === "2") {
                    data.contacts = [];
                    $('#contact-table tbody tr').each(function() {
                        const row = $(this).find('td');
                        const contact = {
                            firstname: row.eq(0).text(),
                            lastname: row.eq(1).text(),
                            birthday: row.eq(2).text(),
                            job_title: row.eq(3).text(),
                            email: row.eq(4).text(),
                            cellphone: row.eq(5).text(),
                            channel_communication: row.eq(6).text(),
                        };
                        data.contacts.push(contact);
                    });
                }

                console.log('Datos a enviar:', data);

                // Enviar los datos al servidor con AJAX
                $.ajax({
                    url: "{{ route('client.store') }}", // Cambiar por la URL de tu API
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function(response) {
                        console.log('Respuesta del servidor:', response);
                        isLoading(false);
                        Swal.fire({
                            icon: 'success',
                            title: 'Se ha creado el Cliente',
                            text: 'El Cliente se ha registrado exitosamente.',
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            // Redirigir a la página de creación de empleado
                            window.location.href = "{{ route('client.index') }}";
                        });
                    },
                    error: function(error) {
                        isLoading(false)
                        console.error('Error al guardar el cliente:', error);
                        alert('Hubo un error al guardar el cliente');
                    }
                });
            });



        });
    </script>
@endsection
