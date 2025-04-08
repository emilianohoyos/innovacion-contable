import React from "react";
import { Navigate, Outlet } from "react-router-dom";
import LoadingSpinner from "./../InitialPage/Sidebar/LoadingSpinner";
import { useDataFetch } from "./../hooks/useDataFetch";
import Cookies from "js-cookie";

const PrivateRoute = () => {
  const token = Cookies.get("token");
  const { getData } = useDataFetch();

  const { isLoading, data, error } = getData(
    ["valid-token"],
    "/me",
    { enabled: true },
  );

  if (isLoading) return <LoadingSpinner />;

  if (!token || error) {
    Cookies.remove("token");
    return <Navigate to="/signin" />;
  }

  return <Outlet />;
};

export default PrivateRoute;
