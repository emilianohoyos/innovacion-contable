import { useState } from 'react';
import { useDataFetch } from '../../../hooks/useDataFetch';
import { toast } from 'react-toastify';

export const useComments = (applicationId) => {
  const { postData } = useDataFetch();
  const [comments, setComments] = useState([]);
  const [isLoading, setIsLoading] = useState(false);
  const [isSubmitting, setIsSubmitting] = useState(false);

  const mutationFetchComments = postData('/list-comments', {}, {}, {
    onSuccess: (response) => {
      if (response?.message && Array.isArray(response.message)) {
        setComments(response.message);
      } else {
        setComments([]);
      }
      setIsLoading(false);
    },
    onError: (error) => {
      console.error('Error al cargar comentarios:', error);
      setComments([]);
      setIsLoading(false);
    }
  });

  const mutationCreateComment = postData('/create-comment', {}, {}, {
    onSuccess: (response) => {
      if (response?.status === true) {
        toast.success('Comentario agregado exitosamente');
        // Refrescar comentarios después de crear uno nuevo
        fetchComments(applicationId);
      } else {
        toast.error('Error al agregar comentario');
      }
      setIsSubmitting(false);
    },
    onError: (error) => {
      console.error('Error al crear comentario:', error);
      toast.error('Error al agregar comentario');
      setIsSubmitting(false);
    }
  });


  const fetchComments = async (applicationId) => {
    setIsLoading(true);
    try {
      await mutationFetchComments.mutateAsync({
        application_id: applicationId
      });
    } catch (error) {
      console.error('Error:', error);
      setComments([]);
      setIsLoading(false);
    }
  };

  const createComment = async (applicationId, comment) => {
    setIsSubmitting(true);
    try {
      
      await mutationCreateComment.mutateAsync({
        application_id: applicationId,
        comment: comment
      });
    } catch (error) {
      console.error('Error:', error);
      toast.error('Error al procesar el comentario');
      setIsSubmitting(false);
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
