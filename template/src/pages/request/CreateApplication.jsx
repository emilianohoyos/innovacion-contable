import React from "react";
import { Link } from "react-router-dom";
import Select from "react-select";
import { all_routes } from "../../Router/all_routes";
import { useCreateApplication } from "./hooks/useCreateApplication";
import { ArrowLeft, PlusCircle, Trash2 } from "react-feather";
import { OverlayTrigger, Tooltip } from "react-bootstrap";
import DefaultEditor from "react-simple-wysiwyg";

const CreateApplication = () => {
    const route = all_routes;

    const {
        formData,
        errors,
        isSubmitting,
        isLoadingApplyTypes,
        isLoadingDocumentTypes,
        applyTypesOptions,
        documentTypes,
        handleChange,
        handleSelectChange,
        handleFileChange,
        handleRemoveFile,
        handleDocumentFileChange,
        handleRemoveDocumentFile,
        handleSubmit,
        resetForm
    } = useCreateApplication();

    const renderTooltip = (props, text) => (
        <Tooltip id="button-tooltip" {...props}>
            {text}
        </Tooltip>
    );

    return (
        <div className="page-wrapper">
            <div className="content">
                <div className="page-header">
                    <div className="add-item d-flex">
                        <div className="page-title">
                            <h4>Nueva Solicitud</h4>
                            <h6>Crear nueva solicitud</h6>
                        </div>

                    </div>
                </div>

                <form onSubmit={handleSubmit}>
                    <div className="card">
                        <div className="card-body">
                            <div className="row">
                                <div className="col-lg-12">
                                    <div className="form-group">
                                        <label>Tipo de Solicitud <span className="manitory">*</span></label>
                                        <Select
                                            className={`select ${errors.apply_type_id ? 'is-invalid' : ''}`}
                                            options={applyTypesOptions}
                                            placeholder="Seleccione un tipo de solicitud"
                                            isLoading={isLoadingApplyTypes}
                                            onChange={(option) => handleSelectChange(option, { name: 'apply_type_id' })}
                                            value={applyTypesOptions.find(option => option.value === formData.apply_type_id) || null}
                                        />
                                        {errors.apply_type_id && (
                                            <div className="invalid-feedback">{errors.apply_type_id}</div>
                                        )}

                                        {/* Mostrar información del tipo de solicitud seleccionado */}
                                        {formData.apply_type_id && (
                                            <div className="mt-3 p-3 bg-light border rounded">
                                                {(() => {
                                                    const selectedType = applyTypesOptions.find(option => option.value === formData.apply_type_id);
                                                    if (!selectedType) return null;

                                                    return (
                                                        <div className="row">
                                                            <div className="col-md-6">
                                                                <small className="text-muted">Fecha estimada de finalización:</small>
                                                                <div className="fw-bold text-primary">{selectedType.estimatedDate}</div>
                                                            </div>
                                                        </div>
                                                    );
                                                })()}
                                            </div>
                                        )}
                                    </div>
                                </div>

                                <div className="col-lg-12 mt-3">
                                    <div className="form-group">
                                        <label>Observaciones</label>
                                        <DefaultEditor name="observation" value={formData.observation} onChange={handleChange} />
                                    </div>
                                </div>

                                {/* Sección de documentos requeridos */}
                                {formData.apply_type_id && documentTypes.length > 0 && (
                                    <div className="col-lg-12 mt-3">
                                        <div className="form-group">
                                            <label>Documentos Requeridos</label>
                                            {isLoadingDocumentTypes && (
                                                <div className="text-center p-3">
                                                    <div className="spinner-border text-primary" role="status">
                                                        <span className="visually-hidden">Cargando...</span>
                                                    </div>
                                                </div>
                                            )}

                                            {!isLoadingDocumentTypes && documentTypes.map((docType) => (
                                                <div key={docType.id} className="document-type-section mb-4 p-3 border rounded">
                                                    <h6 className="mb-3">
                                                        <span className="badge bg-primary me-2">{docType.name}</span>
                                                        <span className="text-muted small">Requerido</span>
                                                    </h6>

                                                    <div className="custom-file-container">
                                                        <label className="custom-file-upload d-flex align-items-center">
                                                            <input
                                                                type="file"
                                                                className="custom-file-input"
                                                                multiple
                                                                onChange={(e) => {
                                                                    const files = Array.from(e.target.files);
                                                                    const existingFiles = formData.documentFiles[docType.id] || [];
                                                                    handleDocumentFileChange(docType.id, [...existingFiles, ...files]);
                                                                }}
                                                            />
                                                            <PlusCircle size={16} className="me-2" />
                                                            Seleccionar archivos para {docType.name}
                                                        </label>
                                                    </div>

                                                    {formData.documentFiles[docType.id] && formData.documentFiles[docType.id].length > 0 && (
                                                        <div className="file-preview mt-3">
                                                            <div className="file-list">
                                                                {formData.documentFiles[docType.id].map((file, index) => (
                                                                    <div key={index} className="file-item d-flex align-items-center justify-content-between p-2 border rounded mb-2 bg-light">
                                                                        <div className="file-info">
                                                                            <span className="file-name">{file.name}</span>
                                                                            <span className="file-size text-muted ms-2">({(file.size / 1024).toFixed(2)} KB)</span>
                                                                        </div>
                                                                        <OverlayTrigger
                                                                            placement="top"
                                                                            overlay={(props) => renderTooltip(props, "Eliminar archivo")}
                                                                        >
                                                                            <button
                                                                                type="button"
                                                                                className="btn btn-sm btn-danger"
                                                                                onClick={() => handleRemoveDocumentFile(docType.id, index)}
                                                                            >
                                                                                <Trash2 size={16} />
                                                                            </button>
                                                                        </OverlayTrigger>
                                                                    </div>
                                                                ))}
                                                            </div>
                                                        </div>
                                                    )}
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>

                    <div className="col-lg-12">
                        <div className="btn-addproduct mb-4">
                            <button
                                type="button"
                                className="btn btn-cancel me-2"
                                onClick={resetForm}
                                disabled={isSubmitting}
                            >
                                Cancelar
                            </button>
                            <button
                                type="submit"
                                className="btn btn-submit"
                                disabled={isSubmitting}
                            >
                                {isSubmitting ? 'Enviando...' : 'Guardar Solicitud'}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    );
};

export default CreateApplication;
