import React from "react";
import { Route, Navigate } from "react-router-dom";
import Application from "../pages/request/Application";
import CreateApplication from "../pages/request/CreateApplication";

const routes = all_routes;

import Signin from "../feature-module/pages/login/signin";
import Forgotpassword from "../feature-module/pages/forgotpassword/forgotpassword";
import Resetpassword from "../feature-module/pages/resetpassword/resetpassword";
import EmailVerification from "../feature-module/pages/emailverification/emailverification";
import EmailverificationTwo from "../feature-module/pages/emailverification/emailverificationTwo";
import EmailverificationThree from "../feature-module/pages/emailverification/emailverificationThree";
import Twostepverification from "../feature-module/pages/twostepverification/twostepverification";
import TwostepverificationTwo from "../feature-module/pages/twostepverification/twostepverificationTwo";
import TwostepverificationThree from "../feature-module/pages/twostepverification/twostepverificationThree";
import Lockscreen from "../feature-module/pages/lockscreen";
import Error404 from "../feature-module/pages/errorpages/error404";
import Error500 from "../feature-module/pages/errorpages/error500";
import Blankpage from "../feature-module/pages/blankpage";
import Comingsoon from "../feature-module/pages/comingsoon";
import Undermaintainence from "../feature-module/pages/undermaintainence";

import { all_routes } from "./all_routes";
import Month from "../pages/month/Month";
import FolderDetail from "../pages/month/FolderDetail";
export const privateRoutes = [
  {
    id: 1,
    path: routes.dashboard,
    name: "home",
    element: <Application />,
    route: Route,
  },
  {
    id: 2,
    path: routes.createApplication,
    name: "createApplication",
    element: <CreateApplication />,
    route: Route,
  },
  {
    id: 3,
    path: routes.month,
    name: "month",
    element: <Month />,
    route: Route,
  },
  {
    id: 4,
    path: routes.folderDetail,
    name: "folderDetail",
    element: <FolderDetail />,
    route: Route,
  },
  {
    id: 10,
    path: "/",
    name: "Root",
    element: <Navigate to="/" />,
    route: Route,
  },
  {
    id: 11,
    path: "*",
    name: "NotFound",
    element: <Navigate to="/" />,
    route: Route,
  },

];
export const posRoutes = [

];

export const pagesRoute = [
  {
    id: 1,
    path: routes.signin,
    name: "signin",
    element: <Signin />,
    route: Route,
  },
  {
    id: 7,
    path: routes.forgotPassword,
    name: "forgotPassword",
    element: <Forgotpassword />,
    route: Route,
  },
  {
    id: 9,
    path: routes.resetpassword,
    name: "resetpassword",
    element: <Resetpassword />,
    route: Route,
  },
  {
    id: 12,
    path: routes.emailverification,
    name: "emailverification",
    element: <EmailVerification />,
    route: Route,
  },
  {
    id: 12,
    path: routes.emailverificationTwo,
    name: "emailverificationTwo",
    element: <EmailverificationTwo />,
    route: Route,
  },
  {
    id: 13,
    path: routes.emailverificationThree,
    name: "emailverificationThree",
    element: <EmailverificationThree />,
    route: Route,
  },
  {
    id: 14,
    path: routes.twostepverification,
    name: "twostepverification",
    element: <Twostepverification />,
    route: Route,
  },
  {
    id: 15,
    path: routes.twostepverificationTwo,
    name: "twostepverificationTwo",
    element: <TwostepverificationTwo />,
    route: Route,
  },
  {
    id: 16,
    path: routes.twostepverificationThree,
    name: "twostepverificationThree",
    element: <TwostepverificationThree />,
    route: Route,
  },
  {
    id: 17,
    path: routes.lockscreen,
    name: "lockscreen",
    element: <Lockscreen />,
    route: Route,
  },
  {
    id: 18,
    path: routes.error404,
    name: "error404",
    element: <Error404 />,
    route: Route,
  },
  {
    id: 19,
    path: routes.error500,
    name: "error500",
    element: <Error500 />,
    route: Route,
  },
  {
    id: 20,
    path: routes.comingsoon,
    name: "comingsoon",
    element: <Comingsoon />,
    route: Route,
  },
  {
    id: 21,
    path: routes.undermaintenance,
    name: "undermaintenance",
    element: <Undermaintainence />,
    route: Route,
  },
];
