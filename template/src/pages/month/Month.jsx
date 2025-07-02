import React, { useState } from "react";
import ImageWithBasePath from "../../core/img/imagewithbasebath";
import { useFoldersData } from "./hooks/useFoldersData";
import { Link } from "react-router-dom";
import { all_routes } from "../../Router/all_routes";
import { Folder, Calendar, ChevronRight, FileText, Star, Send, File, Clock, Target, Trash2, Settings } from "react-feather";
import { useMonths } from "./hooks/useMonths";


const Month = () => {
  // Utilizamos los hooks personalizados para meses y carpetas
  const { months, enabledMonth, currentYear } = useMonths();
  const [selectedMonth, setSelectedMonth] = useState(enabledMonth?.id || null);

  // Pasamos el mes seleccionado al hook para que haga la petición con el mes correcto
  const { folders, isLoading, isError } = useFoldersData(selectedMonth);

  // Ya no necesitamos filtrar las carpetas aquí, ya que la API nos devuelve las carpetas del mes seleccionado
  const filteredFolders = folders;

  return (
    <div>
      <div className="page-wrapper notes-page-wrapper file-manager">
        <div className="content container-fluid">
          <div className="page-header">
            <div className="row align-items-center">
              <div className="col">
                <h3 className="page-title">Contabilidad Mensual</h3>
              </div>
            </div>
          </div>

          <div className="row">
            <div className="col-lg-3 col-md-12 sidebars-right theiaStickySidebar section-bulk-widget">
              <aside className="card file-manager-sidebar mb-0">
                <h5 className="d-flex align-items-center">
                  <span className="me-2 d-flex align-items-center">
                    <Calendar className="feather-20" />
                  </span>
                  Meses {currentYear}
                </h5>

                <ul>
                  {months.map((month) => (
                    <li key={month.id} className={!month.enabled ? 'disabled-item' : ''}>
                      <Link
                        to="#"
                        className={selectedMonth === month.id ? 'active' : ''}
                        style={!month.enabled ? { opacity: 0.5, cursor: 'not-allowed', pointerEvents: 'none' } : {}}
                        onClick={(e) => {
                          if (month.enabled) {
                            e.preventDefault();
                            setSelectedMonth(month.id);
                          } else {
                            e.preventDefault();
                          }
                        }}
                      >
                        <span className="me-2 btn-icon">
                          <Calendar className="feather-16" />
                        </span>
                        {month.name}
                        {month.enabled && <ChevronRight className="ms-auto" size={16} />}
                      </Link>
                    </li>
                  ))}
                </ul>
              </aside>


            </div>

            {/* Contenido principal - Carpetas */}
            <div className="col-xl-9 col-md-8">
              <div className="card">
                <div className="card-header">
                  <h5 className="d-flex align-items-center">
                    <span className="me-2 d-flex align-items-center">
                      <Folder className="feather-20" />
                    </span>
                    Carpetas
                  </h5>
                </div>
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
                        <div key={folder.key} className="col-sm-6 col-md-3">
                          <div className="detail">
                            <Link
                              to={`/folder/${folder.id}`}
                              className="d-flex align-items-center justify-content-center bg-light-green bg p-4"
                            >
                              <span className="d-flex align-items-center justify-content-center">
                                <Folder size={36} color="#ffff" />
                              </span>
                            </Link>
                            <div className="d-flex align-items-center justify-content-between info">
                              <h6>
                                <Link to={`/folder/${folder.id}`}>
                                  {folder.name}
                                </Link>
                              </h6>
                            </div>
                            <span>300 Files</span>
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
