<aside class="sidebar" id="sidebar">
    <div class="logo">
        <img src="{{ asset('image/Via Computer Logo.png') }}" alt="Logo">
    </div>

    <nav>
        <ul>
            <li class="nav-item">
                <a href="{{ route('management-asset/dasboard') }}"
                   class="nav-link {{ request()->is('dasboard') ? 'active' : '' }}">
                    <span class="icon"><img src="{{ asset('image/dashboard.png') }}" alt="Dashboard"></span>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('management-asset/asset') }}"
                   class="nav-link {{ request()->is('asset') ? 'active' : '' }}">
                    <span class="icon">
                        <img src="{{ asset('image/asset.png') }}" alt="Asset">
                    </span>
                    <span>Asset</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('management-asset/rental') }}"
                   class="nav-link {{ request()->is('rental') ? 'active' : '' }}">
                    <span class="icon"><img src="{{ asset('image/rent.png') }}" alt="Rent"></span>
                    <span>Rental</span>
                </a>
            </li>

            <!-- Pengiriman + Submenu -->
            <li class="nav-item has-submenu">
                <a href="#" class="nav-link">
                    <span class="icon"><img src="{{ asset('image/rent.png') }}" alt="Rent"></span>
                    <span>Pengiriman</span>
                    <span class="dropdown-arrow">&#9662;</span>
                </a>
                <ul class="submenu">
                    @foreach ($data_project as $p)
                        <li>
                            <a href="{{ route('components.pengiriman', $p->id) }}"
                            class="{{ request()->is('pengiriman/'.$p->id.'/dashboard-pengiriman') ? 'active' : '' }}">
                                {{ $p->nama }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <!-- Tagihan + Submenu -->
            <li class="nav-item has-submenu">
                <a href="#" class="nav-link">
                    <span class="icon"><img src="{{ asset('image/rent.png') }}" alt="Rent"></span>
                    <span>Tagihan</span>
                    <span class="dropdown-arrow">&#9662;</span>
                </a>

                <ul class="submenu">
                   @foreach ($data_project as $p)
                        <a href="{{ route('dashboardtagihan', $p->id) }}"
                        
                        class="{{ request()->is('project/'.$p->id.'/dashboard-tagihan') ? 'active' : '' }}">
                            {{ $p->nama }}
                        </a>
                    @endforeach
                </ul>
            </li>
        </ul>
    </nav>

    <div class="logout">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="logout-btn">
                <span class="icon"><img src="{{ asset('image/logout.png') }}" alt="Logout"></span>
                Logout
            </button>
        </form>
    </div>
</aside>


