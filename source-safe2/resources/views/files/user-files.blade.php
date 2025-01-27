@extends('layouts.app')

@section('title', 'All Files')
@section('search_action', route('user.files'))

@section('content')
    @include('components.alert.AlertMessages')

   <!-- files of user -->
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="color: #0077B6">
                            <i class="bi bi-house"></i>
                            <a href="{{ route('dashboard') }}" style="color: #0077B6; text-decoration: none;">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Files</li>
                    </ol>
                </nav>
            </div>

            <!-- Multi-Check-In Button -->
            <form action="#" method="POST" id="multiCheckInForm">
                @csrf
                <button type="submit" class="btn" style="background-color: #0077B6; color: white">
                    <i class="bi bi-box-arrow-in-down"></i> Check In Selected
                </button>
            </form>
        </div>
        <table class="table table-hover table-custom">
            <thead>
            <tr>
                <th scope="col">
                    <input type="checkbox" id="selectAll" title="Select/Deselect All">
                </th>
                <th scope="col">
                    <i class="bi bi-card-text table-icon"></i> File Name
                </th>
                <th scope="col">
                    <i class="bi bi-folder table-icon"></i> Group Name
                </th>
                <th scope="col">
                    <i class="bi bi-person table-icon"></i> Created By
                </th>
                <th scope="col">
                    <i class="bi bi-shield-check table-icon"></i> Status
                </th>
                <th scope="col">
                    <i class="bi bi-tools table-icon"></i> Actions
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($files as $file)
                <tr>
                    <td>
                        @if($file->status === 'free')
                            <input type="checkbox" name="files[]" value="{{ $file->id }}" class="fileCheckbox">
                        @endif
                    </td>
                    <td class="text-muted">{{ $file->name }}</td>
                    <td class="text-muted">{{ $file->group->name }}</td>
                    <td class="text-muted">{{ $file->creator->name }}</td>
                    <td>
                        <span class="badge {{ $file->status === 'free' ? 'bg-success' : 'bg-warning' }} w-50">
                            {{ ucfirst($file->status) }}
                        </span>
                    </td>
                    <td>
                        <div>
                            <a href="{{ route('file.reports', $file->id) }}" class="btn btn-sm" style="background-color: #0077B6; color: white">Report</a>
                        @if($file->status === 'free')
                                    <form action="{{ route('files.check-in', $file->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                        <input type="hidden" name="version" value="{{ $file->version }}">
                                    <button type="submit" class="btn btn-outline-primary btn-sm" title="Reserve and Download File">
                                        <i class="bi bi-box-arrow-in-down"></i> Check In
                                    </button>
                                </form>
                            @endif
                            <a href="#" class="btn btn-outline-secondary btn-sm" title="View the file backups">
                                <i class="bi bi-archive"></i> Backup
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No files found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $files->links() }}
        </div>
    </div>
    <!-- files of user -->



<!-- upload file -->
    <div class="p-3 bg-sky-500 w-16 h-16 rounded-full mb-5 ms-5
            shadow-lg flex items-center justify-center
            cursor-pointer hover:bg-sky-700 active:bg-sky-700
            transition duration-200 ms-1
            fixed bottom-2 "
         onclick="openForm()">
        <p class="text-center text-3xl font-bold text-slate-50">
            <i class="fa-solid fa-arrow-up-from-bracket"></i>
        </p>
    </div>

    <div id="backdrop" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-md z-5"></div>

    <div id="fileModal"
         class="p-8 bg-sky-700 rounded-md mt-36 mx-auto
    md:w-1/2 md:h-1/2 lg:w-96 lg:h-96 xl:w-2/4 xl:h-4/6
    fixed inset-0 flex items-center justify-between shadow-lg
    transform scale-0 opacity-0 transition-all duration-300 z-10"
    >
        <div class="p-3 bg-sky-500 w-16 h-16 rounded-full
        shadow-lg flex items-center justify-center
        cursor-pointer hover:bg-red-700 active:bg-sky-700
        transition duration-200 ms-1
        fixed top-2 right-2"
             onclick="openForm()">
            <p class="text-center text-3xl font-bold text-slate-50">
                <i class="fa-solid fa-xmark"></i>
            </p>
        </div>
        <div class="flex flex-col items-center">
            <i class="fa-solid fa-upload text-white text-9xl p-5"></i>
            <p class="font-mono font-semibold text-xl" style="color: white">Upload File</p>
        </div>

        <form action="{{ route('file.request.upload') }}" method="POST" enctype="multipart/form-data" class="w-2/3 flex flex-col space-y-4" id="fileForm">
            @csrf

            <!-- File Upload -->
            <label class="text-white font-bold" for="file">Upload Your File Here:</label>
            <input
                type="file"
                id="file"
                name="file"
                class="p-2 rounded bg-white text-gray-700"
                required
            >
            @error('file')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- File Name -->
            <label class="text-white font-bold" for="file_name">File Name:</label>
            <input
                type="text"
                id="file_name"
                name="file_name"
                placeholder="Enter file name"
                class="p-2 rounded bg-white text-gray-700"
                required
            >
            @error('file_name')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <!-- Group Selection -->
            <label class="text-white font-bold" for="group">Choose The Group:</label>
            <select
                id="group"
                name="group_id"
                class="p-2 rounded bg-white text-gray-700"
                required
            >
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
            @error('group_id')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror


            <!-- Submit Button -->
            <div class="d-flex justify-content-center mt-5">
                <button
                    type="submit"
                    class="w-20 bg-green-500 hover:bg-green-600 text-white p-2 rounded"
                >
                    Upload
                </button>
            </div>
        </form>
    </div>

    <script>
        function openForm() {
            const modal = document.getElementById('fileModal');
            const backdrop = document.getElementById('backdrop');

            // Check if the modal is hidden or visible
            if (modal.classList.contains('scale-0')) {
                modal.classList.remove('scale-0', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
                backdrop.classList.remove('hidden');
            } else {
                modal.classList.remove('scale-100', 'opacity-100');
                modal.classList.add('scale-0', 'opacity-0');
                backdrop.classList.add('hidden');
            }
        }

        // Check if there are validation errors after form submission
        window.onload = function() {
            if ({{ $errors->any() ? 'true' : 'false' }}) {
                openForm(); // Open modal if there are validation errors
            }
        };
    </script>
    <!-- upload file -->
    <!-- select multi file -->
            <script>
        document.getElementById('selectAll').addEventListener('click', function () {
            const checkboxes = document.querySelectorAll('.fileCheckbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
    <!-- select multi file -->
@endsection
