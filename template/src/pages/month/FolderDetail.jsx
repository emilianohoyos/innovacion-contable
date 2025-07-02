import React, { useState } from "react";
import { useParams, useLocation } from "react-router-dom";
import { useFolderDetail } from "./hooks/useFolderDetail";
import { Link } from "react-router-dom";
import { ArrowLeft, Upload, MessageSquare, Plus } from "feather-icons-react/build/IconComponents";
import Table from "../../core/pagination/datatable";

const FolderDetail = () => {
  const { folderId } = useParams();
  const location = useLocation();
  
  // Obtener los datos de la carpeta desde el estado de navegación o usar el hook
  const folderFromState = location.state?.folderData;
  
  const { 
    folder: folderFromApi, 
    isLoading, 
    isError, 
    columns 
  } = useFolderDetail(folderId);
  
  // Usar los datos de la carpeta del estado si están disponibles, de lo contrario usar los de la API
  const folder = folderFromState || folderFromApi;
  
  // Estado para los comentarios (simulado por ahora)
  const [comments, setComments] = useState([
    { id: 1, user: 'Admin', date: '2025-07-01', text: 'Por favor, sube los documentos pendientes.' },
    { id: 2, user: 'Usuario', date: '2025-07-01', text: 'Documentos en proceso de recopilación.' }
  ]);
  
  // Estado para el nuevo comentario
  const [newComment, setNewComment] = useState('');
  
  // Función para agregar un nuevo comentario
  const addComment = () => {
    if (newComment.trim() === '') return;
    
    const comment = {
      id: comments.length + 1,
      user: 'Usuario',
      date: new Date().toISOString().split('T')[0],
      text: newComment
    };
    
    setComments([...comments, comment]);
    setNewComment('');
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
                                <button className="btn btn-outline-primary">
                                  <Upload className="me-2" size={18} />
                                  Subir Documento
                                </button>
                                <input type="file" name="file" />
                              </div>
                              <p className="text-muted text-center mt-2 mb-0">
                                Formatos permitidos: PDF, JPG, PNG (Max: 5MB)
                              </p>
                            </div>
                            
                            {/* Lista de documentos subidos (simulado) */}
                            <div className="uploaded-files">
                              <h6 className="mb-2">Documentos Subidos</h6>
                              <div className="list-group">
                                <div className="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                  <div>
                                    <i className="far fa-file-pdf me-2 text-danger"></i>
                                    documento-ejemplo.pdf
                                  </div>
                                  <div>
                                    <button className="btn btn-sm btn-light me-1" title="Ver">
                                      <i className="far fa-eye"></i>
                                    </button>
                                    <button className="btn btn-sm btn-light" title="Eliminar">
                                      <i className="far fa-trash-alt"></i>
                                    </button>
                                  </div>
                                </div>
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
                  {comments.map(comment => (
                    <div key={comment.id} className="comment-item mb-3 p-3 border-bottom">
                      <div className="d-flex justify-content-between">
                        <strong>{comment.user}</strong>
                        <small className="text-muted">{comment.date}</small>
                      </div>
                      <p className="mb-0 mt-2">{comment.text}</p>
                    </div>
                  ))}
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
                  >
                    <Plus className="me-1" size={16} />
                    Agregar Comentario
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default FolderDetail;
