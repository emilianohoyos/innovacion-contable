/**
 * Convierte un archivo a base64
 * @param {File} file - Archivo a convertir
 * @returns {Promise<string>} - Promesa que resuelve con el string base64
 */
export const fileToBase64 = (file) => {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
  });
};

/**
 * Convierte múltiples archivos a base64
 * @param {File[]} files - Array de archivos a convertir
 * @returns {Promise<Array>} - Promesa que resuelve con array de objetos {name, fileBase64}
 */
export const filesToBase64 = async (files) => {
  const promises = files.map(async (file) => {
    const base64 = await fileToBase64(file);
    return {
      name: file.name,
      fileBase64: base64
    };
  });
  
  return Promise.all(promises);
};
