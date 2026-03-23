<div class="topbar border-bottom bg-white">
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center py-2">
            <div>
                <h4 class="mb-0 fw-bold">Legend</h4>
                <small class="text-muted">Inventory Management Portal</small>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="text-end">
                    <div class="fw-semibold">
                        {{ auth()->user()->name ?? 'User' }}</div>
                    <small class="text-muted">{{ auth()->user()->email ?? '' }}</small>
                </div>


                <span class="badge bg-dark text-uppercase px-3 py-2">
                    {{ auth()->user()->role ?? 'ROLE' }}
                </span>

                <span class="badge bg-dark text-uppercase px-3 py-2">
                    <a href="{{ route('dashboard') }}">
                        {{ __('Dashboard') }}
                    </a>
                </span>

                <span class="badge bg-dark text-uppercase px-3 py-2">
                    <a href="{{ route('profile.edit') }}">
                        {{ __('Profile') }}
                    </a>
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>