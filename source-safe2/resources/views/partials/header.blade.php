
<div class="header d-flex align-items-center justify-content-between px-4 shadow-sm">
    <!-- Search Field -->
    <div class="search-container d-flex align-items-center position-relative">
        <input type="text" class="form-control search-input" placeholder="Search..." style="width: 600px; padding-right: 40px;">
        <i class="bi bi-search search-icon position-absolute" style="right: 15px; top: 50%; transform: translateY(-50%); color: #0077B6;"></i>
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
                <img src="{{asset('/img/undraw_profile.svg')}}" alt="User Photo" class="rounded-circle" width="50" height="50">
                <span class="ms-2 fw-bold" style="color: #0077B6">John Doe</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
