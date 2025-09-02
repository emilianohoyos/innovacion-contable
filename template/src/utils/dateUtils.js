/**
 * Calcula una fecha estimada agregando días hábiles (excluyendo sábados y domingos)
 * comenzando a contar desde el día siguiente
 * @param {number} estimatedDays - Número de días hábiles a agregar
 * @param {Date} startDate - Fecha de inicio (opcional, por defecto es hoy)
 * @returns {Date} - Fecha estimada calculada
 */
export const calculateEstimatedDate = (estimatedDays, startDate = new Date()) => {
  if (!estimatedDays || estimatedDays <= 0) {
    return null;
  }

  // Comenzar desde el día siguiente
  const currentDate = new Date(startDate);
  currentDate.setDate(currentDate.getDate() + 1);
  
  let businessDaysAdded = 0;
  
  while (businessDaysAdded < estimatedDays) {
    // 0 = Domingo, 6 = Sábado
    const dayOfWeek = currentDate.getDay();
    
    // Si no es sábado (6) ni domingo (0), contar como día hábil
    if (dayOfWeek !== 0 && dayOfWeek !== 6) {
      businessDaysAdded++;
    }
    
    // Si aún no hemos agregado todos los días hábiles, avanzar al siguiente día
    if (businessDaysAdded < estimatedDays) {
      currentDate.setDate(currentDate.getDate() + 1);
    }
  }
  
  return currentDate;
};

/**
 * Formatea una fecha a string en formato legible en español
 * @param {Date} date - Fecha a formatear
 * @returns {string} - Fecha formateada
 */
export const formatDateToSpanish = (date) => {
  if (!date) return '';
  
  const options = {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  };
  
  return date.toLocaleDateString('es-ES', options);
};

/**
 * Calcula y formatea la fecha estimada en español
 * @param {number} estimatedDays - Número de días hábiles
 * @param {Date} startDate - Fecha de inicio (opcional)
 * @returns {string} - Fecha estimada formateada en español
 */
export const getFormattedEstimatedDate = (estimatedDays, startDate = new Date()) => {
  const estimatedDate = calculateEstimatedDate(estimatedDays, startDate);
  return estimatedDate ? formatDateToSpanish(estimatedDate) : '';
};
