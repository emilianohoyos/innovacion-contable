import { useState } from 'react';
import { useDataFetch } from '../../../hooks/useDataFetch';
import { toast } from 'react-toastify';

export const useMonthlyComments = () => {
  const { postData } = useDataFetch();
  const [comments, setComments] = useState([]);
  const [isLoading, setIsLoading] = useState(false);
  const [isSubmitting, setIsSubmitting] = useState(false);

  // Mutation para listar comentarios
  const mutationFetchComments = postData('/monthly-accounting-comment', {}, {}, {
    onSuccess: (response) => {
      if (response?.comments && Array.isArray(response.comments)) {
        setComments(response.comments);
      } else {
        setComments([]);
      }
      setIsLoading(false);
    },
    onError: (error) => {
      console.error('Error al cargar comentarios:', error);
      setComments([]);
      setIsLoading(false);
      toast.error('Error al cargar comentarios');
    }
  });

  // Mutation para crear comentarios
  const mutationCreateComment = postData('/monthly-accounting-comment/store', {}, {}, {
    onSuccess: (response) => {
      if (response?.status === true) {
        toast.success('Comentario agregado exitosamente');
        // Refrescar comentarios después de crear uno nuevo
        return true;
      } else {
        toast.error('Error al agregar comentario');
        return false;
      }
      setIsSubmitting(false);
    },
    onError: (error) => {
      console.error('Error al crear comentario:', error);
      toast.error('Error al agregar comentario');
      setIsSubmitting(false);
      return false;
    }
  });

  // Función para obtener comentarios
  const fetchComments = async (id) => {
    setIsLoading(true);
    try {
      await mutationFetchComments.mutateAsync({
        monthly_accounting_folder_id: id
      });
    } catch (error) {
      console.error('Error:', error);
      setComments([]);
      setIsLoading(false);
    }
  };

  // Función para crear comentario
  const createComment = async (id, comment) => {
    setIsSubmitting(true);
    try {
      const result = await mutationCreateComment.mutateAsync({
        monthly_accounting_folder_id: id,
        comment: comment,
        user_type: 1
      });
      
      if (result) {
        // Refrescar comentarios después de crear uno nuevo
        await fetchComments(id);
      }
      
      setIsSubmitting(false);
      return result;
    } catch (error) {
      console.error('Error:', error);
      toast.error('Error al procesar el comentario');
      setIsSubmitting(false);
      return false;
    }
  };

  return {
    comments,
    isLoading,
    isSubmitting,
    fetchComments,
    createComment
  };
};
