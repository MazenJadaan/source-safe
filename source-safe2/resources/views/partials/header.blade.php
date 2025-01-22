<div class="header d-flex align-items-center justify-content-between px-4 shadow-sm" style="height: 70px;">
    <!-- Left Section: Search Field -->
    <div class="search-container flex-grow-1 me-3">
        <form action="@yield('search_action', '#')" method="GET" class="position-relative">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Search..."
                style="width: 100%; max-width: 600px; padding-right: 40px;"
            >
            <button
                type="submit"
                class="btn position-absolute"
                style="right: 10px; top: 50%; transform: translateY(-50%); background: transparent; border: none; color: #0077B6;"
            >
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <!-- Right Section: Notification and User Dropdown -->
    <div class="d-flex align-items-center" >
        <!-- Notification Icon -->
        <div class="position-relative mx-3">
            <a href="{{ route('showNotifications') }}" 
               class="btn btn-light position-relative p-2 rounded-circle shadow-sm"
               style="font-size: 1.5rem;">
                <i class="bi-bell"></i>
                @if($unreadNotificationsCount > 0)
                    <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-circle" 
                          style="font-size: 0.75rem; padding: 0.4em 0.6em;">
                        {{ $unreadNotificationsCount }}
                    </span>
                @endif
            </a>
        </div>

        <!-- User Dropdown -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ \App\Utils\FileUtility::getFileUrl('/img/undraw_profile.svg') }}" 
                     alt="User Photo" 
                     class="rounded-circle" 
                     width="40" 
                     height="40">
                <span class="ms-2 fw-bold" style="color: #0077B6;">John Doe</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
