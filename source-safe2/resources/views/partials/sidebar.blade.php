<!-- Sidebar -->
<div class="sidebar" style="background: linear-gradient(to bottom, rgba(0, 119, 182, 0.8), rgba(0, 159, 218, 0.8) 50%, rgba(0, 119, 182, 0.8)), url('{{ asset('images/filesManagement.jpg') }}'); background-size: cover;">
    <div class="logo">
        <i class="bi bi-folder2" style="font-size: 28px"></i> File System
    </div>
    <ul>
        <li class="section-title">Main </li>
        <li>
            <a href="{{route('dashboard')}}"><i class="bi bi-house-fill"></i> Dashboard</a>
        </li>

        <li class="section-title">Groups</li>

                <li><a href="{{route('group.create')}}"><i class="bi bi-person-fill-add"></i> Create Group</a></li>
                <li><a href="{{route('userGroups')}}"><i class="bi bi-people-fill" ></i> My Groups</a></li>

        <li class="section-title">Files</li>
               <li><a href="{{route('user.files')}}"><i class="bi-folder-fill" ></i>Files</a></li>
                <li><a href="{{route('my.reservation.files')}}"><i class="bi-file-text-fill"></i> My Files</a></li>

        <li class="section-title">Reports</li>
        <li><a href="#"><i class="bi-folder-fill" ></i>Tracing</a></li>
    </ul>
</div>
