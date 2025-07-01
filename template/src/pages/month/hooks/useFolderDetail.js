import { useMemo, useEffect } from 'react';
import { useDataFetch } from '../../../hooks/useDataFetch';

export const useFolderDetail = (folderId) => {
  const { getData } = useDataFetch();
  
  // Definimos la clave para React Query
  const queryKey = ['client-folder', folderId];
  
  // Utilizamos el hook getData para obtener los detalles de la carpeta
  const { 
    data, 
    isLoading, 
    isError, 
    error, 
    refetch 
  } = getData(queryKey, '/client-folder', {
    enabled: !!folderId, // Solo habilitamos la consulta si tenemos un folderId
    refetchOnWindowFocus: false,
    onSuccess: (data) => {
      console.log('Detalles de carpeta cargados:', data);
    },
    onError: (error) => {
      console.error('Error al cargar detalles de carpeta:', error);
    }
  });

  // Ejecutamos la consulta al montar el componente
  useEffect(() => {
    if (folderId) {
      refetch();
    }
  }, [folderId, refetch]);

  // Encontramos la carpeta específica por ID
  const folder = useMemo(() => {
    if (!data?.folders) return null;
    return data.folders.find(f => f.id === parseInt(folderId));
  }, [data, folderId]);

  // Definimos las columnas para la tabla de tipos de documentos
  const columns = useMemo(() => [
    {
      title: "ID",
      dataIndex: "id",
      sorter: (a, b) => a.id - b.id,
    },
    {
      title: "Nombre del Documento",
      dataIndex: "name",
      sorter: (a, b) => a.name.localeCompare(b.name),
    },
    {
      title: "Requerido",
      dataIndex: "is_required",
      render: (value) => (
        <span className={`badge ${value === 1 ? 'bg-success' : 'bg-warning'}`}>
          {value === 1 ? 'Sí' : 'No'}
        </span>
      ),
      sorter: (a, b) => a.is_required - b.is_required,
    },
    {
      title: "Acción",
      dataIndex: "action",
      render: (_, record) => (
        <div className="edit-delete-action">
          <button 
            className="btn btn-sm btn-primary"
            onClick={() => console.log('Cargar documento:', record.id)}
          >
            Cargar Documento
          </button>
        </div>
      ),
    },
  ], []);

  return {
    folder,
    isLoading,
    isError,
    error,
    columns
  };
};
