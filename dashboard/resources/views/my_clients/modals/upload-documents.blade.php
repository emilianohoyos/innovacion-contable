<!-- Modal -->
<div class="modal fade" id="uploadDocumentsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Documentos de la carpeta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadDocumentForm" enctype="multipart/form-data"
                onsubmit="return submitMultipleDocuments(event)">
                <input type="hidden" name="monthly_accounting_folder_upload_id"
                    id="monthly_accounting_folder_upload_id" value="">
                <div class="modal-body">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-5">
                            <label for="apply_document_type_id" class="form-label">Tipo de documento</label>
                            <select class="form-select" id="apply_document_type_id" style="width:100%">
                                <option value="">Seleccione tipo de documento</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="documentFile" class="form-label">Archivo</label>
                            <input type="file" class="form-control" id="documentFile">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary w-100"
                                onclick="addDocumentRow()">Agregar</button>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle" id="documentsTablePreview">
                            <thead>
                                <tr>
                                    <th>Tipo de documento</th>
                                    <th>Archivo</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Filas dinámicas -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-success">Cargar documentos</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Estado temporal de documentos a cargar
    let documentsToUpload = [];

    function loadDocumentTypes() {
        const folderId = document.getElementById('monthly_accounting_folder_upload_id').value;
        const select = document.getElementById('apply_document_type_id');
        select.innerHTML = '<option value="">Cargando...</option>';
        fetch('/monthly-accounting-folder/doctype/' + encodeURIComponent(folderId))
            .then(response => response.json())
            .then(data => {
                select.innerHTML = '<option value="">Seleccione tipo de documento</option>';
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.apply_document_type_id;
                    option.textContent = item.name;
                    select.appendChild(option);
                });
            })
            .catch(() => {
                select.innerHTML = '<option value="">Error al cargar</option>';
            });
    }

    function addDocumentRow() {
        const select = document.getElementById('apply_document_type_id');
        const fileInput = document.getElementById('documentFile');
        const typeId = select.value;
        const typeText = select.options[select.selectedIndex]?.text || '';
        const file = fileInput.files[0];

        if (!typeId || !file) {
            alert('Seleccione tipo de documento y archivo.');
            return;
        }

        // Agregar al array temporal
        documentsToUpload.push({
            typeId,
            typeText,
            file
        });
        renderDocumentsTable();
        // Limpiar campos
        select.value = '';
        fileInput.value = '';
    }

    function renderDocumentsTable() {
        const tbody = document.querySelector('#documentsTablePreview tbody');
        tbody.innerHTML = '';
        documentsToUpload.forEach((doc, idx) => {
            const row = document.createElement('tr');
            row.innerHTML = `
            <td>${doc.typeText}</td>
            <td>${doc.file.name}</td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeDocumentRow(${idx})">Eliminar</button></td>
        `;
            tbody.appendChild(row);
        });
    }

    function removeDocumentRow(idx) {
        documentsToUpload.splice(idx, 1);
        renderDocumentsTable();
    }

    function submitMultipleDocuments(event) {
        event.preventDefault();
        if (documentsToUpload.length === 0) {
            alert('Agregue al menos un documento.');
            return false;
        }
        const folderId = document.getElementById('monthly_accounting_folder_upload_id').value;
        const formData = new FormData();
        formData.append('monthly_accounting_folder_upload_id', folderId);
        documentsToUpload.forEach((doc, idx) => {
            formData.append(`documents[${idx}][apply_document_type_id]`, doc.typeId);
            formData.append(`documents[${idx}][file]`, doc.file);
        });

        fetch('/client-montly-accounting-data-upload', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    alert('Documentos cargados exitosamente');
                    documentsToUpload = [];
                    renderDocumentsTable();
                    document.getElementById('uploadDocumentsModal').classList.remove('show');
                    document.body.classList.remove('modal-open');
                    // Opcional: cerrar modal con Bootstrap
                    var modal = bootstrap.Modal.getInstance(document.getElementById('uploadDocumentsModal'));
                    if (modal) modal.hide();
                } else {
                    alert(data.message || 'Error al cargar documentos');
                }
            })
            .catch(() => {
                alert('Error al cargar documentos');
            });
        return false;
    }

    // Llama a la función cada vez que se abra el modal
    document.getElementById('uploadDocumentsModal').addEventListener('show.bs.modal', function() {
        loadDocumentTypes();
        documentsToUpload = [];
        renderDocumentsTable();
    });
</script>
