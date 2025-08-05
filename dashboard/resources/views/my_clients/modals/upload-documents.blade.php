<!-- Modal -->
<div class="modal fade" id="uploadDocumentsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Documentos de la carpeta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadDocumentForm" enctype="multipart/form-data">
                <input type="hidden" name="monthly_accounting_folder_upload_id"
                    id="monthly_accounting_folder_upload_id" value="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="documentType" class="form-label">Tipo de documento</label>
                        <select class="form-select" id="apply_document_type_id" name="apply_document_type_id" required
                            style="width:100%">
                            <option value="">Seleccione tipo de documento</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="documentFile" class="form-label">Archivo</label>
                        <input type="file" class="form-control" id="documentFile" name="document_file" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-success">Cargar documento</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

    });
</script>
