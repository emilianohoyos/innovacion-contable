import BrowserRouter from "@fuse/core/BrowserRouter";
import FuseAuthorization from "@fuse/core/FuseAuthorization/FuseAuthorization";
import React, { useCallback, useEffect, useMemo, useState } from "react";
import { useAppDispatch, useAppSelector } from "app/store/hooks";
import FuseSplashScreen from "@fuse/core/FuseSplashScreen/FuseSplashScreen";
import { useAuthenticator } from "@aws-amplify/ui-react";
import { fetchUserAttributes } from "@aws-amplify/auth";
import { resetUser, selectUserRole, setUser } from "./user/store/userSlice";
import useAuth from "./useAuth";
import UserModel from "./user/models/UserModel";
import { User } from "./user";
import useJwtAuth from "./services/jwt/useJwtAuth";
import useFirebaseAuth from "./services/firebase/useFirebaseAuth";

type AuthenticationProps = {
  children: React.ReactNode;
};

function Authentication(props: AuthenticationProps) {
  const { children } = props;
  const { setAuthProvider, resetAuthProvider } = useAuth();

  const userRole = "ADMIN";
  const dispatch = useAppDispatch();

  /**
   * Auth Providers
   */

  /**
   * Amplify Auth
   */
  // const { user: amplifyUser, authStatus: amplifyAuthStatus } = useAuthenticator();

  /**
   * JWT Auth
   */
  const { user: jwtUser, authStatus: jwtAuthStatus } = useJwtAuth();

  /**
   * Firebase Auth
   */
  // const { user: firebaseUser, authStatus: firebaseAuthStatus } = useFirebaseAuth();

  /**
   * isLoading
   */
  const [isLoading, setIsLoading] = useState(true);

  /**
   * Check if services is in loading state
   */
  const inProgress = useMemo(
    () => jwtAuthStatus === "configuring",
    [jwtAuthStatus]
  );

  /**
   * Any user is authenticated
   */
  const authenticated = useMemo(
    () => jwtAuthStatus === "authenticated",
    [jwtAuthStatus]
  );

  /**
   * All users are unauthenticated
   */
  const unAuthenticated = useMemo(
    () => jwtAuthStatus === "unauthenticated",
    [jwtAuthStatus]
  );

  /**
   * Sign Out
   */
  useEffect(() => {
    if (!inProgress && unAuthenticated) {
      handleSignOut();
    }
  }, [inProgress, authenticated]);

  /**
   * Loading state is false when all services are done loading
   */
  useEffect(() => {
    if (!inProgress && !authenticated) {
      setIsLoading(false);
    }
  }, [inProgress, authenticated]);

  /**
   * Handle sign in
   */
  const handleSignIn = useCallback((provider: string, userState: User) => {
    dispatch(setUser(userState)).then(() => {
      setAuthProvider(provider);
      setIsLoading(false);
    });
  }, []);

  /**
   * Handle sign out
   */
  const handleSignOut = useCallback(() => {
    dispatch(resetUser());
    resetAuthProvider();
  }, []);

  /**
   * Handle Sign In on load
   */
  useEffect(() => {
    if (inProgress || !authenticated) {
      return;
    }
    if (jwtUser) {
      handleSignIn("jwt", jwtUser);
    }

  }, [
    inProgress,
    authenticated,
    jwtUser,
    isLoading,
  ]);

  return useMemo(
    () =>
      isLoading ? (
        <FuseSplashScreen />
      ) : (
        <BrowserRouter>
          <FuseAuthorization userRole={userRole}>{children}</FuseAuthorization>
        </BrowserRouter>
      ),
    [userRole, children, isLoading]
  );
}

export default Authentication;
