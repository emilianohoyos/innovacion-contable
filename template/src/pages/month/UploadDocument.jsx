import React from "react";
import { useParams } from "react-router-dom";
import { useUploadDocument } from "./hooks/useUploadDocument";
import { Link } from "react-router-dom";
import { ArrowLeft } from "feather-icons-react/build/IconComponents";

const UploadDocument = () => {
  const { folderId, documentTypeId } = useParams();
  const {
    folder,
    documentType,
    isLoading,
    isError,
    register,
    handleSubmit,
    errors,
    isSubmitting,
    onSubmit,
    selectedFile,
    handleFileChange
  } = useUploadDocument(folderId, documentTypeId);

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
                Error al cargar los datos. Por favor, intente nuevamente.
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
              <h4>Cargar Documento</h4>
              <h6>Carpeta: {folder?.name} - Documento: {documentType?.name}</h6>
            </div>
          </div>
          <div className="page-btn">
            <Link to={`/folder/${folderId}`} className="btn btn-added">
              <ArrowLeft className="me-2 iconsize" />
              Volver a la Carpeta
            </Link>
          </div>
        </div>

        <div className="card">
          <div className="card-body">
            <form onSubmit={handleSubmit(onSubmit)}>
              <div className="row">
                <div className="col-md-6">
                  <div className="form-group">
                    <label>Nombre del Documento</label>
                    <input
                      type="text"
                      className={`form-control ${errors.name ? 'is-invalid' : ''}`}
                      placeholder="Ingrese un nombre para el documento"
                      {...register('name', { required: 'Este campo es requerido' })}
                    />
                    {errors.name && (
                      <div className="invalid-feedback">{errors.name.message}</div>
                    )}
                  </div>
                </div>

                <div className="col-md-6">
                  <div className="form-group">
                    <label>Fecha del Documento</label>
                    <input
                      type="date"
                      className={`form-control ${errors.documentDate ? 'is-invalid' : ''}`}
                      {...register('documentDate', { required: 'Este campo es requerido' })}
                    />
                    {errors.documentDate && (
                      <div className="invalid-feedback">{errors.documentDate.message}</div>
                    )}
                  </div>
                </div>

                <div className="col-md-12">
                  <div className="form-group">
                    <label>Observaciones</label>
                    <textarea
                      className="form-control"
                      rows="4"
                      placeholder="Ingrese observaciones (opcional)"
                      {...register('observations')}
                    ></textarea>
                  </div>
                </div>

                <div className="col-md-12">
                  <div className="form-group">
                    <label>Archivo</label>
                    <div className="custom-file-container">
                      <input
                        type="file"
                        className={`form-control ${errors.file ? 'is-invalid' : ''}`}
                        onChange={handleFileChange}
                        accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png"
                      />
                      {errors.file && (
                        <div className="invalid-feedback">{errors.file.message}</div>
                      )}
                    </div>
                    {selectedFile && (
                      <div className="selected-file mt-2">
                        <span className="badge bg-info">{selectedFile.name}</span>
                      </div>
                    )}
                  </div>
                </div>

                <div className="col-md-12 text-end mt-4">
                  <button
                    type="submit"
                    className="btn btn-primary"
                    disabled={isSubmitting}
                  >
                    {isSubmitting ? (
                      <>
                        <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        Cargando...
                      </>
                    ) : (
                      'Cargar Documento'
                    )}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default UploadDocument;
