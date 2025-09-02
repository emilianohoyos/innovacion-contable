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

  // Función para limpiar HTML de las observaciones
  const stripHtml = (html) => {
    const tmp = document.createElement('div');
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || '';
  };

  // Función para truncar texto
  const truncateText = (text, maxLength = 100) => {
    if (!text) return 'Sin observaciones';
    const cleanText = stripHtml(text);
    return cleanText.length > maxLength ? cleanText.substring(0, maxLength) + '...' : cleanText;
  };

  // Transformamos los datos para que sean compatibles con la tabla
  const formattedApplications = data?.data?.map(app => {
    // Formatear fecha de solicitud
    const applicationDate = app.created_at ? new Date(app.created_at).toLocaleDateString('es-ES') : 'N/A';
    
    // Formatear fecha estimada de entrega
    const estimatedDate = app.estimated_delevery_date ? new Date(app.estimated_delevery_date).toLocaleDateString('es-ES') : 'N/A';
    
    return {
      key: app.id,
      id: app.id,
      created_by: app.created_by,
      client_id: app.client_id,
      apply_type_id: app.apply_type_id,
      apply_type: app.apply_type?.name || 'N/A',
      observations: truncateText(app.observations),
      full_observations: app.observations || 'Sin observaciones',
      application_date: applicationDate,
      estimated_delivery_date: estimatedDate,
      state_id: app.state_id,
      state: app.state?.name || 'N/A',
      priority: app.priority || 'MEDIA',
      employee_id: app.employee_id,
      attachments: app.attachments || [],
      attachments_count: app.attachments?.length || 0,
      raw_data: app // Guardamos los datos originales para el modal
    };
  }) || [];


  return {
    applications: formattedApplications,
    isLoading,
    isError,
    error,
    refreshApplications
  };
};
