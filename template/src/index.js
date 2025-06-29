import React from "react";
import { BrowserRouter } from "react-router-dom";
import { createRoot } from "react-dom/client";
import { Provider } from "react-redux";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { ToastContainer } from "react-toastify";

import "../node_modules/bootstrap/dist/css/bootstrap.min.css";
import "../node_modules/bootstrap/dist/js/bootstrap.bundle.js";
import "../src/style/css/feather.css";
import "../src/style/css/line-awesome.min.css";
import "../src/style/scss/main.scss";
import "../src/style/icons/fontawesome/css/fontawesome.min.css";
import "../src/style/icons/fontawesome/css/all.min.css";

import store from "./core/redux/store.jsx";
import AllRoutes from "./Router/router.jsx";

const rootElement = document.getElementById("root");
document.documentElement.setAttribute("data-layout-style", "modern");
document.documentElement.setAttribute("data-layout-mode", "light_mode");
document.documentElement.setAttribute("data-nav-color", "dark");
const queryClient = new QueryClient();

if (rootElement) {
  const root = createRoot(rootElement);
  root.render(
    <React.StrictMode>
      <QueryClientProvider client={queryClient}>
        <Provider store={store}>
          <BrowserRouter>
            <ToastContainer />
            <AllRoutes />
          </BrowserRouter>
        </Provider>
      </QueryClientProvider>
    </React.StrictMode>
  );
} else {
  console.error("Element with id 'root' not found.");
}
