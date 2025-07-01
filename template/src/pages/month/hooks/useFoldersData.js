import { useEffect } from 'react';
import { useDataFetch } from '../../../hooks/useDataFetch';

export const useFoldersData = () => {
  const { getData, invalidateQuery } = useDataFetch();
  
  // Definimos la clave para React Query
  const queryKey = ['client-folders'];
  
  // Utilizamos el hook getData para obtener las carpetas del cliente
  const { 
    data, 
    isLoading, 
    isError, 
    error, 
    refetch 
  } = getData(queryKey, '/client-folder', {
    enabled: true, // Habilitamos la consulta automática
    refetchOnWindowFocus: false,
    onSuccess: (data) => {
      console.log('Carpetas cargadas:', data);
    },
    onError: (error) => {
      console.error('Error al cargar carpetas:', error);
    }
  });

  // Ejecutamos la consulta al montar el componente
  useEffect(() => {
    refetch();
  }, [refetch]);

  // Función para refrescar los datos
  const refreshFolders = () => {
    invalidateQuery(queryKey);
  };

  // Transformamos los datos para que sean compatibles con la tabla
  // Filtramos solo las carpetas con periodicidad MENSUAL según el requerimiento
  const formattedFolders = data?.folders
    ?.filter(folder => folder.periodicity === 'MENSUAL')
    ?.map(folder => ({
      key: folder.id,
      id: folder.id,
      name: folder.name,
      periodicity: folder.periodicity,
      document_types: folder.document_types || [],
      document_types_count: folder.document_types?.length || 0,
      documentTypesCount: folder.document_types?.length || 0 // Añadimos esta propiedad para usar en Month.jsx
    })) || [];

  return {
    folders: formattedFolders,
    allFolders: data?.folders || [], // Incluimos todas las carpetas por si se necesitan
    isLoading,
    isError,
    error,
    refreshFolders
  };
};
