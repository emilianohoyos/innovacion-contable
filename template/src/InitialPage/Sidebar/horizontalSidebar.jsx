import React, { useState } from "react";
import { FileText, Calendar, BarChart2 } from "react-feather";
import { Link } from "react-router-dom";

const HorizontalSidebar = () => {
  return (
    <div className="sidebar horizontal-sidebar">
      <div id="sidebar-menu-3" className="sidebar-menu">
        <ul className="nav">
          <li >
            <Link
              to="/"
              
            >
              <FileText />
              <span> Solicitudes</span>
            </Link>
          </li>

          <li >
            <Link
              to="/month"
            >
              <Calendar />
              <span> Contabilidad Mensual</span>
            </Link>
          </li>

          <li >
            <Link
              to="/"
            >
              <BarChart2 />
              <span> Contabilidad Anual</span>
            </Link>
          </li>
        </ul>
      </div>
    </div>
  );
};

export default HorizontalSidebar;
