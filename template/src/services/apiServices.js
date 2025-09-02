class ApiService {
  constructor(baseURL, bearerToken) {
    this.baseURL = baseURL;

    this.bearerToken = bearerToken;
  }

  // Método para actualizar los headers
  setHeaders(bearerToken) {
    this.bearerToken = bearerToken;
  }

  // Método para construir los headers
  buildHeaders() {
    return {
      Authorization: this.bearerToken ? `Bearer ${this.bearerToken}` : "",
      "Content-Type": "application/json",
    };
  }

  buildHeadersMultipart() {
    return {
      Authorization: this.bearerToken ? `Bearer ${this.bearerToken}` : "",
    };
  }

  // Método GET
  async get(url) {
    try {
      const response = await fetch(`${url}`, {
        method: "GET",
        headers: this.buildHeaders(),
      });
      const result = await response.json();
      if(result.message == "Error de autenticación: Token has expired"){
        throw {status: 401, message: "Unauthorized"};
      }
      return result;
    } catch (error) {
      throw error;
    }
  }

  // Método POST
  async post(url, data) {
    try {
      const response = await fetch(`${url}`, {
        method: "POST",
        headers: this.buildHeaders(),
        body: JSON.stringify(data),
      });

      const result = await response.json();
      if(result.message == "Error de autenticación: Token has expired"){
        throw {status: 401, message: "Unauthorized"};
      }
      return result;
    } catch (error) {
      throw error;
    }
  }

  async postMultipart(url, formData) {
    try {
      const response = await fetch(`${url}`, {
        method: "POST",
        headers: this.buildHeadersMultipart(),
        body: formData,
      });

      const result = await response.json();
      if(result.message == "Error de autenticación: Token has expired"){
        throw {status: 401, message: "Unauthorized"};
      }
      return result;
    } catch (error) {
      throw error;
    }
  }

  // Método PATCH
  async patch(url, data) {
    try {
      const response = await fetch(`${url}`, {
        method: "PATCH",
        headers: this.buildHeaders(),
        body: JSON.stringify(data),
      });
      const result = await response.json();
      if(result.message == "Error de autenticación: Token has expired"){
        throw {status: 401, message: "Unauthorized"};
      }
      return result;
    } catch (error) {
      throw error;
    }
  }

  // Método PUT
  async put(url, data) {
    try {
      const response = await fetch(`${url}`, {
        method: "put",
        headers: this.buildHeaders(),
        body: JSON.stringify(data),
      });
      const result = await response.json();
      if(result.message == "Error de autenticación: Token has expired"){
        throw {status: 401, message: "Unauthorized"};
      }
      return result;
    } catch (error) {
      throw error;
    }
  }

  // Método DELETE
  async delete(url) {
    try {
      const response = await fetch(`${url}`, {
        method: "DELETE",
        headers: this.buildHeaders(),
      });
      const result = await response.json();
      if(result.message == "Error de autenticación: Token has expired"){
        throw {status: 401, message: "Unauthorized"};
      }
      return result;
    } catch (error) {
      throw error;
    }
  }

  // Método para manejar la respuesta
  async handleResponse(response) {
    if (!response.ok) {
      // Si el status es 401 Unauthorized, devolvemos un objeto especial
      if (response.status === 401) {
        throw { status: 401, message: "Unauthorized: Sesión expirada o credenciales inválidas" };
      }
      
      try {
        const error = await response.json();
        console.error("Error en la respuesta:", error);
        throw { status: response.status, message: error.message || "Error en la solicitud", data: error };
      } catch (e) {
        // Si no se puede parsear como JSON
        throw { status: response.status, message: "Error en la solicitud" };
      }
    }
    return response.json();
  }
}

export default ApiService;
