/* eslint-disable react-hooks/rules-of-hooks */
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";

import ApiService from "../services/apiServices";
import { toast } from "react-toastify";
import Swal from "sweetalert2";
import jwtAuthConfig from "../auth/services/jwt/jwtAuthConfig";

export const BASE_PATH_HTTP = "https://panel.innovacioncontable.com";

export const useDataFetch = () => {
  const apiService = new ApiService();
  const queryClient = useQueryClient();

  const token = localStorage.getItem(jwtAuthConfig.tokenStorageKey) || null;

  const authHeaders = {
    Authorization: `Bearer ${token || ""}`,
    "Content-Type": "application/json",
  };

  apiService.setHeaders(token);

  const checkIsAuth = () => !!token;

  // Http Request
  const getData = (queryKey, url, options = {}, params = {}, headers = {}) => {
    const newHeaders = checkIsAuth() ? { ...headers, ...authHeaders } : headers;

    return useQuery(
      queryKey,
      async () => {
        return await apiService.get(
          `${BASE_PATH_HTTP}${url}`,
          params,
          newHeaders
        );
      },
      {
        retry: 2,
        enabled: false,
        refetchOnWindowFocus: false,
        onError: (error) => {
          console.error("Query Error", error);
        },
        ...options,
      }
    );
  };

  const postData = (url, headers = {}, extraBody = {}, options = {}) => {
    const newHeaders = checkIsAuth() ? { ...headers, ...authHeaders } : headers;

    return useMutation(
      async (body = {}) => {
        return await apiService.post(
          `${BASE_PATH_HTTP}${url}`,
          { ...body, ...extraBody },
          newHeaders
        );
      },
      {
        onSuccess: (data) => {
          toast.success("Se completo la acción correctamente.");
        },
        onError: (error) => {
          console.log(error);
        },
        ...options,
      }
    );
  };

  const postMultipart = (url, headers = {}, options = {}) => {
    const newHeaders = checkIsAuth()
      ? { ...headers, Authorization: authHeaders.Authorization }
      : headers;

    return useMutation(
      async (formData) => {
        return await apiService.postMultipart(
          `${BASE_PATH_HTTP}${url}`,
          formData,
          newHeaders
        );
      },
      {
        onSuccess: (data) => {
          toast.success("Se completo la acción correctamente.");
        },
        onError: (error) => {
          console.error("Error en multipart:", error);
        },
        ...options,
      }
    );
  };

  const deleteData = (url, headers = {}, options = {}) => {
    const newHeaders = checkIsAuth() ? { ...headers, ...authHeaders } : headers;

    return useMutation(
      (body = {}) =>
        Swal.fire({
          title: "Confirmación",
          text: "¿Desea eliminar el registro?",
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si",
        }).then((result) => {
          if (result.isConfirmed) {
            apiService.delete(
              `${BASE_PATH_HTTP}${url}${body.id ? "/" + body.id : ""}`,
              newHeaders
            );
          }
        }),
      {
        onSuccess: (data) => {
          toast.success("Se completo la acción correctamente.");
        },
        onError: (error) => {
          console.log(error);
        },
        ...options,
      }
    );
  };

  const patchData = (url, headers = {}, options = {}) => {
    const newHeaders = checkIsAuth() ? { ...headers, ...authHeaders } : headers;

    return useMutation(
      (body = {}) =>
        apiService.put(
          `${BASE_PATH_HTTP}${url}${body.id ? "/" + body.id : ""}`,
          { ...body },
          newHeaders
        ),
      {
        onSuccess: (data) => {
          toast.success("Se completo la acción correctamente.");
        },
        onError: (error) => {
          console.log(error);
        },
        ...options,
      }
    );
  };

  const invalidateQuery = (queryKey) => {
    queryClient.invalidateQueries(queryKey);
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
