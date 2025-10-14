<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="sidebar-brand">
            Stylus<span>CMS</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span><span></span><span></span>
        </div>
    </div>

    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">Access Control</li>

            {{-- Users --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-users" role="button" aria-expanded="false"
                    aria-controls="menu-users">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Users</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.user.*') ? 'show' : '' }}" id="menu-users">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.user.index') }}"
                                class="nav-link {{ request()->routeIs('super.user.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Roles --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-roles" role="button" aria-expanded="false"
                    aria-controls="menu-roles">
                    <i class="link-icon" data-feather="shield"></i>
                    <span class="link-title">Roles</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.role.*') ? 'show' : '' }}" id="menu-roles">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.roles.index') }}"
                                class="nav-link {{ request()->routeIs('super.role.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Permissions --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-permissions" role="button"
                    aria-expanded="false" aria-controls="menu-permissions">
                    <i class="link-icon" data-feather="key"></i>
                    <span class="link-title">Permissions</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.permission.*') ? 'show' : '' }}"
                    id="menu-permissions">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.permissions.index') }}"
                                class="nav-link {{ request()->routeIs('super.permission.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Settings --}}
            {{-- <li class="nav-item nav-category">CMS</li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-leads" role="button" aria-expanded="false"
                    aria-controls="menu-leads">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Leads</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.leads.*') ? 'show' : '' }}" id="menu-leads">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.leads.index') }}"
                                class="nav-link {{ request()->routeIs('super.leads.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>
            </li>



            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-portfolios" role="button"
                    aria-expanded="false" aria-controls="menu-portfolios">
                    <i class="link-icon" data-feather="menu"></i>
                    <span class="link-title">Portfolios</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.portfolios.*') ? 'show' : '' }}"
                    id="menu-portfolios">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.portfolios.index') }}"
                                class="nav-link {{ request()->routeIs('super.portfolios.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-settings" role="button"
                    aria-expanded="false" aria-controls="menu-settings">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Settings</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.settings.*') ? 'show' : '' }}" id="menu-settings">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.settings.index') }}"
                                class="nav-link {{ request()->routeIs('super.settings.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-services" role="button"
                    aria-expanded="false" aria-controls="menu-services">
                    <i class="link-icon" data-feather="server"></i>
                    <span class="link-title">Services</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.services.*') ? 'show' : '' }}" id="menu-services">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.services.index') }}"
                                class="nav-link {{ request()->routeIs('super.services.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-tech-stack" role="button"
                    aria-expanded="false" aria-controls="menu-tech-stack">
                    <i class="link-icon" data-feather="tool"></i>
                    <span class="link-title">Tech Stack</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.tech-stacks.*') ? 'show' : '' }}"
                    id="menu-tech-stack">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.tech-stacks.index') }}"
                                class="nav-link {{ request()->routeIs('super.tech-stacks.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
 --}}



            {{-- Settings --}}
            <li class="nav-item nav-category">Settings</li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-pakets" role="button" aria-expanded="false"
                    aria-controls="menu-pakets">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Pakets</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.pakets.*') ? 'show' : '' }}" id="menu-pakets">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.pakets.index') }}"
                                class="nav-link {{ request()->routeIs('super.pakets.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-servers" role="button" aria-expanded="false"
                    aria-controls="menu-servers">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Servers</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.servers.*') ? 'show' : '' }}" id="menu-servers">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.servers.index') }}"
                                class="nav-link {{ request()->routeIs('super.servers.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-pelanggans" role="button"
                    aria-expanded="false" aria-controls="menu-pelanggans">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Pelanggans</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.pelanggans.*') ? 'show' : '' }}"
                    id="menu-pelanggans">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.pelanggans.index') }}"
                                class="nav-link {{ request()->routeIs('super.pelanggans.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-bulans" role="button"
                    aria-expanded="false" aria-controls="menu-bulans">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">bulans</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.bulans.*') ? 'show' : '' }}" id="menu-bulans">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.bulans.index') }}"
                                class="nav-link {{ request()->routeIs('super.bulans.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item nav-category">Payment</li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-tagihans" role="button"
                    aria-expanded="false" aria-controls="menu-tagihans">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">tagihans</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.tagihans.*') ? 'show' : '' }}" id="menu-tagihans">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.tagihans.index') }}"
                                class="nav-link {{ request()->routeIs('super.tagihans.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="collapse {{ request()->routeIs('super.tagihans.*') ? 'unpaid' : '' }}"
                    id="menu-tagihans">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('super.tagihans.unpaid') ? 'active' : '' }}"
                                href="{{ route('super.tagihans.unpaid') }}">
                                <i data-feather="alert-circle" class="icon-sm"></i>
                                <span>Tagihan Belum Lunas</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#menu-payments" role="button"
                    aria-expanded="false" aria-controls="menu-payments">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Payments</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('super.payments.*') ? 'show' : '' }}" id="menu-payments">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('super.payments.index') }}"
                                class="nav-link {{ request()->routeIs('super.payments.index') ? 'active' : '' }}">
                                Show
                            </a>
                        </li>
                    </ul>
                </div>


                <div class="collapse {{ request()->routeIs('super.payments.*') ? 'show' : '' }}" id="menu-payments">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('super.payments.lookup') ? 'active' : '' }}"
                                href="{{ route('super.payments.lookup') }}">
                                <i data-feather="search" class="icon-sm"></i>
                                <span>Pembayaran (Lookup)</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>





        </ul>
    </div>
</nav>
