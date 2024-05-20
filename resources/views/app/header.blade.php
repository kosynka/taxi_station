<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="{{ route('dashboard') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home align-text-bottom"
            aria-hidden="true">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
        ADMIN PANEL
    </a>

    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <h5 class="text-muted w-100" type="text">
        <div id="auto-datetime"></div>
    </h5>
    <!-- <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search"
        aria-label="Search"> -->

    <h5 class="text-muted" type="text">
        {{ auth()->user()->email }}
    </h5>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap text-muted">
            <a class="nav-link px-3" href="{{ route('custom.logout') }}">Выйти</a>
        </div>
    </div>
</header>

<script>
    function updateTime() {
        var now = new Date();
        var date = now.toLocaleDateString();
        var time = now.toLocaleTimeString();
        var dateTimeString = date + ' ' + time;
        document.getElementById('auto-datetime').textContent = dateTimeString;
    }

    setInterval(updateTime, 1000);

    updateTime();
</script>
