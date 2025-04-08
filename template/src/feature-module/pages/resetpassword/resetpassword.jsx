import React from "react";
import ImageWithBasePath from "../../../core/img/imagewithbasebath";
import { Link } from "react-router-dom";
import { all_routes } from "../../../Router/all_routes";

const Resetpassword = () => {
  const route = all_routes;
  return (
    <div className="main-wrapper">
      <div className="account-content">
        <div className="login-wrapper reset-pass-wrap bg-img">
          <div className="login-content">
            <form action="success-3">
              <div className="login-userset">
                <div className="login-logo logo-normal">
                  <ImageWithBasePath src="assets/img/logo.png" alt="img" />
                </div>
                <Link to={route.dashboard} className="login-logo logo-white">
                  <ImageWithBasePath src="assets/img/logo-white.png" alt />
                </Link>
                <div className="login-userheading">
                  <h3>Recuperar contraseña</h3>
                  <h4>Ingresa la nueva contraseña para tu cuenta.</h4>
                </div>

                <div className="form-login">
                  <label>Nueva contraseña</label>
                  <div className="pass-group">
                    <input type="password" className="pass-inputs" />
                    <span className="fas toggle-passwords fa-eye-slash" />
                  </div>
                </div>
                <div className="form-login">
                  <label> Confirmar la nueva contraseña</label>
                  <div className="pass-group">
                    <input type="password" className="pass-inputa" />
                    <span className="fas toggle-passworda fa-eye-slash" />
                  </div>
                </div>
                <div className="form-login">
                  <Link to={route.dashboard} className="btn btn-login">
                    Cambiar
                  </Link>
                </div>
                <div className="signinform text-center">
                  <h4>
                    Volver al{" "}
                    <Link to={route.signin} className="hover-a">
                      {" "}
                      ingresar{" "}
                    </Link>
                  </h4>
                </div>
                <div className="my-4 d-flex justify-content-center align-items-center copyright-text">
                  <p>
                    Copyright © {new Date().getFullYear} Innovación Contable.
                    All rights reserved
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Resetpassword;
