import React, { useState, useEffect } from "react";
import { useParams, useLocation } from "react-router-dom";
import { useFolderDetail } from "./hooks/useFolderDetail";
import { useMonthlyComments } from "./hooks/useMonthlyComments";
import { useFileAttachments } from "./hooks/useFileAttachments";
import { Link } from "react-router-dom";
import { ArrowLeft, Upload, MessageSquare, Plus, Eye, Trash2, FileText } from "feather-icons-react/build/IconComponents";
import { format } from "date-fns";
import {  BASE_PATH_HTTP } from "../../hooks/useDataFetch";

const FolderDetail = () => {
  const { folderId, year, month } = useParams();
  const location = useLocation();

  const {
    folder: folderFromApi,
    isLoading,
    data,
    isError,
    refreshFolder,
    findRegisteredDocument,
    findRegisteredDocuments,
    refetch
  } = useFolderDetail(folderId, month, year);

  console.log("data", data);

  // Hooks para comentarios y archivos
  const {
    comments,
    isLoading: isLoadingComments,
    isSubmitting: isSubmittingComment,
    fetchComments,
    createComment
  } = useMonthlyComments();

  const {
    isUploading,
    uploadFile,
    uploadFiles
  } = useFileAttachments();

  // Usar los datos de la carpeta del estado si están disponibles, de lo contrario usar los de la API
  const folder = folderFromApi;

  // Validación para permitir subida de archivos
  const canUploadFiles = data?.previous_month?.is_before_end_date === true;
  const uploadEndDate = data?.previous_month?.end_date;

  // Estado para el nuevo comentario
  const [newComment, setNewComment] = useState('');

  // Estado para archivos seleccionados por tipo de documento
  const [selectedFiles, setSelectedFiles] = useState({});

  // Cargar comentarios cuando se monta el componente o cambia el folderId
  useEffect(() => {
    if (folderFromApi?.monthly_config?.id) {
      fetchComments(folderFromApi?.monthly_config?.id);
    }
  }, [folderFromApi?.monthly_config?.id]);

  // Función para agregar un nuevo comentario
  const addComment = async () => {
    if (newComment.trim() === '') return;

    const success = await createComment(folderFromApi?.monthly_config?.id, newComment.trim());
    if (success) {
      setNewComment('');
    }
  };

  // Función para manejar la selección de múltiples archivos
  const handleFileSelect = (documentTypeId, event) => {
    const files = Array.from(event.target.files);
    if (files.length > 0) {
      setSelectedFiles(prev => ({
        ...prev,
        [documentTypeId]: files
      }));
    }
  };

  // Función para subir múltiples archivos
  const handleFileUpload = async (documentTypeId) => {
    // Validar si se pueden subir archivos
    if (!canUploadFiles) {
      alert(`No se pueden subir archivos. El período de carga finalizó el ${uploadEndDate ? new Date(uploadEndDate).toLocaleDateString('es-ES') : 'fecha límite'}.`);
      return;
    }

    const files = selectedFiles[documentTypeId];
    if (!files || files.length === 0) {
      return;
    }

    const success = await uploadFiles(folderId, documentTypeId, files, month, year, folderFromApi?.monthly_config?.id);
    if (success) {
      refetch();
      // Limpiar archivos seleccionados y refrescar datos
      setSelectedFiles(prev => ({
        ...prev,
        [documentTypeId]: []
      }));
      // Refrescar la carpeta para mostrar los nuevos archivos
      if (refreshFolder) {
        refreshFolder();
      }
    }
  };

  // Función para remover un archivo específico de la selección
  const removeSelectedFile = (documentTypeId, fileIndex) => {
    setSelectedFiles(prev => ({
      ...prev,
      [documentTypeId]: prev[documentTypeId]?.filter((_, index) => index !== fileIndex) || []
    }));
  };

  // Función para formatear fecha de comentarios
  const formatCommentDate = (dateString) => {
    return new Date(dateString).toLocaleString('es-ES', {
      year: 'numeric',
      month: 'short',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    });
  };

  if (isLoading) {
    return (
      <div className="page-wrapper">
        <div className="content container-fluid">
          <div className="card">
            <div className="card-body d-flex justify-content-center">
              <div className="spinner-border" role="status">
                <span className="visually-hidden">Cargando...</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  if (isError) {
    return (
      <div className="page-wrapper">
        <div className="content container-fluid">
          <div className="card">
            <div className="card-body">
              <div className="alert alert-danger">
                Error al cargar los detalles de la carpeta. Por favor, intente nuevamente.
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="page-wrapper">
      <div className="content container-fluid">
        <div className="page-header">
          <div className="add-item d-flex">
            <div className="page-title">
              <h4>{folder?.name || 'Detalles de Carpeta'}</h4>
              <h6>Periodicidad: {folder?.periodicity || 'N/A'}</h6>
            </div>
          </div>
          <div className="page-btn">
            <Link to="/month" className="btn btn-added">
              <ArrowLeft className="me-2 iconsize" />
              Volver a Carpetas
            </Link>
          </div>
        </div>

        <div className="row">
          {/* Columna izquierda - Acordeón con tipos de documentos */}
          <div className="col-xl-7 col-lg-6">
            <div className="card">
              <div className="card-header">
                <h5 className="d-flex align-items-center">
                  <span className="me-2">Tipos de Documentos</span>
                </h5>
              </div>
              <div className="card-body">
                <div className="accordion" id="documentTypesAccordion">
                  {folder?.document_types?.map((docType, index) => (
                    <div className="accordion-item" key={docType.id}>
                      <h2 className="accordion-header" id={`heading${docType.id}`}>
                        <button
                          className={`accordion-button ${index === 0 ? '' : 'collapsed'}`}
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target={`#collapse${docType.id}`}
                          aria-expanded={index === 0 ? 'true' : 'false'}
                          aria-controls={`collapse${docType.id}`}
                        >
                          <div className="d-flex justify-content-between w-100 align-items-center">
                            <span>{docType.name}</span>
                            {docType.is_required === 1 && (
                              <span className="badge bg-danger ms-2">Requerido</span>
                            )}
                          </div>
                        </button>
                      </h2>
                      <div
                        id={`collapse${docType.id}`}
                        className={`accordion-collapse collapse ${index === 0 ? 'show' : ''}`}
                        aria-labelledby={`heading${docType.id}`}
                        data-bs-parent="#documentTypesAccordion"
                      >
                        <div className="accordion-body">
                          <div className="document-upload-area">
                            <div className="document-upload-box mb-3 p-3 border rounded">
                              <div className="upload-btn-wrapper text-center">
                                <input
                                  type="file"
                                  id={`file-${docType.id}`}
                                  className="d-none"
                                  accept=".pdf,.jpg,.jpeg,.png,.gif,.bmp,.webp,.tiff,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.odt,.ods,.odp,.txt,.csv,.rtf,.zip"
                                  multiple
                                  disabled={!canUploadFiles}
                                  onChange={(e) => handleFileSelect(docType.id, e)}
                                />
                                <label
                                  htmlFor={`file-${docType.id}`}
                                  className={`btn mb-2 ${canUploadFiles ? 'btn-outline-primary' : 'btn-outline-secondary'}`}
                                  style={{ cursor: canUploadFiles ? 'pointer' : 'not-allowed' }}
                                >
                                  <Upload className="me-1" size={16} />
                                  {canUploadFiles ? 'Seleccionar Archivo' : 'Período de carga finalizado'}
                                </label>

                                {selectedFiles[docType.id] && selectedFiles[docType.id].length > 0 && (
                                  <div className="mt-2">
                                    <div className="mb-2">
                                      <small className="text-success fw-bold">
                                        {selectedFiles[docType.id].length} archivo{selectedFiles[docType.id].length !== 1 ? 's' : ''} seleccionado{selectedFiles[docType.id].length !== 1 ? 's' : ''}:
                                      </small>
                                      <div className="selected-files-list mt-2">
                                        {selectedFiles[docType.id].map((file, index) => (
                                          <div key={index} className="d-flex align-items-center justify-content-between p-2 border rounded mb-1 bg-light">
                                            <div>
                                              <small className="text-dark">{file.name}</small>
                                              <small className="text-muted ms-2">({(file.size / 1024).toFixed(2)} KB)</small>
                                            </div>
                                            <button
                                              type="button"
                                              className="btn btn-sm btn-outline-danger"
                                              onClick={() => removeSelectedFile(docType.id, index)}
                                              title="Remover archivo"
                                            >
                                              <Trash2 size={12} />
                                            </button>
                                          </div>
                                        ))}
                                      </div>
                                    </div>
                                    <button
                                      className="btn btn-primary btn-sm"
                                      onClick={() => handleFileUpload(docType.id)}
                                      disabled={isUploading || !canUploadFiles}
                                    >
                                      {isUploading ? (
                                        <>
                                          <span className="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                          Subiendo...
                                        </>
                                      ) : (
                                        <>
                                          <Upload className="me-1" size={14} />
                                          Subir Archivos ({selectedFiles[docType.id]?.length || 0})
                                        </>
                                      )}
                                    </button>
                                  </div>
                                )}
                              </div>
                              {!canUploadFiles && (
                                <div className="alert alert-warning text-center mt-2 mb-2">
                                  <strong>⚠️ Período de carga finalizado</strong><br />
                                  <small>La fecha límite para subir archivos fue el {uploadEndDate ? new Date(uploadEndDate).toLocaleDateString('es-ES') : 'fecha establecida'}.</small>
                                </div>
                              )}
                              <p className="text-muted text-center mt-2 mb-0">
                                <strong>Formatos permitidos:</strong><br />
                                • PDF<br />
                                • Imágenes: JPG, PNG, GIF, BMP, WEBP, TIFF<br />
                                • Office: Word (.doc/.docx), Excel (.xls/.xlsx), PowerPoint (.ppt/.pptx)<br />
                                • LibreOffice: ODT, ODS, ODP<br />
                                • Texto: TXT, CSV, RTF<br />
                                • Comprimidos: ZIP<br />
                                <small>(Máximo: 10MB por archivo)</small>
                              </p>
                            </div>

                            {/* Lista de documentos subidos */}
                            <div className="uploaded-files">
                              <h6 className="mb-2">Documentos Registrados</h6>
                              <div className="list-group">
                                {(() => {
                                  const registeredDocs = findRegisteredDocuments(folder, docType.id);
                                  if (!registeredDocs || registeredDocs.length === 0) {
                                    return (
                                      <div className="list-group-item text-center text-muted">
                                        <p className="mb-0">No hay documentos registrados</p>
                                      </div>
                                    );
                                  }

                                  return registeredDocs.map((registeredDoc, index) => {
                                    if (!registeredDoc.path || registeredDoc.path === "") {
                                      return null;
                                    }

                                    // Extraer el nombre del archivo de la ruta
                                    const fileName = registeredDoc.path.split('/').pop() || 'documento';
                                    const fileExt = fileName.split('.').pop().toLowerCase();
                                    const isImage = ['jpg', 'jpeg', 'png', 'gif'].includes(fileExt);
                                    const isPdf = fileExt === 'pdf';

                                    // Formatear fecha
                                    const createdAt = registeredDoc.created_at ?
                                      format(new Date(registeredDoc.created_at), 'dd/MM/yyyy HH:mm') : 'N/A';

                                    return (
                                      <div key={registeredDoc.id || index} className="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <div>
                                          {isPdf ? (
                                            <FileText className="me-2 text-danger" size={16} />
                                          ) : isImage ? (
                                            <i className="far fa-file-image me-2 text-primary"></i>
                                          ) : (
                                            <i className="far fa-file me-2 text-secondary"></i>
                                          )}
                                          <span className="me-2">{fileName}</span>
                                          <small className="text-muted">({createdAt})</small>
                                          {registeredDoc.status && (
                                            <span className={`badge ms-2 ${registeredDoc.status === 'APPROVED' ? 'bg-success' :
                                              registeredDoc.status === 'REJECTED' ? 'bg-danger' : 'bg-warning'}`}>
                                              {registeredDoc.status === 'APPROVED' ? 'Aprobado' :
                                                registeredDoc.status === 'REJECTED' ? 'Rechazado' : registeredDoc.status}
                                            </span>
                                          )}
                                        </div>
                                        <div>
                                          <button
                                            className="btn btn-sm btn-light me-1"
                                            title="Ver"
                                            onClick={() => window.open(`${BASE_PATH_HTTP}/application/download/${registeredDoc.path}`, '_blank')}
                                          >
                                            <Eye size={14} />
                                          </button>
                                        </div>
                                      </div>
                                    );
                                  }).filter(Boolean);
                                })()}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>

          {/* Columna derecha - Comentarios */}
          {folderFromApi?.monthly_config ?
            <div className="col-xl-5 col-lg-6">
              <div className="card">
                <div className="card-header">
                  <h5 className="d-flex align-items-center">
                    <MessageSquare className="me-2" size={18} />
                    Comentarios
                  </h5>
                </div>
                <div className="card-body">
                  <div className="comments-area" style={{ maxHeight: '400px', overflowY: 'auto' }}>
                    {isLoadingComments ? (
                      <div className="text-center p-3">
                        <div className="spinner-border text-primary" role="status">
                          <span className="visually-hidden">Cargando comentarios...</span>
                        </div>
                      </div>
                    ) : comments.length === 0 ? (
                      <div className="text-center p-4 text-muted">
                        <MessageSquare size={48} className="mb-2 opacity-50" />
                        <p>No hay comentarios para esta carpeta.</p>
                        <small>Sé el primero en agregar un comentario.</small>
                      </div>
                    ) : (
                      comments.map(comment => (
                        <div key={comment.id} className="comment-item mb-3 p-3 border-bottom">
                          <div className="d-flex justify-content-between">
                            <strong className="text-primary">
                              {comment.created_by?.name || comment.user || 'Usuario'}
                            </strong>
                            <small className="text-muted">
                              {formatCommentDate(comment.created_at || comment.date)}
                            </small>
                          </div>
                          <p className="mb-0 mt-2">{comment.comment || comment.text}</p>
                        </div>
                      ))
                    )}
                  </div>

                  <div className="add-comment-area mt-3">
                    <div className="form-group">
                      <textarea
                        className="form-control"
                        rows="3"
                        placeholder="Escribe un comentario..."
                        value={newComment}
                        onChange={(e) => setNewComment(e.target.value)}
                      ></textarea>
                    </div>
                    <button
                      className="btn btn-primary mt-2"
                      onClick={addComment}
                      disabled={!newComment.trim() || isSubmittingComment}
                    >
                      {isSubmittingComment ? (
                        <>
                          <span className="spinner-border spinner-border-sm me-2" role="status"></span>
                          Enviando...
                        </>
                      ) : (
                        <>
                          <Plus className="me-1" size={16} />
                          Agregar Comentario
                        </>
                      )}
                    </button>
                  </div>
                </div>
              </div>
            </div> : null}
        </div>
      </div>
    </div>
  );
};

export default FolderDetail;
