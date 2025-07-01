import { useMemo } from 'react';

export const useMonths = () => {
  // Obtener la fecha actual
  const currentDate = new Date();
  const currentMonth = currentDate.getMonth();
  const currentYear = currentDate.getFullYear();
  
  // Crear un array con todos los meses
  const allMonths = useMemo(() => [
    { id: 0, name: 'Enero', enabled: false },
    { id: 1, name: 'Febrero', enabled: false },
    { id: 2, name: 'Marzo', enabled: false },
    { id: 3, name: 'Abril', enabled: false },
    { id: 4, name: 'Mayo', enabled: false },
    { id: 5, name: 'Junio', enabled: false },
    { id: 6, name: 'Julio', enabled: false },
    { id: 7, name: 'Agosto', enabled: false },
    { id: 8, name: 'Septiembre', enabled: false },
    { id: 9, name: 'Octubre', enabled: false },
    { id: 10, name: 'Noviembre', enabled: false },
    { id: 11, name: 'Diciembre', enabled: false },
  ], []);
  
  // Habilitar solo el mes anterior al actual
  const months = useMemo(() => {
    // Calcular el mes anterior (si es enero, el mes anterior es diciembre del año anterior)
    const previousMonth = currentMonth === 0 ? 11 : currentMonth - 1;
    
    return allMonths.map(month => ({
      ...month,
      enabled: month.id === previousMonth
    }));
  }, [allMonths, currentMonth]);
  
  // Obtener el mes habilitado (mes anterior)
  const enabledMonth = useMemo(() => {
    return months.find(month => month.enabled);
  }, [months]);
  
  return {
    months,
    enabledMonth,
    currentMonth: allMonths[currentMonth],
    currentYear
  };
};
