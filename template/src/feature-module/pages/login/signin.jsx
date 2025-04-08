import React from "react";
import ImageWithBasePath from "../../../core/img/imagewithbasebath";
import { Link } from "react-router-dom";
import { all_routes } from "../../../Router/all_routes";

const Signin = () => {
  const [showPassword, setShowPassword] = React.useState(false);
  const route = all_routes;
  return (
    <div className="main-wrapper">
      <div className="account-content">
        <div className="login-wrapper bg-img">
          <div className="login-content">
            <form action="index">
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
                    <input type="text" className="form-control" />
                    <ImageWithBasePath
                      src="assets/img/icons/user-icon.svg"
                      alt="img"
                    />
                  </div>
                </div>
                <div className="form-login mb-3">
                  <label className="form-label">Contraseña</label>
                  <div className="pass-group">
                    <input
                      type={showPassword ? "text" : "password"}
                      className="pass-input form-control"
                    />
                    <span className={`fas toggle-password ${showPassword ? 'fa-eye': 'fa-eye-slash'}`} onClick={() => setShowPassword(!showPassword)} />
                  </div>
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
                  <Link to={route.dashboard} className="btn btn-login">
                    Ingresar
                  </Link>
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
