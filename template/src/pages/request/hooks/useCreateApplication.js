import { useState } from 'react';
import { useDataFetch } from '../../../hooks/useDataFetch';
import { useApplyTypes } from './useApplyTypes';
import { useApplyDocumentTypes } from './useApplyDocumentTypes';
import { filesToBase64 } from '../../../utils/fileUtils';
import { toast } from 'react-toastify';
import { useNavigate } from 'react-router-dom';
import { all_routes } from '../../../Router/all_routes';

export const useCreateApplication = () => {
  const navigate = useNavigate();
  const { postData } = useDataFetch();
  const { applyTypesOptions, isLoading: isLoadingApplyTypes } = useApplyTypes();

  // Estado del formulario
  const [formData, setFormData] = useState({
    apply_type_id: '',
    observation: '',
    files: [],
    documentFiles: {} // Para almacenar archivos por tipo de documento
  });

  // Hook para obtener tipos de documentos basado en el tipo de solicitud seleccionado
  const {
    documentTypes,
    isLoading: isLoadingDocumentTypes
  } = useApplyDocumentTypes(formData.apply_type_id);

  // Estado de carga y errores
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [errors, setErrors] = useState({});

  const mutation = postData('/create-application', {}, {}, {
    onSuccess: (response) => {
      console.log('Respuesta del servidor:', response);
      if (response?.status === true) {
        toast.success(response.message || 'Solicitud creada exitosamente');
        navigate(all_routes.dashboard);
      } else {
        toast.error('Error en la respuesta del servidor');
      }
    },
    onError: (error) => {
      console.error('Error al crear la solicitud:', error);
      toast.error('Error al crear la solicitud');

      // Manejar errores de validación del servidor
      if (error.response?.data?.errors) {
        setErrors(error.response.data.errors);
      }
    }
  });

  // Función para manejar cambios en los campos del formulario
  const handleChange = (e) => {
    console.log('handleChange - e.target:', e.target);
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));

    // Limpiar error del campo cuando el usuario lo modifica
    if (errors[name]) {
      setErrors(prev => ({
        ...prev,
        [name]: ''
      }));
    }
  };

  // Función para manejar cambios en los campos de tipo select
  const handleSelectChange = (selectedOption, { name }) => {
    setFormData(prev => ({
      ...prev,
      [name]: selectedOption ? selectedOption.value : '',
      // Limpiar archivos de documentos cuando cambia el tipo de solicitud
      ...(name === 'apply_type_id' && { documentFiles: {} })
    }));

    // Limpiar error del campo cuando el usuario lo modifica
    if (errors[name]) {
      setErrors(prev => ({
        ...prev,
        [name]: ''
      }));
    }
  };

  // Función para manejar la carga de archivos
  const handleFileChange = (e) => {
    const fileList = Array.from(e.target.files);
    setFormData(prev => ({
      ...prev,
      files: [...prev.files, ...fileList]
    }));
  };

  // Función para eliminar un archivo
  const handleRemoveFile = (index) => {
    setFormData(prev => ({
      ...prev,
      files: prev.files.filter((_, i) => i !== index)
    }));
  };

  // Función para manejar archivos específicos por tipo de documento
  const handleDocumentFileChange = (documentTypeId, files) => {
    setFormData(prev => ({
      ...prev,
      documentFiles: {
        ...prev.documentFiles,
        [documentTypeId]: files
      }
    }));
  };

  // Función para eliminar archivo de un tipo de documento específico
  const handleRemoveDocumentFile = (documentTypeId, fileIndex) => {
    setFormData(prev => ({
      ...prev,
      documentFiles: {
        ...prev.documentFiles,
        [documentTypeId]: prev.documentFiles[documentTypeId]?.filter((_, i) => i !== fileIndex) || []
      }
    }));
  };

  // Validación del formulario
  const validateForm = () => {
    const newErrors = {};

    if (!formData.apply_type_id) {
      newErrors.apply_type_id = 'El tipo de solicitud es requerido';
    }

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  // Función para enviar el formulario
  const handleSubmit = async (e) => {
    e.preventDefault();

    if (!validateForm()) {
      toast.error('Por favor, complete todos los campos requeridos');
      return;
    }

    setIsSubmitting(true);

    try {
      // Preparar datos para envío según el formato esperado por el controller
      const submitData = {
        apply_type_id: formData.apply_type_id,
        observation: formData.observation,
        files: {}
      };

      // Convertir archivos específicos por tipo de documento a base64
      for (const [documentTypeId, files] of Object.entries(formData.documentFiles)) {
        if (files && files.length > 0) {
          const groupKey = `document_${documentTypeId}`;
          const base64Files = await filesToBase64(files);
          submitData.files[groupKey] = base64Files;
        }
      }

      console.log('Datos a enviar:', submitData);

      // Enviar la solicitud usando postData en lugar de postMultipart


      await mutation.mutateAsync(submitData);

    } catch (error) {
      console.error('Error al enviar el formulario:', error);
      toast.error('Error al procesar los archivos');
    } finally {
      setIsSubmitting(false);
    }
  };

  // Función para resetear el formulario
  const resetForm = () => {
    setFormData({
      apply_type_id: '',
      observation: '',
      files: [],
      documentFiles: {}
    });
    setErrors({});
  };

  return {
    formData,
    errors,
    isSubmitting,
    isLoadingApplyTypes,
    isLoadingDocumentTypes,
    applyTypesOptions,
    documentTypes,
    handleChange,
    handleSelectChange,
    handleFileChange,
    handleRemoveFile,
    handleDocumentFileChange,
    handleRemoveDocumentFile,
    handleSubmit,
    resetForm
  };
};
