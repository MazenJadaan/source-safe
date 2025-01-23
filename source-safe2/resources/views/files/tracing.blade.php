@extends('layouts.app')

@section('title', 'My Files')
@section('search_action', '#')

@section('content')
    @include('components.alert.AlertMessages')

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="color: #0077B6">
                            <i class="bi bi-house"></i>
                            <a href="#" style="color: #0077B6; text-decoration: none;">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">My Files</li>
                    </ol>
                </nav>
            </div>
        </div>

        <table class="table table-hover table-custom">
            <thead>
            <tr>
                <th scope="col" style="border-left: 3px solid #0077B6;">
                    <i class="bi bi-card-text table-icon"></i> File Name
                </th>
                <th scope="col">
                    <i class="bi bi-folder table-icon"></i> Group
                </th>
                <th scope="col">
                    <i class="bi bi-person table-icon"></i> Created By
                </th>
                <th scope="col">
                    <i class="bi bi-shield-check table-icon"></i> Status
                </th>
                <th scope="col">
                    <i class="bi bi-clock-history table-icon"></i> Versions
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($files as $file)
                <!-- Main File Row -->
                <tr class="main-row">
                    <td class="text-muted" style="border-left: 3px solid #0077B6;">
                        {{ $file->name }}
                    </td>
                    <td class="text-muted">{{ $file->group->name }}</td>
                    <td class="text-muted">{{ $file->creator->name }}</td>
                    <td>
                        <span class="badge {{ $file->status === 'free' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($file->status) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-primary">
                            {{ $file->backupFiles->count() }} versions
                        </span>
                    </td>
                </tr>

                <!-- Version History Row -->
                <tr class="version-row">
                    <td colspan="5" class="p-0">
                        <div class="p-3 bg-light">
                            <table class="table table-sm version-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Version</th>
                                        <th>Updated By</th>
                                        <th>Date</th>
                                        <th>Changes</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($file->backupFiles as $backup)
                                    <tr>
                                        <td>{{ $backup->version_number }}</td>
                                        <td>{{ $backup->updater->name ?? 'System' }}</td>
                                        <td>{{ $backup->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $backup->contentChanges ?? 'No changes recorded' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($backup->id === $file->latestVersion->id)
                                                <span class="badge bg-success">Current</span>
                                            @else
                                                <span class="badge bg-secondary">Archived</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <div class="alert alert-info mb-0">
                                                No version history available
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No files found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $files->links() }}
        </div>
    </div>

@endsection

@push('styles')
<style>
.table-custom {
    border-collapse: separate;
    border-spacing: 0 0.5em;
}

.main-row {
    background-color: #fff;
    box-shadow: 0 2px 8px rgba(0,119,182,0.1);
}

.version-row {
    background-color: #f8f9fa;
}

.version-table {
    background-color: white;
    border: 1px solid #dee2e6;
    margin: -8px 0;
}

.version-table thead th {
    background-color: #0077B6;
    color: white;
    border-bottom: 2px solid #0056b3;
}

.badge {
    font-size: 0.9em;
    padding: 0.5em 0.75em;
}
</style>
@endpush