<nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="{{ route('rents.index') }}" class="nav-link {{ isset($active) && $active == 'rents' ? 'active' : '' }}">
                    @include('icons.stats')
                    Аренда и Доходы
                </a>
            </li>

            <li>
                <a href="{{ route('cars.index') }}" class="nav-link {{ isset($active) && $active == 'cars' ? 'active' : '' }}">
                    @include('icons.car')
                    Машины
                </a>
            </li>

            <li>
                <a href="{{ route('oilchanges.index') }}" class="nav-link {{ isset($active) && $active == 'oilchanges' ? 'active' : '' }}">
                    @include('icons.oilchange')
                    Замена масла
                </a>
            </li>

            <li>
                <a href="{{ route('users.index') }}" class="nav-link {{ isset($active) && $active == 'users' ? 'active' : '' }}">
                    @include('icons.driver')
                    Водители
                </a>
            </li>

            <li>
                <a href="{{ route('penalties.index') }}" class="nav-link {{ isset($active) && $active == 'penalties' ? 'active' : '' }}">
                    @include('icons.penalty')
                    Штрафы и ДТП
                </a>
            </li>
        </ul>

        <!-- // TODO: divide by role
        // admin: everything
        // manager: add rents(comments), add oilchanges -->

        <!-- <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Добавить штраф/ДТП</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-plus-circle align-text-bottom" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-file-text align-text-bottom" aria-hidden="true">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Current month
                </a>
            </li>
        </ul> -->
    </div>
</nav>
