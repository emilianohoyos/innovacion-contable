import React from "react";
import { useParams } from "react-router-dom";
import { useFolderDetail } from "./hooks/useFolderDetail";
import { Link } from "react-router-dom";
import { ArrowLeft } from "feather-icons-react/build/IconComponents";
import Table from "../../core/pagination/datatable";

const FolderDetail = () => {
  const { folderId } = useParams();
  const { 
    folder, 
    isLoading, 
    isError, 
    columns 
  } = useFolderDetail(folderId);

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

        <div className="card">
          <div className="card-header">
            <h5>Tipos de Documentos</h5>
          </div>
          <div className="card-body">
            <div className="table-responsive">
              <Table
                columns={columns}
                dataSource={folder?.document_types || []}
                loading={isLoading}
                rowKey="id"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default FolderDetail;
