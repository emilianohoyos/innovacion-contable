import React from "react";
import ImageWithBasePath from "../../../core/img/imagewithbasebath";
import { Link } from "react-router-dom";
import { all_routes } from "../../../Router/all_routes";
import { useForm } from "react-hook-form";
import { useAuth } from "./hooks/useAuth";
import "react-toastify/dist/ReactToastify.css";

const Signin = () => {
  const [showPassword, setShowPassword] = React.useState(false);
  const route = all_routes;
  
  // React Hook Form
  const { register, handleSubmit, formState: { errors } } = useForm();
  
  // Hook de autenticación
  const { login, isLoading, error } = useAuth();
  
  // Función para manejar el envío del formulario
  const onSubmit = (data) => {
    login({
      username: data.username,
      password: data.password
    });
  };
  
  return (
    <div className="main-wrapper">
      <div className="account-content">
        <div className="login-wrapper bg-img">
          <div className="login-content">
            <form onSubmit={handleSubmit(onSubmit)}>
              <div className="login-userset">
                <div className="login-logo logo-normal">
                  <ImageWithBasePath
                    src="assets/img/logo.png"
                    alt="img"
                    width={400}
                  />
                </div>
                <Link to={route.dashboard} className="login-logo logo-white">
                  <ImageWithBasePath src="assets/img/logo-white.png" alt />
                </Link>
                <div className="login-userheading">
                  <h3>Ingresar</h3>
                  <h4>
                    Accede al panel de clientes usando usuario y contraseña.
                  </h4>
                </div>
                <div className="form-login mb-3">
                  <label className="form-label">Usuario</label>
                  <div className="form-addons">
                    <input 
                      type="text" 
                      className={`form-control ${errors.username ? 'is-invalid' : ''}`}
                      {...register("username", { 
                        required: "El usuario es requerido"
                      })}
                    />
                    <ImageWithBasePath
                      src="assets/img/icons/user-icon.svg"
                      alt="img"
                    />
                  </div>
                  {errors.username && (
                    <div className="invalid-feedback d-block">
                      {errors.username.message}
                    </div>
                  )}
                </div>
                <div className="form-login mb-3">
                  <label className="form-label">Contraseña</label>
                  <div className="pass-group">
                    <input
                      type={showPassword ? "text" : "password"}
                      className={`pass-input form-control ${errors.password ? 'is-invalid' : ''}`}
                      {...register("password", { 
                        required: "La contraseña es requerida",
                        minLength: {
                          value: 6,
                          message: "La contraseña debe tener al menos 6 caracteres"
                        }
                      })}
                    />
                    <span 
                      className={`fas toggle-password ${showPassword ? 'fa-eye': 'fa-eye-slash'}`} 
                      onClick={() => setShowPassword(!showPassword)} 
                    />
                  </div>
                  {errors.password && (
                    <div className="invalid-feedback d-block">
                      {errors.password.message}
                    </div>
                  )}
                </div>
                <div className="form-login authentication-check">
                  <div className="row">
                    <div className="col-12 d-flex align-items-center justify-content-between">
                      <div className="custom-control custom-checkbox"></div>
                      <div className="text-end">
                        <Link className="forgot-link" to={route.forgotPassword}>
                          ¿Olvidé mi contraseña?
                        </Link>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="form-login">
                  <button type="submit" className="btn btn-login" disabled={isLoading}>
                    {isLoading ? 'Cargando...' : 'Ingresar'}
                  </button>
                </div>

                <div className="form-sociallink">
                  <div className="my-4 d-flex justify-content-center align-items-center copyright-text">
                    <p>
                      Copyright © {new Date().getFullYear} Innovación Contable.
                      All rights reserved
                    </p>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Signin;
