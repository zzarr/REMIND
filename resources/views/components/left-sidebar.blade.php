<div class="left-sidebar">
    <!-- LOGO -->
    <div class="brand">

        @php
            $role = Auth::user()->role;
            $url = '#'; // default

            if ($role === 'admin') {
                $url = route('admin.dashboard');
            } elseif ($role === 'operator') {
                $url = route('operator.dashboard');
            } elseif ($role === 'tim peneliti') {
                $url = route('tim_peneliti.dashboard');
            }
        @endphp

        <a href="{{ $url }}" class="logo">
            <span style="margin: 0">
                <img src="{{ asset('img/LOGO/remind_logo_color.png') }}" alt="logo-small" class="logo" height="40"
                    data-aos="fade-right" data-aos-duration="1200">
            </span>
            <span>
                <img src="assets/images/logo.png" alt="logo-large" class="logo-lg logo-light">
                <img src="{{ asset('img/TYPOGRAPHY/remind_typography_black.png') }}" alt="logo-large"
                    class="logo-lg logo-dark" data-aos="fade-left" data-aos-duration="1200">

            </span>
        </a>
    </div>
    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <div class="menu-body navbar-vertical tab-content">
            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav">


                    <!-- Menu ini hanya untuk role 'operator' -->
                    @if (Auth::check() && Auth::user()->role === 'operator')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('operator.dashboard') }}"><i
                                    class="ti ti-home menu-icon"></i><span>Dashboard</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('operator.akun.index') }}"><i
                                    class="ti ti-user menu-icon"></i><span>Manajemen Akun
                                </span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('operator.pasien.index') }}"><i
                                    class="fas fa-bed menu-icon"></i><span>Pasien</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('operator.kuisioner.index') }}"><i
                                    class="ti ti-clipboard menu-icon"></i><span>Kuisioner</span></a>
                        </li>
                    @endif

                    <!-- Menu ini hanya untuk role 'tim peneliti' -->
                    @if (Auth::check() && Auth::user()->role === 'tim peneliti')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tim_peneliti.dashboard') }}"data-aos="fade-right"
                                data-aos-duration="1000"><i class="ti ti-home menu-icon"></i><span>Dashboard</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tim_peneliti.pasien.index') }}" data-aos="fade-right"
                                data-aos-duration="1100"><i class="fas fa-bed menu-icon"></i><span>Pasien</span></a>
                        </li>




                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tim_peneliti.hasil.index') }}" data-aos="fade-right"
                                data-aos-duration="1200"><i class="ti ti-file-report menu-icon"></i><span>Hasil
                                    Test</span></a>
                        </li>
                    @endif

                </ul><!--end navbar-nav--->
            </div><!--end sidebarCollapse-->
        </div>
    </div>
</div>
