import { useMemo } from 'react';
import withReactContent from "sweetalert2-react-content";
import Swal from "sweetalert2";
import { useFoldersData } from './useFoldersData';
import { Link } from 'react-router-dom';
import { Eye, Folder } from 'react-feather';
import { all_routes } from '../../../Router/all_routes';

export const useMonthTable = () => {
  // Obtenemos los datos de las carpetas del hook
  const { folders, isLoading, isError, error, refreshFolders } = useFoldersData();
  
  // Configuración de SweetAlert
  const MySwal = withReactContent(Swal);
  
  // Definimos las columnas de la tabla como un valor memorizado
  const columns = useMemo(() => [
    {
      title: "Nombre de Carpeta",
      dataIndex: "name",
      sorter: (a, b) => a.name.localeCompare(b.name),
    },
    {
      title: "Periodicidad",
      dataIndex: "periodicity",
      sorter: (a, b) => a.periodicity.localeCompare(b.periodicity),
    },
    {
      title: "Tipos de Documentos",
      dataIndex: "document_types_count",
      render: (text) => (
        <span className="badge bg-info">
          {text}
        </span>
      ),
      sorter: (a, b) => a.document_types_count - b.document_types_count,
    },
    {
      title: "Acción",
      dataIndex: "action",
      render: (_, record) => (
        <div className="edit-delete-action">
          <div className="input-block add-lists"></div>
          <Link 
            className="me-2 p-2" 
            to={`/folder/${record.id}`} // Asumiendo que tendrás una ruta para ver los detalles de la carpeta
            title="Ver detalles de la carpeta"
          >
            <Eye className="feather-view" />
          </Link>
        </div>
      ),
    },
  ], []);

  return {
    // Datos de carpetas
    folders,
    isLoading,
    isError,
    error,
    refreshFolders,
    
    // Configuración de la tabla
    columns,
  };
};
