import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import ApiService from "../services/apiServices";
import { toast } from "react-toastify";
import Swal from "sweetalert2";
import Cookies from "js-cookie";

// URL base de la API
export const BASE_PATH_HTTP = "http://localhost:8000/api";

export const useDataFetch = () => {
  const apiService = new ApiService();
  const queryClient = useQueryClient();

  const token = Cookies.get("token") || null;

  const authHeaders = {
    Authorization: `Bearer ${token || ""}`,
    "Content-Type": "application/json",
  };

  apiService.setHeaders(token);
  const checkIsAuth = () => !!token;

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
        console.error("Query Error", error);
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
        console.log(error);
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
        console.error("Error en multipart:", error);
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
      onError: (error) => console.error(error),
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
        console.log(error);
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
  };
};
