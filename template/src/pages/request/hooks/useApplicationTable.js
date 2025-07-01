import { useMemo } from 'react';
import withReactContent from "sweetalert2-react-content";
import Swal from "sweetalert2";
import { useApplicationsData } from './useApplicationsData';
import { Link } from 'react-router-dom';
import { Edit, Eye, Trash2 } from 'react-feather';
import { all_routes } from '../../../Router/all_routes';

export const useApplicationTable = () => {
  // Obtenemos los datos de las solicitudes del hook existente
  const { applications, isLoading, isError, error, refreshApplications } = useApplicationsData();
  
  // Configuración de SweetAlert
  const MySwal = withReactContent(Swal);
  
  // Función para mostrar la alerta de confirmación
  const showConfirmationAlert = () => {
    MySwal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      showCancelButton: true,
      confirmButtonColor: "#00ff00",
      confirmButtonText: "Yes, delete it!",
      cancelButtonColor: "#ff0000",
      cancelButtonText: "Cancel",
    }).then((result) => {
      if (result.isConfirmed) {
        MySwal.fire({
          title: "Deleted!",
          text: "Your file has been deleted.",
          className: "btn btn-success",
          confirmButtonText: "OK",
          customClass: {
            confirmButton: "btn btn-success",
          },
        });
      } else {
        MySwal.close();
      }
    });
  };

  // Definimos las columnas de la tabla como un valor memorizado
  const columns = useMemo(() => [
    {
      title: "Tipo de Solicitud",
      dataIndex: "apply_type",
      sorter: (a, b) => a.apply_type.localeCompare(b.apply_type),
    },
    {
      title: "Observaciones",
      dataIndex: "observations",
      ellipsis: true,
      sorter: (a, b) => a.observations.localeCompare(b.observations),
    },
    {
      title: "Fecha de Solicitud",
      dataIndex: "application_date",
      sorter: (a, b) => new Date(a.application_date) - new Date(b.application_date),
    },
    {
      title: "Fecha Estimada de Entrega",
      dataIndex: "estimated_delivery_date",
      sorter: (a, b) => new Date(a.estimated_delivery_date) - new Date(b.estimated_delivery_date),
    },
    {
      title: "Estado",
      dataIndex: "state",
      render: (text, record) => (
        <span className={`badge ${record.state_id === 1 ? 'bg-warning' : record.state_id === 2 ? 'bg-success' : 'bg-primary'}`}>
          {text}
        </span>
      ),
      sorter: (a, b) => a.state.localeCompare(b.state),
    },
    {
      title: "Prioridad",
      dataIndex: "priority",
      render: (text) => (
        <span className={`badge ${text === 'Alta' ? 'bg-danger' : text === 'Media' ? 'bg-warning' : 'bg-info'}`}>
          {text}
        </span>
      ),
      sorter: (a, b) => a.priority.localeCompare(b.priority),
    },
    {
      title: "Creado Por",
      dataIndex: "created_by",
      sorter: (a, b) => a.created_by.localeCompare(b.created_by),
    },
    {
      title: "Action",
      dataIndex: "action",
      render: () => (
        <td className="action-table-data">
          <div className="edit-delete-action">
            <div className="input-block add-lists"></div>
            <Link className="me-2 p-2" to={all_routes.productdetails}>
              <Eye className="feather-view" />
            </Link>
            <Link className="me-2 p-2" to={all_routes.editproduct}>
              <Edit className="feather-edit" />
            </Link>
            <Link
              className="confirm-text p-2"
              to="#"
              onClick={showConfirmationAlert}
            >
              <Trash2 className="feather-trash-2" />
            </Link>
          </div>
        </td>
      ),
      sorter: (a, b) => a.createdby?.length - b.createdby?.length || 0,
    },
  ], []);

  // Estadísticas del dashboard (por ahora son valores estáticos)
  const dashboardStats = [
    {
      title: "Solicitudes Abiertas",
      count: 0,
      icon: "assets/img/icons/eye.svg",
      className: ""
    },
    {
      title: "Solicitudes Cerradas",
      count: 0,
      icon: "assets/img/icons/check-icon.svg",
      className: "dash1"
    },
    {
      title: "Carpetas Mensuales",
      count: 0,
      icon: "assets/img/icons/calendars.svg",
      className: "dash2"
    },
    {
      title: "Carpetas Anuales",
      count: 0,
      icon: "assets/img/icons/time.svg",
      className: "dash3"
    }
  ];

  return {
    // Datos de solicitudes
    applications,
    isLoading,
    isError,
    error,
    refreshApplications,
    
    // Configuración de la tabla
    columns,
    
    // Funciones
    showConfirmationAlert,
    
    // Estadísticas
    dashboardStats
  };
};
