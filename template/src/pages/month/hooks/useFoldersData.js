import { useEffect } from 'react';
import { useDataFetch } from '../../../hooks/useDataFetch';
import { useMonths } from './useMonths';

export const useFoldersData = (selectedMonthId = null) => {
  const { getData, invalidateQuery } = useDataFetch();
  const { months, enabledMonth } = useMonths();
  
  // Si se proporciona un ID de mes, usamos ese, de lo contrario usamos el mes habilitado (mes anterior)
  const monthToUse = selectedMonthId !== null ? months.find(m => m.id === selectedMonthId) : enabledMonth;
  
  // Obtener el mes y año actual
  const currentDate = new Date();
  const month = monthToUse ? String(monthToUse.id + 1).padStart(2, '0') : String(currentDate.getMonth() + 1).padStart(2, '0');
  const year = currentDate.getFullYear();
  
  // Definimos la clave para React Query incluyendo mes y año para que se actualice cuando cambien
  const queryKey = ['client-folders', month, year];
  
  // Utilizamos el hook getData para obtener las carpetas del cliente
  const { 
    data, 
    isLoading, 
    isError, 
    error, 
    refetch 
  } = getData(queryKey, `/client-folder?month=${month}&year=${year}`, {
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
