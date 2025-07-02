import React, { useState, useEffect } from "react";
import ImageWithBasePath from "../../core/img/imagewithbasebath";
import { useFoldersData } from "./hooks/useFoldersData";
import { Link } from "react-router-dom";
import { all_routes } from "../../Router/all_routes";
import { Folder, Calendar, ChevronRight, FileText, Star, Send, File, Clock, Target, Trash2, Settings, AlertTriangle, CheckCircle } from "react-feather";
import { useMonths } from "./hooks/useMonths";


const Month = () => {
  // Obtenemos el año actual
  const actualYear = new Date().getFullYear();
  
  // Creamos un array con los años desde 2025 hasta el año actual
  const availableYears = [];
  for (let year = 2025; year <= actualYear; year++) {
    availableYears.push(year);
  }
  
  // Estado para el año seleccionado (por defecto el año actual)
  const [selectedYear, setSelectedYear] = useState(actualYear);
  
  // Utilizamos los hooks personalizados para meses y carpetas
  const { months, enabledMonth } = useMonths(selectedYear);
  const [selectedMonth, setSelectedMonth] = useState(enabledMonth?.id || null);
  
  // Cuando cambia el año, resetear el mes seleccionado al mes habilitado para ese año
  useEffect(() => {
    setSelectedMonth(enabledMonth?.id || null);
  }, [selectedYear, enabledMonth]);

  // Pasamos el mes seleccionado al hook para que haga la petición con el mes correcto
  const { folders, isLoading, isError, previousMonth } = useFoldersData(selectedMonth, selectedYear);

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
                <h5 className="d-flex align-items-center justify-content-between">
                  <div className="d-flex align-items-center">
                    <span className="me-2 d-flex align-items-center">
                      <Calendar className="feather-20" />
                    </span>
                    <span>Meses</span>
                  </div>
                  <select 
                    className="form-select form-select-sm" 
                    style={{ width: 'auto' }}
                    value={selectedYear}
                    onChange={(e) => setSelectedYear(Number(e.target.value))}
                  >
                    {availableYears.map(year => (
                      <option key={year} value={year}>{year}</option>
                    ))}
                  </select>
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
              {/* Mostrar mensaje de estado del mes anterior */}
              {previousMonth && (
                <div className={`alert ${previousMonth.is_before_end_date ? 'alert-success' : 'alert-warning'} mb-3`}>
                  <div className="d-flex align-items-center">
                    {previousMonth.is_before_end_date ? (
                      <CheckCircle className="me-2" size={20} />
                    ) : (
                      <AlertTriangle className="me-2" size={20} />
                    )}
                    <div>
                      {previousMonth.is_before_end_date ? (
                        <span>El plazo para el mes anterior está <strong>activo</strong> hasta {previousMonth.end_date}</span>
                      ) : (
                        <span>El plazo para el mes anterior ha <strong>vencido</strong>. La fecha límite era {previousMonth.end_date}</span>
                      )}
                    </div>
                  </div>
                </div>
              )}

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
                              to={{
                                pathname: `/folder/${folder.id}`,
                                state: { folderData: folder }
                              }}
                              className="d-flex align-items-center justify-content-center bg-light-green bg p-4"
                            >
                              <span className="d-flex align-items-center justify-content-center">
                                <Folder size={36} color="#ffff" />
                              </span>
                            </Link>
                            <div className="d-flex flex-direction-column justify-content-between info">
                              <h6>
                                <Link to={{
                                  pathname: `/folder/${folder.id}`,
                                  state: { folderData: folder }
                                }}>
                                  {folder.name}
                                </Link>
                              </h6>
                              <span className={previousMonth.is_before_end_date ? 'text-success' : 'text-danger'}>{previousMonth.is_before_end_date ? 'Activo' : 'Inactivo'}</span>
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
