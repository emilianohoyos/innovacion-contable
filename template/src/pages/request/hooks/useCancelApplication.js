import { useDataFetch } from '../../../hooks/useDataFetch';
import { toast } from 'react-toastify';

export const useCancelApplication = () => {
  const { postData } = useDataFetch();

  const mutation = postData('/cancel-application', {}, {}, {
    onSuccess: (response) => {
      if (response?.status === true) {
        toast.success('Solicitud cancelada exitosamente');
        return true;
      } else {
        toast.error('Error al cancelar la solicitud');
        return false;
      }
    },
    onError: (error) => {
      console.error('Error al cancelar solicitud:', error);
      toast.error('Error al cancelar la solicitud');
      return false;
    }
  });


  const cancelApplication = async (applicationId, reason) => {
    try {

      const result = await mutation.mutateAsync({
        application_id: applicationId,
        reason: reason
      });

      return result;
    } catch (error) {
      console.error('Error:', error);
      toast.error('Error al procesar la cancelación');
      return false;
    }
  };

  return {
    cancelApplication
  };
};
