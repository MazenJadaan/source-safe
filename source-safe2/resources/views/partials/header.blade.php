
<div class="header d-flex align-items-center justify-content-between px-4 shadow-sm">
    <!-- Search Field -->
    <div class="search-container d-flex align-items-center ">
        <form action="@yield('search_action', '#')" method="GET" class="w-100">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control search-input"
                placeholder="Search..."
                style="width: 600px; padding-right: 40px;"
            >
            <button
                type="submit"
                class="btn search-icon-btn position-absolute"
                style="position:absolute;  right: 15px; bottom: 10px; transform: translateY(-50%); background: transparent; border: none; color: #0077B6;"
            >
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <!-- Right Section: Notification and User Dropdown -->
    <div class="d-flex align-items-center">
        <!-- Notification Icon -->
        <div class="position-relative mx-3 me-4">
            <button class="btn btn-outline-light p-0" style="font-size: 1.5rem; border: none; background: transparent;">
                <i class="bi-bell"></i>
            </button>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                3
            </span>
        </div>

        <!-- User Dropdown -->
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{\App\Utils\FileUtility::getFileUrl('/img/undraw_profile.svg') }}" alt="User Photo" class="rounded-circle" width="50" height="50">
                <span class="ms-2 fw-bold" style="color: #0077B6">John Doe</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
