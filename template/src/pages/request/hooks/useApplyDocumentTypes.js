import { useState, useEffect, useCallback } from 'react';
import { useDataFetch } from '../../../hooks/useDataFetch';

export const useApplyDocumentTypes = (applyTypeId) => {
  const { postData } = useDataFetch();
  const [documentTypes, setDocumentTypes] = useState([]);
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState(null);

  const mutation = postData('/list-apply-types-apply-document-types', {}, {}, {
    onSuccess: (response) => {
      console.log('Response completa:', response);

      // Basado en la estructura de respuesta: { status: true, data: [...] }
      if (response && response.status === true && Array.isArray(response.data)) {
        console.log('Document types encontrados:', response.data);
        setDocumentTypes(response.data);
      } else {
        console.log('No se encontraron document types o estructura incorrecta');
        setDocumentTypes([]);
      }
      setIsLoading(false);
      setError(null);
    },
    onError: (error) => {
      console.error('Error al obtener tipos de documentos:', error);
      setDocumentTypes([]);
      setIsLoading(false);
      setError(error);
    }
  });

  // Función memoizada para obtener los tipos de documentos
  const fetchDocumentTypes = useCallback(async (typeId) => {
    if (!typeId) {
      setDocumentTypes([]);
      setIsLoading(false);
      setError(null);
      return;
    }

    console.log('Fetching document types for applyTypeId:', typeId);
    setIsLoading(true);
    setError(null);

    try {
      await mutation.mutateAsync({
        apply_type_id: typeId
      });
    } catch (err) {
      console.error('Error en fetchDocumentTypes:', err);
      setIsLoading(false);
      setError(err);
    }
  }, []); // Removed postData from dependencies to prevent infinite loop

  // Efecto para obtener los tipos de documentos cuando cambia el applyTypeId
  useEffect(() => {
    if (applyTypeId) {
      console.log('Fetching document types for applyTypeId:', applyTypeId);
      fetchDocumentTypes(applyTypeId);
    }
  }, [applyTypeId]);

  return {
    documentTypes,
    isLoading,
    error,
    fetchDocumentTypes
  };
};
