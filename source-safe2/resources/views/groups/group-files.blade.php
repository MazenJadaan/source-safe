@extends('layouts.app')

@section('title', 'Group Files')

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
                        <li class="breadcrumb-item" style="color: #0077B6">
                            <i class="fa fa-people-group"></i>
                            <a href="{{ route('userGroups') }}" style="color: #0077B6; text-decoration: none;">Group</a>
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
                                <form action="#" method="POST" class="d-inline-block">
                                    @csrf
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
    </div>
    <!-- files of user -->

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
