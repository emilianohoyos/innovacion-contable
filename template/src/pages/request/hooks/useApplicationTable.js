import { useMemo, useState } from 'react';
import withReactContent from "sweetalert2-react-content";
import Swal from "sweetalert2";
import { useApplicationsData } from './useApplicationsData';
import { useCancelApplication } from './useCancelApplication';
import { Link } from 'react-router-dom';
import { Eye, Trash2, MessageCircle } from 'react-feather';
import { all_routes } from '../../../Router/all_routes';

export const useApplicationTable = () => {
  // Obtenemos los datos de las solicitudes del hook existente
  const { applications, isLoading, isError, error, refreshApplications } = useApplicationsData();
  const { cancelApplication } = useCancelApplication();

  // Estados para modales
  const [viewModalOpen, setViewModalOpen] = useState(false);
  const [commentsModalOpen, setCommentsModalOpen] = useState(false);
  const [selectedApplication, setSelectedApplication] = useState(null);

  // Configuración de SweetAlert
  const MySwal = withReactContent(Swal);

  // Función para mostrar modal de vista
  const showViewModal = (application) => {
    setSelectedApplication(application);
    setViewModalOpen(true);
  };

  // Función para mostrar modal de comentarios
  const showCommentsModal = (application) => {
    setSelectedApplication(application);
    setCommentsModalOpen(true);
  };

  // Función para cancelar solicitud
  const showCancelConfirmation = (application) => {
    MySwal.fire({
      title: "Cancelar Solicitud",
      text: "¿Por qué deseas cancelar esta solicitud?",
      input: 'textarea',
      inputPlaceholder: 'Ingresa el motivo de la cancelación...',
      inputValidator: (value) => {
        if (!value) {
          return 'Debes ingresar un motivo para la cancelación';
        }
      },
      showCancelButton: true,
      confirmButtonColor: "#1B2850",
      confirmButtonText: "Cancelar Solicitud",
      cancelButtonColor: "#141432",
      cancelButtonText: "No",
    }).then(async (result) => {
      if (result.isConfirmed) {
        const success = await cancelApplication(application.id, result.value);
        if (success) {
          refreshApplications();
          MySwal.fire({
            title: "¡Cancelada!",
            text: "La solicitud ha sido cancelada exitosamente.",
            icon: "success",
            confirmButtonText: "OK",
          });
        }
      }
    });
  };

  // Definimos las columnas de la tabla como un valor memorizado
  const columns = useMemo(() => [
    {
      title: "ID",
      dataIndex: "id",
      width: 80,
      sorter: (a, b) => a.id - b.id,
    },
    {
      title: "Tipo de Solicitud",
      dataIndex: "apply_type",
      sorter: (a, b) => a.apply_type.localeCompare(b.apply_type),
    },
    {
      title: "Observaciones",
      dataIndex: "observations",
      ellipsis: true,
      width: 200,
      render: (text) => (
        <span title={text} style={{ maxWidth: '200px', overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap', display: 'block' }}>
          {text}
        </span>
      ),
    },
    {
      title: "Fecha de Solicitud",
      dataIndex: "application_date",
      sorter: (a, b) => new Date(a.application_date) - new Date(b.application_date),
    },
    {
      title: "Fecha Estimada",
      dataIndex: "estimated_delivery_date",
      sorter: (a, b) => new Date(a.estimated_delivery_date) - new Date(b.estimated_delivery_date),
    },
    {
      title: "Estado",
      dataIndex: "state",
      render: (text, record) => {
        const getStateClass = (stateId) => {
          switch (stateId) {
            case 1: return 'bg-warning text-dark'; // Pendiente
            case 2: return 'bg-info'; // En proceso
            case 3: return 'bg-success'; // Completado
            case 4: return 'bg-primary'; // Revisión
            case 5: return 'bg-danger'; // Cancelado
            default: return 'bg-secondary';
          }
        };

        return (
          <span className={`badge ${getStateClass(record.state_id)}`}>
            {text}
          </span>
        );
      },
      sorter: (a, b) => a.state.localeCompare(b.state),
    },
    {
      title: "Archivos",
      dataIndex: "attachments_count",
      render: (count) => (
        <span className="badge bg-light text-dark">
          {count} archivo{count !== 1 ? 's' : ''}
        </span>
      ),
      sorter: (a, b) => a.attachments_count - b.attachments_count,
    },
    {
      title: "Acciones",
      dataIndex: "action",
      width: 120,
      render: (_, record) => (
        <div className="edit-delete-action">
          <button
            className="btn btn-sm btn-info me-2"
            onClick={() => showViewModal(record)}
            title="Ver detalles"
          >
            <Eye size={16} />
          </button>
          <button
            className="btn btn-sm btn-primary me-2"
            onClick={() => showCommentsModal(record)}
            title="Comentarios"
          >
            <MessageCircle size={16} />
          </button>
          {record.state_id === 1 && (
            <button
              className="btn btn-sm btn-danger"
              onClick={() => showCancelConfirmation(record)}
              title="Cancelar solicitud"
            >
              <Trash2 size={16} />
            </button>
          )}
        </div>
      ),
    },
  ], []);

  // Estadísticas del dashboard calculadas dinámicamente
  const dashboardStats = useMemo(() => {
    const totalApplications = applications.length;
    const openApplications = applications.filter(app => app.state_id !== 3 && app.state_id !== 5).length; // No completadas ni canceladas
    const closedApplications = applications.filter(app => app.state_id === 3).length; // Completadas
    const cancelledApplications = applications.filter(app => app.state_id === 5).length; // Canceladas

    return [
      {
        title: "Solicitudes Abiertas",
        count: openApplications,
        icon: "assets/img/icons/eye.svg",
        className: ""
      },
      {
        title: "Solicitudes Cerradas",
        count: closedApplications,
        icon: "assets/img/icons/check-icon.svg",
        className: "dash1"
      },
      {
        title: "Total Solicitudes",
        count: totalApplications,
        icon: "assets/img/icons/calendars.svg",
        className: "dash2"
      },
      {
        title: "Canceladas",
        count: cancelledApplications,
        icon: "assets/img/icons/time.svg",
        className: "dash3"
      }
    ];
  }, [applications]);

  return {
    // Datos de solicitudes
    applications,
    isLoading,
    isError,
    error,
    refreshApplications,

    // Configuración de la tabla
    columns,

    // Funciones de modales
    showViewModal,
    showCommentsModal,
    showCancelConfirmation,

    // Estados de modales
    viewModalOpen,
    setViewModalOpen,
    commentsModalOpen,
    setCommentsModalOpen,
    selectedApplication,

    // Estadísticas
    dashboardStats
  };
};
