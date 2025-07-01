import React, { useState } from "react";
import ImageWithBasePath from "../../core/img/imagewithbasebath";
import { useFoldersData } from "./hooks/useFoldersData";
import { Link } from "react-router-dom";
import { all_routes } from "../../Router/all_routes";
import { Folder, Calendar, ChevronRight } from "react-feather";
import { useMonths } from "./hooks/useMonths";
import "./styles/month.css";


const Month = () => {
  // Utilizamos los hooks personalizados para meses y carpetas
  const { months, enabledMonth, currentYear } = useMonths();
  const { folders, isLoading, isError } = useFoldersData();
  const [selectedMonth, setSelectedMonth] = useState(enabledMonth?.id || null);

  // Filtrar carpetas por el mes seleccionado (en un caso real, esto podría ser una llamada a la API)
  // Por ahora, simplemente mostramos todas las carpetas cuando se selecciona el mes habilitado
  const filteredFolders = selectedMonth === enabledMonth?.id ? folders : [];

  return (
    <div>
      <div className="page-wrapper">
        <div className="content container-fluid">
          <div className="page-header">
            <div className="row align-items-center">
              <div className="col">
                <h3 className="page-title">Contabilidad Mensual</h3>
                <ul className="breadcrumb">
                  <li className="breadcrumb-item">
                    <Link to="/dashboard">Dashboard</Link>
                  </li>
                  <li className="breadcrumb-item active">Contabilidad Mensual</li>
                </ul>
              </div>
            </div>
          </div>

          <div className="row">
            {/* Sidebar de meses */}
            <div className="col-xl-3 col-md-4">
              <div className="card">
                <div className="card-body">
                  <div className="file-sidebar">
                    <div className="file-header">
                      <div className="file-header-text">
                        <h5>Meses</h5>
                      </div>
                    </div>
                    <div className="file-pro-list">
                      <div className="file-scroll">
                        <ul className="file-menu">
                          <li className="mb-2">
                            <h6 className="mb-0">{currentYear}</h6>
                          </li>
                          {months.map((month) => (
                            <li key={month.id} className={`file-submenu ${selectedMonth === month.id ? 'active' : ''}`}>
                              <Link 
                                to="#" 
                                className={`file-list ${!month.enabled ? 'disabled-month' : ''}`}
                                onClick={(e) => {
                                  if (month.enabled) {
                                    e.preventDefault();
                                    setSelectedMonth(month.id);
                                  } else {
                                    e.preventDefault();
                                  }
                                }}
                              >
                                <div className="file-info">
                                  <span className="file-icon">
                                    <Calendar size={18} />
                                  </span>
                                  <span className="file-name">{month.name}</span>
                                </div>
                                {month.enabled && <ChevronRight size={16} />}
                              </Link>
                            </li>
                          ))}
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            {/* Contenido principal - Carpetas */}
            <div className="col-xl-9 col-md-8">
              <div className="card">
                <div className="card-body">
                  {isError ? (
                    <div className="alert alert-danger">Error al cargar las carpetas. Por favor, intente nuevamente.</div>
                  ) : isLoading ? (
                    <div className="text-center">
                      <div className="spinner-border text-primary" role="status">
                        <span className="visually-hidden">Cargando...</span>
                      </div>
                    </div>
                  ) : selectedMonth === null ? (
                    <div className="text-center">
                      <h5>Seleccione un mes para ver las carpetas disponibles</h5>
                    </div>
                  ) : filteredFolders.length === 0 ? (
                    <div className="text-center">
                      <h5>No hay carpetas disponibles para este mes</h5>
                    </div>
                  ) : (
                    <div className="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-5">
                      {filteredFolders.map((folder) => (
                        <div key={folder.key} className="col mb-4">
                          <div className="card folder-card">
                            <div className="card-body">
                              <div className="d-flex align-items-center">
                                <div className="folder-icon">
                                  <Folder size={36} color="#FFC107" />
                                </div>
                                <div className="folder-info ms-3">
                                  <h6 className="mb-1">
                                    <Link to={`${all_routes.folder.path}/${folder.id}`}>
                                      {folder.name}
                                    </Link>
                                  </h6>
                                  <p className="mb-0 text-muted small">
                                    {folder.documentTypesCount} {folder.documentTypesCount === 1 ? 'tipo de documento' : 'tipos de documentos'}
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      ))}
                    </div>
                  )}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Month;
