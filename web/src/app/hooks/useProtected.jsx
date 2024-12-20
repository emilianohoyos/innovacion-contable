import { Navigate } from "react-router-dom";

const ProtectedRoute = ({ isAuthenticated, children }) => {
  if (isAuthenticated === false) {
    return <Navigate to={`${process.env.PUBLIC_URL}/login`} replace />;
  }

 
  return children;
};

export default ProtectedRoute;
