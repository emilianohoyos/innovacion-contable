import { useState } from 'react';
import { useDataFetch } from '../../../hooks/useDataFetch';
import { useApplyTypes } from './useApplyTypes';
import { toast } from 'react-toastify';
import { useNavigate } from 'react-router-dom';
import { all_routes } from '../../../Router/all_routes';

export const useCreateApplication = () => {
  const navigate = useNavigate();
  const { postMultipart } = useDataFetch();
  const { applyTypesOptions, isLoading: isLoadingApplyTypes } = useApplyTypes();

  // Estado del formulario
  const [formData, setFormData] = useState({
    apply_type_id: '',
    observation: '',
    files: []
  });

  // Estado de carga y errores
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [errors, setErrors] = useState({});

  // Función para manejar cambios en los campos del formulario
  const handleChange = (e) => {
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
      [name]: selectedOption ? selectedOption.value : ''
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
      // Crear un FormData para enviar archivos
      const submitData = new FormData();
      submitData.append('apply_type_id', formData.apply_type_id);
      submitData.append('observation', formData.observation);
      
      // Agregar archivos si existen
      formData.files.forEach((file, index) => {
        submitData.append(`files[${index}]`, file);
      });
      
      // Enviar la solicitud
      const response = await postMultipart('/create-application', {}, {
        onSuccess: () => {
          toast.success('Solicitud creada exitosamente');
          navigate(all_routes.dashboard);
        },
        onError: (error) => {
          console.error('Error al crear la solicitud:', error);
          toast.error('Error al crear la solicitud');
          
          // Manejar errores de validación del servidor
          if (error.response?.data?.errors) {
            setErrors(error.response.data.errors);
          }
        }
      }).mutateAsync(submitData);
      
      return response;
    } catch (error) {
      console.error('Error al enviar el formulario:', error);
    } finally {
      setIsSubmitting(false);
    }
  };

  // Función para resetear el formulario
  const resetForm = () => {
    setFormData({
      apply_type_id: '',
      observation: '',
      files: []
    });
    setErrors({});
  };

  return {
    formData,
    errors,
    isSubmitting,
    isLoadingApplyTypes,
    applyTypesOptions,
    handleChange,
    handleSelectChange,
    handleFileChange,
    handleRemoveFile,
    handleSubmit,
    resetForm
  };
};
