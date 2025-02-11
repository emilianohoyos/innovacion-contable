import { BASE_PATH_HTTP } from "src/app/hooks/useDataFetch";
import { JwtAuthConfig } from "./JwtAuthProvider";

const jwtAuthConfig: JwtAuthConfig = {
  tokenStorageKey: "jwt_access_token",
  signInUrl: BASE_PATH_HTTP+"/api/login",
  signUpUrl: "",
  tokenRefreshUrl: "",
  getUserUrl: BASE_PATH_HTTP+"/api/me",
  updateUserUrl: "",
  updateTokenFromHeader: true,
};

export default jwtAuthConfig;
