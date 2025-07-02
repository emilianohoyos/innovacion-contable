import { useMemo } from 'react';

export const useMonths = (selectedYear = null) => {
  const currentDate = new Date();
  const currentMonth = currentDate.getMonth();
  const currentYear = selectedYear || currentDate.getFullYear();
  const isCurrentYear = currentYear === currentDate.getFullYear();

  // Crear un array con todos los meses
  const allMonths = useMemo(() => [
    { id: 1, name: 'Enero', enabled: false },
    { id: 2, name: 'Febrero', enabled: false },
    { id: 3, name: 'Marzo', enabled: false },
    { id: 4, name: 'Abril', enabled: false },
    { id: 5, name: 'Mayo', enabled: false },
    { id: 6, name: 'Junio', enabled: false },
    { id: 7, name: 'Julio', enabled: false },
    { id: 8, name: 'Agosto', enabled: false },
    { id: 9, name: 'Septiembre', enabled: false },
    { id: 10, name: 'Octubre', enabled: false },
    { id: 11, name: 'Noviembre', enabled: false },
    { id: 12, name: 'Diciembre', enabled: false },
  ], []);
  
  const months = useMemo(() => {
    return allMonths.map(month => ({
      ...month,
      // Si es el año actual, habilitar solo los meses hasta el mes actual
      // Si es un año anterior, habilitar todos los meses
      // Si es un año futuro, no habilitar ningún mes
      enabled: isCurrentYear ? month.id <= currentMonth : (currentYear < new Date().getFullYear())
    }));
  }, [allMonths, currentMonth, currentYear, isCurrentYear]);
  
  const enabledMonth = useMemo(() => {
    const enabledMonths = months.filter(month => month.enabled);
    if (enabledMonths.length === 0) return null;
    
    return enabledMonths.sort((a, b) => b.id - a.id)[0];
  }, [months]);
  
  return {
    months,
    enabledMonth,
    currentMonth: allMonths[currentMonth],
    currentYear
  };
};
