import { useState, useEffect } from 'react';

/**
 * Hook personalizado para obtener y gestionar la información del usuario desde localStorage
 * @returns {Object} Objeto con la información del usuario y funciones para actualizarla
 */
export const useUserInfo = () => {
  const [userInfo, setUserInfo] = useState({
    fullname: '',
    clientname: ''
  });

  // Cargar información del usuario desde localStorage al montar el componente
  useEffect(() => {
    const storedUser = localStorage.getItem('user');
    
    if (storedUser) {
      try {
        const parsedUser = JSON.parse(storedUser);
        setUserInfo({
          fullname: parsedUser.fullname || '',
          clientname: parsedUser.clientname || ''
        });
      } catch (error) {
        console.error('Error al parsear la información del usuario:', error);
      }
    }
  }, []);

  // Función para actualizar la información del usuario
  const updateUserInfo = (newUserInfo) => {
    localStorage.setItem('user', JSON.stringify(newUserInfo));
    setUserInfo(newUserInfo);
  };

  // Función para limpiar la información del usuario
  const clearUserInfo = () => {
    localStorage.removeItem('user');
    setUserInfo({
      fullname: '',
      clientname: ''
    });
  };

  return {
    userInfo,
    updateUserInfo,
    clearUserInfo
  };
};

export default useUserInfo;
