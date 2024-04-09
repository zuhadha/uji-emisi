<aside id="sidebar">
    <div class="h-100">
        <div class="sidebar-logo">
            <a href="/">
                <img src="{{ asset('Lambang_Kota_Bandung.png') }}" alt="Logo" class="logo">
                UJI EMISI
            </a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="/dashboard" class="sidebar-link logout-button">
                    <i class="fa fa-gauge pe-2"></i>
                    Dashboard
                </a>
            </li>
        </ul>
        <!-- Sidebar Navigation -->
        <h6 class= "sidebar-heading d-flex justify-content-between align-item-center px-3 mb-1 text-muted menu-title">
            <span>Menu</span>
        </h6>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                @can('admin')
                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard"
                    aria-expanded="false" aria-controls="dashboard">
                    <i class="fa fa-car pe-2"></i>
                    Kendaraan
                </a>
                <ul id="dashboard" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/dashboard/kendaraan" class="sidebar-link">List Kendaraan</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/dashboard/kendaraan/create" class="sidebar-link">Tambah Kendaraan</a>
                    </li>
                </ul>
                @elsecan('dinas')
                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard"
                    aria-expanded="false" aria-controls="dashboard">
                    <i class="fa fa-car pe-2"></i>
                    Kendaraan
                </a>
                <ul id="dashboard" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="/dashboard/kendaraan" class="sidebar-link">List Kendaraan</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/dashboard/kendaraan/create" class="sidebar-link">Tambah Kendaraan</a>
                    </li>
                </ul>
                @else
                <a href="/dashboard/kendaraan" class="sidebar-link">
                    <i class="fa fa-car pe-2"></i>
                    List Kendaraan
                </a>
                @endcan
            </li>
            
            

            <li class="sidebar-item">
                <form action="/logout" method="post" id="logout-form">
                    @csrf
                    <button type="submit" class="sidebar-link logout-button">
                        <i class="fa fa-sign-out pe-2"></i>
                        Logout
                    </button>
                </form>
            </li>
        </ul>

        <!-- Administrator Navigation -->
        @can('admin')
            <h6
                class= "sidebar-heading d-flex justify-content-between align-item-center px-3 mt-4 mb-1 text-muted menu-title">
                <span>Administrator</span>
            </h6>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                <li class="sidebar-item">
                    <a href="/dashboard/user" class="sidebar-link"><i class="fa fa-users pe-2"></i> Pengguna</a>
                </li>
                </li>
            </ul>
        @endcan
    </div>
</aside>
