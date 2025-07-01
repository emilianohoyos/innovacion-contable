import React from "react";
import CountUp from "react-countup";
import Table from "../../core/pagination/datatable";
import ImageWithBasePath from "../../core/img/imagewithbasebath";
import { useApplicationTable } from "./hooks/useApplicationTable";
import { Link } from "react-router-dom";
import { all_routes } from "../../Router/all_routes";
import { PlusCircle } from "feather-icons-react/build/IconComponents";

const Application = () => {
  // Utilizamos el hook personalizado que contiene toda la lógica
  const {
    applications,
    isLoading,
    isError,
    columns,
    dashboardStats
  } = useApplicationTable();
  return (
    <div>
      <div className="page-wrapper">
        <div className="content">
          <div className="row">
            {dashboardStats.map((stat, index) => (
              <div key={index} className="col-xl-3 col-sm-6 col-12 d-flex">
                <div className={`dash-widget ${stat.className} w-100`}>
                  <div className="dash-widgetimg">
                    <span>
                      <ImageWithBasePath
                        src={stat.icon}
                        alt="img"
                      />
                    </span>
                  </div>
                  <div className="dash-widgetcontent">
                    <h5>
                      <CountUp start={0} end={stat.count} duration={1} />
                    </h5>
                    <h6>{stat.title}</h6>
                  </div>
                </div>
              </div>
            ))}

          </div>
          <div className="page-header">
            <div className="add-item d-flex">
              <div className="page-title">
                <h4>Solicitudes</h4>
                <h6>Manage your Solicitudes</h6>
              </div>
            </div>
            <div className="page-btn">
              <Link to={all_routes.createApplication} className="btn btn-added">
                <PlusCircle className="me-2 iconsize" />
                Crear nueva solicitud
              </Link>
            </div>

          </div>
          {/* Button trigger modal */}
          <div className="card">

            <div className="card-body">
              <div className="table-responsive">
                {isError ? (
                  <div className="alert alert-danger">Error al cargar las solicitudes. Por favor, intente nuevamente.</div>
                ) : (
                  <Table
                    columns={columns}
                    dataSource={applications}
                    loading={isLoading}
                    rowKey="key"
                  />
                )}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Application;
