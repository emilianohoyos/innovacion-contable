import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useDataFetch } from './../../../../hooks/useDataFetch';
import Cookies from 'js-cookie';
import { toast } from 'react-toastify';

export const useAuth = () => {
  const navigate = useNavigate();
  const { postData } = useDataFetch();
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [user, setUser] = useState(null);
  
  // Mutation para iniciar sesión
  const loginMutation = postData('/login', {}, {}, {
    onSuccess: (data) => {
      if (data && data.token) {
        // Guardar token en cookies
        Cookies.set('token', data.token); // Expira en 7 días
        
        // Guardar información del usuario
        const userData = {
          fullname: data.fullname,
          clientname: data.clientname
        };
        
        localStorage.setItem('user', JSON.stringify(userData));
        setUser(userData);
        setIsAuthenticated(true);
        
        // Mostrar mensaje de éxito
        toast.success(`¡Bienvenido(a) ${data.fullname}!`, {
          position: "top-right",
          autoClose: 3000,
          hideProgressBar: false,
          closeOnClick: true,
          pauseOnHover: true,
          draggable: true
        });
        
        navigate('/dashboard');
      }
    },
    onError: (error) => {
      console.error('Error de autenticación:', error);
      setIsAuthenticated(false);
      
      // Mostrar mensaje de error
      toast.error('Error de autenticación. Por favor, verifica tus credenciales.', {
        position: "top-right",
        autoClose: 5000,
        hideProgressBar: false,
        closeOnClick: true,
        pauseOnHover: true,
        draggable: true
      });
    }
  });

  // Función para iniciar sesión
  const login = (credentials) => {
    loginMutation.mutate(credentials);
  };

  // Función para cerrar sesión
  const logout = () => {
    Cookies.remove('token');
    localStorage.removeItem('user');
    setUser(null);
    setIsAuthenticated(false);
    
    // Mostrar mensaje de cierre de sesión
    toast.info('Has cerrado sesión correctamente', {
      position: "top-right",
      autoClose: 3000,
      hideProgressBar: false,
      closeOnClick: true,
      pauseOnHover: true,
      draggable: true
    });
    
    navigate('/login');
  };

  // Verificar si el usuario está autenticado al cargar el componente
  useEffect(() => {
    const token = Cookies.get('token');
    const storedUser = localStorage.getItem('user');
    
    if (token) {
      setIsAuthenticated(true);
      if (storedUser) {
        setUser(JSON.parse(storedUser));
      }
    }
  }, []);

  return {
    login,
    logout,
    isAuthenticated,
    isLoading: loginMutation.isPending,
    error: loginMutation.error,
    user
  };
};

export default useAuth;
