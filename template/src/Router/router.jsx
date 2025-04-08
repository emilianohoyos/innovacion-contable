import React from "react";
import { Route, Routes } from "react-router-dom";
import Header from "../InitialPage/Sidebar/Header";
import { pagesRoute, privateRoutes } from "./router.link";
import { Outlet } from "react-router-dom";
import Loader from "../feature-module/loader/loader";
import HorizontalSidebar from "../InitialPage/Sidebar/horizontalSidebar";
import PrivateRoute from "./privateRoute";

const AllRoutes = () => {
  const HeaderLayout = () => (
    <div className={`main-wrapper`}>
      <Header />
      <HorizontalSidebar />
      <Outlet />
      <Loader />
    </div>
  );

  const Authpages = () => (
    <div>
      <Outlet />
      <Loader />
    </div>
  );

  return (
    <div>
      <Routes>
        <Route element={<PrivateRoute />}>
          <Route path="/" element={<HeaderLayout />}>
            {privateRoutes.map((route, id) => (
              <Route path={route.path} element={route.element} key={id} />
            ))}
          </Route>
        </Route>

        <Route path={"/"} element={<Authpages />}>
          {pagesRoute.map((route, id) => (
            <Route path={route.path} element={route.element} key={id} />
          ))}
        </Route>
      </Routes>
    </div>
  );
};
export default AllRoutes;
