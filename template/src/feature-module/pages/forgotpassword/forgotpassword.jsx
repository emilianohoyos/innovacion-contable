import React from "react";
import ImageWithBasePath from "../../../core/img/imagewithbasebath";
import { Link } from "react-router-dom";
import { all_routes } from "../../../Router/all_routes";

const Forgotpassword = () => {
  const route = all_routes;
  return (
    <div className="main-wrapper">
      <div className="account-content">
        <div className="login-wrapper forgot-pass-wrap bg-img">
          <div className="login-content">
            <form>
              <div className="login-userset">
                <div className="login-logo logo-normal">
                  <ImageWithBasePath src="assets/img/logo.png" alt="img" />
                </div>
                <Link to={route.dashboard} className="login-logo logo-white">
                  <ImageWithBasePath src="assets/img/logo-white.png" alt />
                </Link>
                <div className="login-userheading">
                  <h3>¿Recuperar contraseña?</h3>
                  <h4>
                    Si olvidaste la contraseña, ingresa el usuario y enviaremos
                    las instrucciones para recuperarla.
                  </h4>
                </div>
                <div className="form-login">
                  <label>Usuario</label>
                  <div className="form-addons">
                    <input type="email" className="form-control" />
                    <ImageWithBasePath
                      src="assets/img/icons/user-icon.svg"
                      alt="img"
                    />
                  </div>
                </div>
                <div className="form-login">
                  <Link tp={route.signin} className="btn btn-login">
                    Enviar
                  </Link>
                </div>
                <div className="signinform text-center">
                  <h4>
                    Volver al
                    <Link to={route.signin} className="hover-a">
                      {" "}
                      ingresar{" "}
                    </Link>
                  </h4>
                </div>
  
                <div className="my-4 d-flex justify-content-center align-items-center copyright-text">
                  <p> Copyright © {new Date().getFullYear} Innovación Contable.
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

export default Forgotpassword;
