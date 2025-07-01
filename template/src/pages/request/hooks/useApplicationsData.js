import { useEffect } from 'react';
import { useDataFetch } from '../../../hooks/useDataFetch';

export const useApplicationsData = () => {
  const { getData, invalidateQuery } = useDataFetch();
  
  // Definimos la clave para React Query
  const queryKey = ['applications'];
  
  // Utilizamos el hook getData para obtener las solicitudes
  const { 
    data, 
    isLoading, 
    isError, 
    error, 
    refetch 
  } = getData(queryKey, '/list-applications', {
    enabled: true, // Habilitamos la consulta automática
    refetchOnWindowFocus: false,
    onSuccess: (data) => {
      console.log('Solicitudes cargadas:', data);
    },
    onError: (error) => {
      console.error('Error al cargar solicitudes:', error);
    }
  });

  // Ejecutamos la consulta al montar el componente
  useEffect(() => {
    refetch();
  }, [refetch]);

  // Función para refrescar los datos
  const refreshApplications = () => {
    invalidateQuery(queryKey);
  };

  // Transformamos los datos para que sean compatibles con la tabla
  const formattedApplications = data?.data?.map(app => ({
    key: app.id,
    created_by: app.created_by,
    client_id: app.client_id,
    client_name: app.client?.name || 'N/A',
    apply_type_id: app.apply_type_id,
    apply_type: app.apply_type?.name || 'N/A',
    observations: app.observations,
    application_date: app.application_date,
    estimated_delivery_date: app.estimated_delevery_date,
    state_id: app.state_id,
    state: app.state?.name || 'N/A',
    priority: app.priority,
    employee_id: app.employee_id,
    employee_name: app.employee?.name || 'N/A'
  })) || [];

  return {
    applications: formattedApplications,
    isLoading,
    isError,
    error,
    refreshApplications
  };
};
