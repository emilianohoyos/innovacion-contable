<div class="modal fade" id="editApplyTypeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nameApplyType">Editar Tipo Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onSubmit="return false">
                @method('PUT')
                @csrf
                <input type="hidden" name="apply_type_id" id="apply_type_id">
                <div class="modal-body row">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Ingrese Nombre del tipo de solicitud"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="estimated_days" class="form-label">Días Estimados para la atención</label>
                        <input type="text" class="form-control @error('estimated_days') is-invalid @enderror"
                            id="estimated_days" name="estimated_days" placeholder="Ingrese Días Estimados"
                            value="{{ old('estimated_days') }}">
                        @error('estimated_days')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="priority" class="form-label">Prioridad </label>
                        <select name="priority" id="priority" class="form-control" required>
                            <option value="">Seleccione...</option>
                            <option value="ALTA">ALTA</option>
                            <option value="MEDIA">MEDIA</option>
                            <option value="BAJA">BAJA</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="destiny" class="form-label">Destino</label>
                        <select name="destiny" id="destiny" class="form-control" required>
                            <option value="">Seleccione...</option>
                            <option value="INTERNA">INTERNA</option>
                            <option value="EXTERNA">EXTERNA</option>
                            <option value="INTERNA\EXTERNA">INTERNA\EXTERNA</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-start">
                    <button type="button" class="btn btn-primary" onclick="actualizarApplyType()">Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                </div>
            </form>
        </div>
    </div>
</div>
