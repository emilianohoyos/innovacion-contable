import React, { useState } from "react";
import { FileText, Calendar, BarChart2 } from "react-feather";
import { Link } from "react-router-dom";

const HorizontalSidebar = () => {
  const [isActive4, setIsActive4] = useState(false);

 
  const handleSelectClick4 = () => {
    setIsActive4(!isActive4);
  };

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
              to="/"
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

          <li className="submenu">
            <Link
              to="#"
              onClick={handleSelectClick4}
              className={isActive4 ? "subdrop" : ""}
            >
              <img src="assets/img/icons/users1.svg" alt="img" />
              <span>User Management</span> <span className="menu-arrow" />
            </Link>
            <ul style={{ display: isActive4 ? "block" : "none" }}>

              <li className="submenu">
                <Link
                  to="#"
                  onClick={handleSelectClick4}
                  className={isActive4 ? "subdrop" : ""}
                >
                  <span>Base UI</span>
                  <span className="menu-arrow" />
                </Link>
                <ul style={{ display: isActive4 ? "block" : "none" }}>
                  <li>
                    <Link to="ui-alerts">Alerts</Link>
                  </li>
                  <li>
                    <Link to="ui-accordion">Accordion</Link>
                  </li>
                  <li>
                    <Link to="ui-avatar">Avatar</Link>
                  </li>
                  <li>
                    <Link to="ui-badges">Badges</Link>
                  </li>
                  <li>
                    <Link to="ui-borders">Border</Link>
                  </li>
                  <li>
                    <Link to="ui-buttons">Buttons</Link>
                  </li>
                  <li>
                    <Link to="ui-buttons-group">Button Group</Link>
                  </li>
                  <li>
                    <Link to="ui-breadcrumb">Breadcrumb</Link>
                  </li>
                  <li>
                    <Link to="ui-cards">Card</Link>
                  </li>
                  <li>
                    <Link to="ui-carousel">Carousel</Link>
                  </li>
                  <li>
                    <Link to="ui-colors">Colors</Link>
                  </li>
                  <li>
                    <Link to="ui-dropdowns">Dropdowns</Link>
                  </li>
                  <li>
                    <Link to="ui-grid">Grid</Link>
                  </li>
                  <li>
                    <Link to="ui-images">Images</Link>
                  </li>
                  <li>
                    <Link to="ui-lightbox">Lightbox</Link>
                  </li>
                  <li>
                    <Link to="ui-media">Media</Link>
                  </li>
                  <li>
                    <Link to="ui-modals">Modals</Link>
                  </li>
                  <li>
                    <Link to="ui-offcanvas">Offcanvas</Link>
                  </li>
                  <li>
                    <Link to="ui-pagination">Pagination</Link>
                  </li>
                  <li>
                    <Link to="ui-popovers">Popovers</Link>
                  </li>
                  <li>
                    <Link to="ui-progress">Progress</Link>
                  </li>
                  <li>
                    <Link to="ui-placeholders">Placeholders</Link>
                  </li>
                  <li>
                    <Link to="ui-rangeslider">Range Slider</Link>
                  </li>
                  <li>
                    <Link to="ui-spinner">Spinner</Link>
                  </li>
                  <li>
                    <Link to="ui-sweetalerts">Sweet Alerts</Link>
                  </li>
                  <li>
                    <Link to="ui-nav-tabs">Tabs</Link>
                  </li>
                  <li>
                    <Link to="ui-toasts">Toasts</Link>
                  </li>
                  <li>
                    <Link to="ui-tooltips">Tooltips</Link>
                  </li>
                  <li>
                    <Link to="ui-typography">Typography</Link>
                  </li>
                  <li>
                    <Link to="ui-video">Video</Link>
                  </li>
                  <li>
                    <Link to="ui-ribbon">Ribbon</Link>
                  </li>
                  <li>
                    <Link to="ui-clipboard">Clipboard</Link>
                  </li>
                  <li>
                    <Link to="ui-drag-drop">Drag &amp; Drop</Link>
                  </li>
                  <li>
                    <Link to="ui-rangeslider">Range Slider</Link>
                  </li>
                  <li>
                    <Link to="ui-rating">Rating</Link>
                  </li>
                  <li>
                    <Link to="ui-text-editor">Text Editor</Link>
                  </li>
                  <li>
                    <Link to="ui-counter">Counter</Link>
                  </li>
                  <li>
                    <Link to="ui-scrollbar">Scrollbar</Link>
                  </li>
                  <li>
                    <Link to="ui-stickynote">Sticky Note</Link>
                  </li>
                  <li>
                    <Link to="ui-timeline">Timeline</Link>
                  </li>
                  <li>
                    <Link to="chart-apex">Apex Charts</Link>
                  </li>
                  <li>
                    <Link to="chart-c3">Chart C3</Link>
                  </li>
                  <li>
                    <Link to="chart-js">Chart Js</Link>
                  </li>
                  <li>
                    <Link to="chart-morris">Morris Charts</Link>
                  </li>
                  <li>
                    <Link to="chart-flot">Flot Charts</Link>
                  </li>
                  <li>
                    <Link to="chart-peity">Peity Charts</Link>
                  </li>
                  <li>
                    <Link to="icon-fontawesome">Fontawesome Icons</Link>
                  </li>
                  <li>
                    <Link to="icon-feather">Feather Icons</Link>
                  </li>
                  <li>
                    <Link to="icon-ionic">Ionic Icons</Link>
                  </li>
                  <li>
                    <Link to="icon-material">Material Icons</Link>
                  </li>
                  <li>
                    <Link to="icon-pe7">Pe7 Icons</Link>
                  </li>
                  <li>
                    <Link to="icon-simpleline">Simpleline Icons</Link>
                  </li>
                  <li>
                    <Link to="icon-themify">Themify Icons</Link>
                  </li>
                  <li>
                    <Link to="icon-weather">Weather Icons</Link>
                  </li>
                  <li>
                    <Link to="icon-typicon">Typicon Icons</Link>
                  </li>
                  <li>
                    <Link to="icon-flag">Flag Icons</Link>
                  </li>
                  <li>
                    <Link to="form-basic-inputs">Basic Inputs</Link>
                  </li>
                  <li>
                    <Link to="form-checkbox-radios">
                      Checkbox &amp; Radios
                    </Link>
                  </li>
                  <li>
                    <Link to="form-input-groups">Input Groups</Link>
                  </li>
                  <li>
                    <Link to="form-grid-gutters">Grid &amp; Gutters</Link>
                  </li>
                  <li>
                    <Link to="form-select">Form Select</Link>
                  </li>
                  <li>
                    <Link to="form-mask">Input Masks</Link>
                  </li>
                  <li>
                    <Link to="form-fileupload">File Uploads</Link>
                  </li>
                  <li>
                    <Link to="form-validation">Form Validation</Link>
                  </li>
                  <li>
                    <Link to="form-select2">Select2</Link>
                  </li>
                  <li>
                    <Link to="form-wizard">Form Wizard</Link>
                  </li>
                  <li>
                    <Link to="form-horizontal">Horizontal Form</Link>
                  </li>
                  <li>
                    <Link to="form-vertical">Vertical Form</Link>
                  </li>
                  <li>
                    <Link to="form-floating-labels">Floating Labels</Link>
                  </li>
                  <li>
                    <Link to="tables-basic">Basic Tables </Link>
                  </li>
                  <li>
                    <Link to="data-tables">Data Table </Link>
                  </li>
                </ul>
              </li>

            </ul>
          </li>
        </ul>
      </div>
    </div>
  );
};

export default HorizontalSidebar;
