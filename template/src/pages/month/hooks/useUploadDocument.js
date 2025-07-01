import { useState, useEffect, useMemo } from 'react';
import { useForm } from 'react-hook-form';
import { useDataFetch } from '../../../hooks/useDataFetch';
import { useNavigate } from 'react-router-dom';
import Swal from 'sweetalert2';
import withReactContent from 'sweetalert2-react-content';

export const useUploadDocument = (folderId, documentTypeId) => {
  const { getData, postData } = useDataFetch();
  const navigate = useNavigate();
  const MySwal = withReactContent(Swal);
  
  // Estado para el archivo seleccionado
  const [selectedFile, setSelectedFile] = useState(null);
  
  // React Hook Form para manejar el formulario
  const {
    register,
    handleSubmit,
    formState: { errors, isSubmitting },
    setValue,
    reset
  } = useForm({
    defaultValues: {
      name: '',
      documentDate: new Date().toISOString().split('T')[0],
      observations: '',
    }
  });

  // Definimos la clave para React Query
  const queryKey = ['client-folder', folderId];
  
  // Utilizamos el hook getData para obtener los detalles de la carpeta
  const { 
    data, 
    isLoading, 
    isError, 
    error, 
    refetch 
  } = getData(queryKey, '/client-folder', {
    enabled: !!folderId, // Solo habilitamos la consulta si tenemos un folderId
    refetchOnWindowFocus: false,
  });

  // Ejecutamos la consulta al montar el componente
  useEffect(() => {
    if (folderId) {
      refetch();
    }
  }, [folderId, refetch]);

  // Encontramos la carpeta específica por ID
  const folder = useMemo(() => {
    if (!data?.folders) return null;
    return data.folders.find(f => f.id === parseInt(folderId));
  }, [data, folderId]);

  // Encontramos el tipo de documento específico por ID
  const documentType = useMemo(() => {
    if (!folder?.document_types) return null;
    return folder.document_types.find(dt => dt.id === parseInt(documentTypeId));
  }, [folder, documentTypeId]);

  // Manejador de cambio de archivo
  const handleFileChange = (e) => {
    if (e.target.files && e.target.files[0]) {
      setSelectedFile(e.target.files[0]);
    } else {
      setSelectedFile(null);
    }
  };

  // Función para manejar el envío del formulario
  const onSubmit = async (formData) => {
    // Validamos que se haya seleccionado un archivo
    if (!selectedFile) {
      MySwal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Debe seleccionar un archivo para cargar',
      });
      return;
    }

    try {
      // Creamos un objeto FormData para enviar el archivo
      const formDataToSend = new FormData();
      formDataToSend.append('file', selectedFile);
      formDataToSend.append('name', formData.name);
      formDataToSend.append('document_date', formData.documentDate);
      formDataToSend.append('observations', formData.observations);
      formDataToSend.append('folder_id', folderId);
      formDataToSend.append('document_type_id', documentTypeId);

      // Enviamos los datos al servidor
      const response = await postData(['upload-document'], '/upload-document', formDataToSend, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      // Mostramos mensaje de éxito
      MySwal.fire({
        icon: 'success',
        title: '¡Documento cargado!',
        text: 'El documento se ha cargado correctamente',
        confirmButtonText: 'Aceptar',
      }).then(() => {
        // Redirigimos a la página de detalles de la carpeta
        navigate(`/folder/${folderId}`);
      });

      // Limpiamos el formulario
      reset();
      setSelectedFile(null);
      
    } catch (error) {
      console.error('Error al cargar el documento:', error);
      
      MySwal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Ha ocurrido un error al cargar el documento. Por favor, intente nuevamente.',
      });
    }
  };

  return {
    folder,
    documentType,
    isLoading,
    isError,
    error,
    register,
    handleSubmit,
    errors,
    isSubmitting,
    onSubmit,
    selectedFile,
    handleFileChange
  };
};
