import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import ApiService from "../services/apiServices";
import { toast } from "react-toastify";
import Swal from "sweetalert2";
import Cookies from "js-cookie";
import { useEffect } from "react";
import { useNavigate } from "react-router-dom";

// URL base de la API
export const BASE_PATH_HTTP = "https://panel.innovacioncontable.com/api";
// export const BASE_PATH_HTTP = "http://localhost:8000/api";

export const useDataFetch = () => {
  const apiService = new ApiService();
  const queryClient = useQueryClient();
  const navigate = useNavigate();

  const token = Cookies.get("token") || null;

  const authHeaders = {
    Authorization: `Bearer ${token || ""}`,
    "Content-Type": "application/json",
  };

  apiService.setHeaders(token);
  const checkIsAuth = () => !!token;
  
  // Función para cerrar sesión
  const logout = () => {
    // Eliminar token y cualquier otra información de sesión
    Cookies.remove("token");
    // Limpiar el caché de React Query
    queryClient.clear();
    // Mostrar mensaje
    toast.info("Su sesión ha expirado. Por favor inicie sesión nuevamente.");
    // Redirigir al login
    navigate("/signin");
  };
  
  // Función para verificar si el error es 401 y manejar el cierre de sesión
  const handleApiError = (error) => {
    console.error("API Error:", error);
    
    // Verificar si es un error 401 (Unauthorized)
    if (error && (error.status === 401 || error.response?.status === 401)) {
      logout();
      return true; // Indica que se manejó como error de autorización
    }
    return false; // No era un error de autorización
  };

  // Http Request - GET
  const getData = (queryKey, url, options = {}, params = {}, headers = {}) => {
    const newHeaders = checkIsAuth() ? { ...headers, ...authHeaders } : headers;

    return useQuery({
      queryKey,
      queryFn: async () => {
        return await apiService.get(
          `${BASE_PATH_HTTP}${url}`,
          params,
          newHeaders
        );
      },
      retry: 2,
      enabled: false,
      refetchOnWindowFocus: false,
      onError: (error) => {
        console.log(error);
        if (!handleApiError(error)) {
          // Si no es un error de autorización, mostrar mensaje genérico
          toast.error("Error al obtener datos. Intente nuevamente.");
        }
      },
      ...options,
    });
  };

  // Http Request - POST
  const postData = (url, headers = {}, extraBody = {}, options = {}) => {
    const newHeaders = checkIsAuth() ? { ...headers, ...authHeaders } : headers;

    return useMutation({
      mutationFn: async (body = {}) => {
        return await apiService.post(
          `${BASE_PATH_HTTP}${url}`,
          { ...body, ...extraBody },
          newHeaders
        );
      },
      onSuccess: () => {
        toast.success("Se completó la acción correctamente.");
      },
      onError: (error) => {
        if (!handleApiError(error)) {
          // Si no es un error de autorización, mostrar mensaje genérico
          toast.error("Error al obtener datos. Intente nuevamente.");
        }
      },
      ...options,
    });
  };

  // Http Request - POST Multipart
  const postMultipart = (url, headers = {}, options = {}) => {
    const newHeaders = checkIsAuth()
      ? { ...headers, Authorization: authHeaders.Authorization }
      : headers;

    return useMutation({
      mutationFn: async (formData) => {
        return await apiService.postMultipart(
          `${BASE_PATH_HTTP}${url}`,
          formData,
          newHeaders
        );
      },
      onSuccess: () => {
        toast.success("Se completó la acción correctamente.");
      },
      onError: (error) => {
        if (!handleApiError(error)) {
          // Si no es un error de autorización, mostrar mensaje genérico
          toast.error("Error al subir el archivo.");
        }
      },
      ...options,
    });
  };

  // Http Request - DELETE
  const deleteData = (url, headers = {}, options = {}) => {
    const newHeaders = checkIsAuth() ? { ...headers, ...authHeaders } : headers;

    return useMutation({
      mutationFn: async (body = {}) => {
        const confirm = await Swal.fire({
          title: "Confirmación",
          text: "¿Desea eliminar el registro?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Sí",
        });

        if (confirm.isConfirmed) {
          return await apiService.delete(
            `${BASE_PATH_HTTP}${url}${body.id ? "/" + body.id : ""}`,
            newHeaders
          );
        }
      },
      onSuccess: () => toast.success("Registro eliminado correctamente."),
      onError: (error) => {
        if (!handleApiError(error)) {
          toast.error("Error al eliminar el registro.");
        }
      },
      ...options,
    });
  };

  // Http Request - PATCH
  const patchData = (url, headers = {}, options = {}) => {
    const newHeaders = checkIsAuth() ? { ...headers, ...authHeaders } : headers;

    return useMutation({
      mutationFn: async (body = {}) => {
        return await apiService.put(
          `${BASE_PATH_HTTP}${url}${body.id ? "/" + body.id : ""}`,
          { ...body },
          newHeaders
        );
      },
      onSuccess: () => {
        toast.success("Se completó la acción correctamente.");
      },
      onError: (error) => {
        if (!handleApiError(error)) {
          // Si no es un error de autorización, mostrar mensaje genérico
          toast.error("Error al procesar la solicitud.");
        }
      },
      ...options,
    });
  };

  // Invalidar caché de consultas
  const invalidateQuery = (queryKey) => {
    queryClient.invalidateQueries({ queryKey });
  };

  return {
    getData,
    postData,
    postMultipart,
    deleteData,
    patchData,
    invalidateQuery,
    handleApiError,
  };
};
