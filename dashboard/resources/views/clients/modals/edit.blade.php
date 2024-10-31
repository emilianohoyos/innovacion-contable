<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalle Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onSubmit="return false">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="person_type_id" class="form-label">Tipo Persona</label>
                            <select name="person_type_id" id="person_type_id" class="form-control">
                                <option value="NATURAL">NATURAL</option>
                                <option value="JURIDICA">JURIDICA</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nit" class="form-label">NIT/Identificacion</label>
                            <input type="text" class="form-control" id="nit" placeholder="Ingrese Nit">
                        </div>
                        <div class="col-md-6">
                            <label for="company_name" class="form-label">Razon social/Nombre</label>
                            <input type="text" class="form-control" id="company_name"
                                placeholder="Ingrese Razon Social">
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Ingrese Dirección">
                        </div>
                        <br>
                        <div class="col-md-4">



                            <div class="form-check form-switch form-check-info">
                                <input class="form-check-input" type="checkbox" role="switch" id="vat_responsible"
                                    name="vat_responsible">
                                <label class="form-check-label" for="vat_responsible">Responsable de IVA</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check form-switch form-check-info">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_selfretaining"
                                    name="is_selfretaining">
                                <label class="form-check-label" for="is_selfretaining">Es autorretenedor?</label>
                            </div>
                        </div>
                        <div class="col-md-4">
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
                            <div class="col-md-9">
                                <label for="municipality_ica_withholding_agent" class="form-label">Municipio en el
                                    cual es
                                    agente retenedor</label>
                                <input type="text" class="form-control" id="municipality_ica_withholding_agent"
                                    placeholder="Ingrese municipio">
                            </div>
                        </div>
                        <div class="col-md-12 row g-4">
                            <div class="col-md-3">
                                <div class="form-check form-switch form-check-info">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="is_ica_withholding_agent" name="is_ica_withholding_agent">
                                    <label class="form-check-label" for="is_ica_withholding_agent">Es Agente
                                        Autoretenedor de
                                        ICA
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <label for="municipality_ica_withholding_agent" class="form-label">Municipio en el
                                    cual es
                                    agente Autoretenedor</label>
                                <input type="text" class="form-control" id="municipality_ica_withholding_agent"
                                    placeholder="Ingrese municipio">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="employee_id" class="form-label">Empleado que atiende</label>
                            <select name="employee_id" id="employee_id" class="form-control">
                                <option value="Empleado 1">Empleado 1</option>
                                <option value="Empleado2">Empleado2</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="observation" class="form-label">Observaciones</label>
                            <textarea class="form-control" id="observation" name="observation" placeholder="Ingrese observaciones."
                                rows="3"></textarea>
                        </div>
                        <h5 class="mb-1">Informacion de contacto</h5>
                        <hr>
                        <div class="col-md-4">
                            <label for="firstname" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                placeholder="Ingrese Nombres">
                        </div>
                        <div class="col-md-4">
                            <label for="lastname" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                placeholder="Ingrese Apellidos">
                        </div>
                        <div class="col-md-4">
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
                        <div class="col-md-12">
                            <div class="container mt-4">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Nombres</th>
                                            <th scope="col">Apellidos</th>
                                            <th scope="col">Cargo</th>
                                            <th scope="col">Correo</th>
                                            <th scope="col">Celular</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="firstname_info">Nombre del usuario</td>
                                            <td id="lastname_info">Apellido del usuario</td>
                                            <td id="job_title_info">Cargo del usuario</td>
                                            <td id="email_info">Correo del usuario</td>
                                            <td id="cellphone_info">Celular del usuario</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
