@extends('layouts.app')

@section('title', 'My Files')
@section('search_action', route('my.reservation.files'))

@section('content')
    @include('components.alert.AlertMessages')

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="color: #0077B6">
                            <i class="bi bi-house"></i>
                            <a href="{{ route('dashboard') }}" style="color: #0077B6; text-decoration: none;">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"> My Files</li>
                    </ol>
                </nav>
            </div>

        </div>

        <table class="table table-hover table-custom">
            <thead>
            <tr>
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
                            @if($file->status === 'reserved')
                                <form action="{{ route('files.checkOut', $file->id) }}" method="POST" class="d-inline-block" enctype="multipart/form-data">
                                    @csrf
                                    <label for="file-upload-{{ $file->id }}" class="btn btn-outline-danger btn-sm" title="Check Out File">
                                        <i class="bi bi-box-arrow-right"></i> Check Out
                                    </label>
                                    <input type="file" name="file" id="file-upload-{{ $file->id }}" class="d-none" onchange="this.form.submit()">
                                </form>
                            @endif
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

@endsection
