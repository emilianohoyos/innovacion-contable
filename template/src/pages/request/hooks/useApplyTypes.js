import { useEffect } from 'react';
import { useDataFetch } from '../../../hooks/useDataFetch';

export const useApplyTypes = () => {
  const { getData, invalidateQuery } = useDataFetch();
  
  // Definimos la clave para React Query
  const queryKey = ['apply-types'];
  
  // Utilizamos el hook getData para obtener los tipos de solicitud
  const { 
    data, 
    isLoading, 
    isError, 
    error, 
    refetch 
  } = getData(queryKey, '/list-apply-types', {
    enabled: true, // Habilitamos la consulta automática
    refetchOnWindowFocus: false,
    onSuccess: (data) => {
      console.log('Tipos de solicitud cargados:', data);
    },
    onError: (error) => {
      console.error('Error al cargar tipos de solicitud:', error);
    }
  });

  // Ejecutamos la consulta al montar el componente
  useEffect(() => {
    refetch();
  }, [refetch]);

  // Transformamos los datos para que sean compatibles con react-select
  const applyTypesOptions = data?.data?.map(type => ({
    value: type.id,
    label: type.name
  })) || [];

  return {
    applyTypes: data?.data || [],
    applyTypesOptions,
    isLoading,
    isError,
    error
  };
};
