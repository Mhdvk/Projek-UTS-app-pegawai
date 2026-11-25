<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    @vite('resources/css/master.css')
</head>

<body>
    <header class="app-header">
        <div class="header-inner">
            <a href="{{ route('employees.index') }}" class="app-brand">
                App Pegawai
                <span class="brand-badge">Sistem HR</span>
            </a>

            <nav class="app-nav" aria-label="Navigasi Utama">
                <ul>
                    <li>
                        <a href="{{ route('employees.index') }}" 
                           class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
                            Pegawai
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('departments.index') }}" 
                           class="nav-link {{ request()->is('departments*') ? 'active' : '' }}">
                            Departemen
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('attendance.index') }}" 
                           class="nav-link {{ request()->is('attendance*') ? 'active' : '' }}">
                            Absensi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('positions.index') }}" 
                           class="nav-link {{ request()->is('positions*') ? 'active' : '' }}">
                            Jabatan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('salaries.index') }}" 
                           class="nav-link {{ request()->is('salaries*') ? 'active' : '' }}">
                            Gaji
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="header-actions">
                @if(auth()->check())
                    <div class="user-meta">
                        <span>{{ auth()->user()->name }}</span>
                        <span class="user-role-badge">{{ auth()->user()->role }}</span>
                    </div>
                    <a href="{{ route('logout') }}" 
                       class="btn-logout" 
                       onclick="return confirm('Yakin ingin logout?')">
                        Logout
                    </a>
                @endif
            </div>
        </div>
    </header>

    <main class="app-main">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul style="margin: 0; padding-left: 1.25rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="app-footer">
        <p>&copy; {{ date('Y') }} App Pegawai. Hak cipta dilindungi undang-undang.</p>
    </footer>
</body>

</html>
