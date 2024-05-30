<nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="{{ route('rents.index') }}"
                    class="nav-link {{ isset($active) && $active == 'rents' ? 'active' : '' }}">
                    @include('icons.stats')
                    Аренда и Доходы
                </a>
            </li>

            <li>
                <a href="{{ route('cars.index') }}"
                    class="nav-link {{ isset($active) && $active == 'cars' ? 'active' : '' }}">
                    @include('icons.car')
                    Машины
                </a>
            </li>

            <li>
                <a href="{{ route('oilchanges.index') }}"
                    class="nav-link {{ isset($active) && $active == 'oilchanges' ? 'active' : '' }}">
                    @include('icons.oilchange')
                    Замена масла
                </a>
            </li>

            <li>
                <a href="{{ route('users.index') }}"
                    class="nav-link {{ isset($active) && $active == 'users' ? 'active' : '' }}">
                    @include('icons.driver')
                    Водители
                </a>
            </li>

            <li>
                <a href="{{ route('penalties.index') }}"
                    class="nav-link {{ isset($active) && $active == 'penalties' ? 'active' : '' }}">
                    @include('icons.penalty')
                    Штрафы и ДТП
                </a>
            </li>
        </ul>

        @if(auth()->user()->roleIs('admin'))
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            </h6>

            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a href="{{ route('employees.index') }}"
                        class="nav-link {{ isset($active) && $active == 'employees' ? 'active' : '' }}">
                        @include('icons.document')
                        Работники и Права доступа
                    </a>
                </li>
            </ul>
        @endif
    </div>
</nav>
