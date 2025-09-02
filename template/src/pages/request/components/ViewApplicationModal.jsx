import React from 'react';
import { Modal, Button } from 'react-bootstrap';
import { X } from 'react-feather';

const ViewApplicationModal = ({ show, onHide, application }) => {
  if (!application) return null;

  const stripHtml = (html) => {
    const tmp = document.createElement('div');
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || '';
  };

  const getStateClass = (stateId) => {
    switch(stateId) {
      case 1: return 'bg-warning text-dark';
      case 2: return 'bg-info';
      case 3: return 'bg-success';
      case 4: return 'bg-primary';
      case 5: return 'bg-danger';
      default: return 'bg-secondary';
    }
  };

  const rawData = application.raw_data || {};

  return (
    <Modal show={show} onHide={onHide} size="lg" centered>
      <Modal.Header className="d-flex justify-content-between align-items-center">
        <Modal.Title>Detalles de la Solicitud #{application.id}</Modal.Title>
        <Button variant="link" onClick={onHide} className="p-0">
          <X size={24} />
        </Button>
      </Modal.Header>
      <Modal.Body>
        <div className="row">
          <div className="col-md-6">
            <div className="mb-3">
              <label className="form-label fw-bold">ID de Solicitud:</label>
              <p className="mb-0">{application.id}</p>
            </div>
          </div>
          <div className="col-md-6">
            <div className="mb-3">
              <label className="form-label fw-bold">Tipo de Solicitud:</label>
              <p className="mb-0">{application.apply_type}</p>
            </div>
          </div>
        </div>

        <div className="row">
          <div className="col-md-6">
            <div className="mb-3">
              <label className="form-label fw-bold">Fecha de Solicitud:</label>
              <p className="mb-0">{application.application_date}</p>
            </div>
          </div>
          <div className="col-md-6">
            <div className="mb-3">
              <label className="form-label fw-bold">Fecha Estimada:</label>
              <p className="mb-0">{application.estimated_delivery_date}</p>
            </div>
          </div>
        </div>

        <div className="row">
          <div className="col-md-6">
            <div className="mb-3">
              <label className="form-label fw-bold">Estado:</label>
              <div>
                <span className={`badge ${getStateClass(application.state_id)}`}>
                  {application.state}
                </span>
              </div>
            </div>
          </div>
          <div className="col-md-6">
            <div className="mb-3">
              <label className="form-label fw-bold">Archivos Adjuntos:</label>
              <p className="mb-0">
                <span className="badge bg-light text-dark">
                  {application.attachments_count} archivo{application.attachments_count !== 1 ? 's' : ''}
                </span>
              </p>
            </div>
          </div>
        </div>

        <div className="mb-3">
          <label className="form-label fw-bold">Observaciones:</label>
          <div className="p-3 bg-light border rounded">
            {application.full_observations ? (
              <div dangerouslySetInnerHTML={{ __html: application.full_observations }} />
            ) : (
              <p className="mb-0 text-muted">Sin observaciones</p>
            )}
          </div>
        </div>

        {rawData.attachments && rawData.attachments.length > 0 && (
          <div className="mb-3">
            <label className="form-label fw-bold">Archivos por Tipo de Documento:</label>
            <div className="border rounded p-3">
              {rawData.attachments.reduce((acc, attachment) => {
                const docType = attachment.apply_document_type?.name || 'Sin tipo';
                if (!acc[docType]) {
                  acc[docType] = [];
                }
                acc[docType].push(attachment);
                return acc;
              }, {}) && Object.entries(rawData.attachments.reduce((acc, attachment) => {
                const docType = attachment.apply_document_type?.name || 'Sin tipo';
                if (!acc[docType]) {
                  acc[docType] = [];
                }
                acc[docType].push(attachment);
                return acc;
              }, {})).map(([docType, files]) => (
                <div key={docType} className="mb-3">
                  <h6 className="text-primary">{docType}</h6>
                  <ul className="list-unstyled ms-3">
                    {files.map((file, index) => (
                      <li key={index} className="mb-1">
                        <small className="text-muted">• Archivo {index + 1}</small>
                      </li>
                    ))}
                  </ul>
                </div>
              ))}
            </div>
          </div>
        )}
      </Modal.Body>
      <Modal.Footer>
        <Button variant="secondary" onClick={onHide}>
          Cerrar
        </Button>
      </Modal.Footer>
    </Modal>
  );
};

export default ViewApplicationModal;
