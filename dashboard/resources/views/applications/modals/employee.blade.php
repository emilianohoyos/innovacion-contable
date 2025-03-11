<!-- Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambio Empleado que atiende</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onSubmit="return false">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            <input type="hidden" name="application_id" id="application_id">
                            <div class="col-md-12">
                                <label for="employee_id" class="form-label">Cambiar Empleado aignado</label>
                                <select name="employee_id" id="employee_id" class="form-control">
                                    @foreach ($employee as $item)
                                        <option value="{{ $item->id }}">{{ $item->firstname }}{{ $item->lastname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary mt-1" onclick="updateEmployee()">Actualizar
                        Empleado</button>
                </div>
            </form>

        </div>
    </div>
</div>
