import { useMemo, useEffect } from 'react';
import { useDataFetch } from '../../../hooks/useDataFetch';

export const useFolderDetail = (folderId, month, year) => {
  const { getData } = useDataFetch();
  
  // Definimos la clave para React Query
  const queryKey = ['client-folder', folderId, month, year];
  
  // Utilizamos el hook getData para obtener los detalles de la carpeta
  const { 
    data, 
    isLoading, 
    isError, 
    error, 
    refetch 
  } = getData(queryKey, `/client-folder?month=${month}&year=${year}`, {
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

  // Función para encontrar los documentos registrados para un tipo de documento
  const findRegisteredDocuments = (folder, documentTypeId) => {
    if (!folder?.monthly_config?.document_types) return [];
    return folder.monthly_config.document_types.filter(doc => doc.document_type_id === documentTypeId);
  };

  // Función para encontrar el documento registrado para un tipo de documento (mantener compatibilidad)
  const findRegisteredDocument = (folder, documentTypeId) => {
    const documents = findRegisteredDocuments(folder, documentTypeId);
    return documents.length > 0 ? documents[0] : null;
  };


  return {
    data,
    folder,
    isLoading,
    isError,
    error,
    findRegisteredDocument,
    findRegisteredDocuments,
    refetch
  };
};
