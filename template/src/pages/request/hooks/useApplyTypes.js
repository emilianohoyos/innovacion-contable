import { useEffect, useMemo } from 'react';
import { useDataFetch } from '../../../hooks/useDataFetch';
import { getFormattedEstimatedDate } from '../../../utils/dateUtils';

export const useApplyTypes = () => {
  const { getData, invalidateQuery } = useDataFetch();

  // Utilizamos el hook getData para obtener los tipos de solicitud
  const {
    data,
    isLoading,
    isError,
    error,
    refetch
  } = getData(['apply-types'], '/list-apply-types', {
    enabled: true,
    refetchOnWindowFocus: false,
    onSuccess: (data) => {
      console.log('Tipos de solicitud cargados:', data);
    },
    onError: (error) => {
      console.error('Error al cargar tipos de solicitud:', error);
    }
  });

  const applyTypesOptions = useMemo(() => {
    console.log("data", data);
    return data?.map(type => {
      const estimatedDate = getFormattedEstimatedDate(type.estimated_days);
      return {
        value: type.id,
        label: `${type.name}`,
        estimatedDays: type.estimated_days,
        estimatedDate: estimatedDate,
        priority: type.priority,
        destiny: type.destiny
      };
    }) || [];
  }, [data]);

  return {
    applyTypes: data || [],
    applyTypesOptions,
    isLoading,
    isError,
    error
  };
};
