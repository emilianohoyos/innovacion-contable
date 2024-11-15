<aside class="sidebar-wrapper">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="{{ URL::asset('build/images/logo-icon.png') }}" class="logo-img" alt="">
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">Metoxi</h5>
        </div>
        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav" data-simplebar="true">

        <!--navigation-->
        <ul class="metismenu" id="sidenav">
            {{-- <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">home</i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
                <ul>
                    <li><a href="/"><i class="material-icons-outlined">arrow_right</i>eCommerce</a>
                    </li>
                    <li><a href="index2"><i class="material-icons-outlined">arrow_right</i>Alternate</a>
                    </li>
                </ul>
            </li> --}}
            <li>
                <a href="{{ route('dashboard.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">home</i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>

            <li class="menu-label">Aplicacion</li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">supervisor_account</i>
                    </div>
                    <div class="menu-title">Empleados</div>
                </a>
                <ul>
                    <li><a href="{{ route('employee.create') }}"><i
                                class="material-icons-outlined">arrow_right</i>Registro</a>
                    </li>
                    <li><a href="{{ route('employee.index') }}"><i
                                class="material-icons-outlined">arrow_right</i>Consultar</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">person_outline</i>
                    </div>
                    <div class="menu-title">Clientes</div>
                </a>
                <ul>
                    <li><a href="{{ route('client.create') }}"><i
                                class="material-icons-outlined">arrow_right</i>Registrar
                        </a>
                    </li>
                    <li><a href="{{ route('client.index') }}"><i
                                class="material-icons-outlined">arrow_right</i>Consultar</a>

                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">assignment</i>
                    </div>
                    <div class="menu-title">Solicitudes</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('application.create') }}"><i
                                class="material-icons-outlined">arrow_right</i>Registrar
                        </a>
                    </li>
                    <li><a href="{{ route('application.index') }}"><i
                                class="material-icons-outlined">arrow_right</i>Consultar</a>

                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="material-icons-outlined">settings</i>
                    </div>
                    <div class="menu-title">Configuraciones</div>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('applytype.index') }}"><i class="material-icons-outlined">arrow_right</i>Tipo
                            Solicitud
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('applydocumenttype.index') }}"><i
                                class="material-icons-outlined">arrow_right</i>
                            Tipo Documento Solicitud
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
        <!--end navigation-->
    </div>
    <div class="sidebar-bottom gap-4">
        <div class="dark-mode">
            <a href="javascript:;" class="footer-icon dark-mode-icon">
                <i class="material-icons-outlined">dark_mode</i>
            </a>
        </div>


    </div>
</aside>
