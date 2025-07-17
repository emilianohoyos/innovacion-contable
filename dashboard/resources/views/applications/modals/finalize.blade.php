<!-- Modal -->
<div class="modal fade" id="finalizeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terminar Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onSubmit="return false">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            <input type="hidden" name="application_finalize_id" id="application_finalize_id">
                            <input type="hidden" name="state_id_terminado" id="state_id_terminado" value="4">

                            <div class="col-md-12 mt-3">
                                <label for="comentario_finalizacion" class="form-label">Comentario de
                                    finalización</label>
                                <textarea name="comentario_finalizacion" id="comentario_finalizacion" class="form-control" rows="2"
                                    placeholder="Ingrese un comentario"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="archivos_finalizacion" class="form-label">Adjuntar archivos
                                    (opcional)</label>
                                <input type="file" name="archivos_finalizacion[]" id="archivos_finalizacion"
                                    class="form-control" multiple>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary mt-1" onclick="finalizeApplication()">Finalizar
                        Aplicación</button>
                </div>
            </form>

        </div>
    </div>
</div>
