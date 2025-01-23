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
                        <li class="breadcrumb-item active" aria-current="page"> My Files</li>
                    </ol>
                </nav>
            </div>
        </div>

        <table class="table table-hover table-custom">
            <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">
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
            </tr>
            </thead>
            <tbody>
            @for($i = 1; $i <= 3; $i++)
                <!-- Main File Row -->
                <tr class="main-row">
                    <td>
                        <label for="toggle-{{ $i }}" style="cursor: pointer;">
                            <i class="bi bi-chevron-down"></i>
                        </label>
                        <input type="checkbox" id="toggle-{{ $i }}" class="d-none">
                    </td>
                    <td class="text-muted">
                        File {{ $i }}
                    </td>
                    <td class="text-muted">Group {{ $i }}</td>
                    <td class="text-muted">User {{ $i }}</td>
                    <td>
                        <span class="badge {{ $i % 2 === 0 ? 'bg-success' : 'bg-warning' }}">
                            {{ $i % 2 === 0 ? 'Free' : 'Reserved' }}
                        </span>
                    </td>
                </tr>

                <!-- Version History Row -->
                <tr class="version-row">
                    <td colspan="5" class="p-0">
                        <div class="version-content" id="version-content-{{ $i }}">
                            <div class="p-3 bg-light">
                                <h6 class="mb-3" style="color: #0077B6;">
                                    <i class="bi bi-clock-history me-2"></i>
                                    Version History for File {{ $i }}
                                </h6>
                                
                                <table class="table table-sm version-table">
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
                                        @for($j = 1; $j <= 2; $j++)
                                        <tr>
                                            <td>v{{ $j }}</td>
                                            <td>User {{ $j }}</td>
                                            <td>{{ now()->subDays($j)->format('M d, Y H:i') }}</td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ rand(1, 5) }} modifications
                                                </span>
                                            </td>
                                            <td>
                                                @if($j === 1)
                                                    <span class="badge bg-success">Current</span>
                                                @else
                                                    <span class="badge bg-secondary">Archived</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>

@endsection

@push('styles')
<style>
    /* إخفاء المحتوى الافتراضي */
    .version-content {
        display: none;
    }

    /* عرض المحتوى عند تحديد checkbox */
    input[type="checkbox"]:checked + .version-content {
        display: block;
    }

    /* تنسيق الجدول */
    .table-custom {
        border-collapse: collapse;
        width: 100%;
    }
</style>
@endpush
