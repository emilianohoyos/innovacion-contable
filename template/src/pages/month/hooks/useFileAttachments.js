import { useState } from 'react';
import { useDataFetch } from '../../../hooks/useDataFetch';
import { toast } from 'react-toastify';

export const useFileAttachments = () => {
    const { postData } = useDataFetch();
    const [isUploading, setIsUploading] = useState(false);


    // Mutation para subir archivos
    const mutationUploadFile = postData('/attachments', {}, {}, {
        onSuccess: (response) => {
            if (response?.status === true) {
                toast.success('Archivo subido exitosamente');
                setIsUploading(false);
                return true;
            } else {
                toast.error('Error al subir archivo');
                setIsUploading(false);
                return false;
            }
        },
        onError: (error) => {
            console.error('Error al subir archivo:', error);
            toast.error('Error al subir archivo');
            setIsUploading(false);
            return false;
        }
    });

    // Función para convertir archivo a base64
    const fileToBase64 = (file) => {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = error => reject(error);
        });
    };

    // Función para subir múltiples archivos
    const uploadFiles = async (folderId, documentTypeId, files, monthYear = null, year = null, monthly_accounting_folder_id = null) => {
        if (!files || files.length === 0) {
            toast.error('Por favor selecciona al menos un archivo');
            return false;
        }

        // Validar cada archivo
        const maxSize = 10 * 1024 * 1024; // 10MB en bytes
        const allowedTypes = [
            // PDFs
            'application/pdf',
            // Imágenes
            'image/jpeg',
            'image/jpg', 
            'image/png',
            'image/gif',
            'image/bmp',
            'image/webp',
            'image/tiff',
            // Microsoft Office
            'application/msword', // .doc
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // .docx
            'application/vnd.ms-excel', // .xls
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
            'application/vnd.ms-powerpoint', // .ppt
            'application/vnd.openxmlformats-officedocument.presentationml.presentation', // .pptx
            // LibreOffice/OpenOffice
            'application/vnd.oasis.opendocument.text', // .odt
            'application/vnd.oasis.opendocument.spreadsheet', // .ods
            'application/vnd.oasis.opendocument.presentation', // .odp
            // Texto plano
            'text/plain', // .txt
            'text/csv', // .csv
            // Otros formatos comunes
            'application/rtf', // .rtf
            // Archivos comprimidos
            'application/zip', // .zip
            'application/x-zip-compressed' // .zip (alternativo)
        ];

        for (let file of files) {
            if (file.size > maxSize) {
                toast.error(`El archivo ${file.name} es demasiado grande. Máximo 10MB permitido.`);
                return false;
            }

            if (!allowedTypes.includes(file.type)) {
                toast.error(`Tipo de archivo no permitido para ${file.name}. Solo se permiten: PDF, imágenes (JPG, PNG, GIF, BMP, WEBP, TIFF), documentos de Office (Word, Excel, PowerPoint), LibreOffice (ODT, ODS, ODP), archivos de texto (TXT, CSV, RTF), y archivos comprimidos (ZIP).`);
                return false;
            }
        }

        setIsUploading(true);

        try {
            // Convertir todos los archivos a base64
            const attachments = [];
            for (let file of files) {
                const base64File = await fileToBase64(file);
                attachments.push({
                    apply_doc_type_folder_id: documentTypeId,
                    fileBase64: base64File,
                    filename: file.name,

                });
            }

            // Preparar el payload con los campos requeridos
            const payload = {
                monthly_accounting_folder_id,
                client_folder_id: folderId,
                month_year: monthYear,
                year,
                attachments: attachments
            };

            console.log('Payload para attachments:', payload);

            const result = await mutationUploadFile.mutateAsync(payload);

            return result;
        } catch (error) {
            console.error('Error al procesar archivos:', error);
            toast.error('Error al procesar los archivos');
            setIsUploading(false);
            return false;
        }
    };

    // Función para subir un solo archivo (mantener compatibilidad)
    const uploadFile = async (folderId, documentTypeId, file, monthYear = null, year = null) => {
        return uploadFiles(folderId, documentTypeId, [file], monthYear, year);
    };

    return {
        isUploading,
        uploadFile,
        uploadFiles
    };
};
