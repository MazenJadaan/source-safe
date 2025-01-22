@extends('layouts.app')
@section('title', 'Member Reports')
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
                            <li class="breadcrumb-item" style="color: #0077B6">
                                <i class="fa fa-people-group"></i>
                                <a href="{{ route('userGroups') }}" style="color: #0077B6; text-decoration: none;">Group</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Member Reports</li>
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
                        <i class="bi bi-tools table-icon"></i> Operation
                    </th>
                    <th scope="col">
                        <i class="bi bi-calendar-date table-icon"></i>Date
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($operations as $operation)
                    <tr>
                        <td class="text-muted">{{ $operation->file->name }}</td>
                        <td>
                            @if ($operation->type === 'check_in')
                                <span class="badge bg-success">Check In</span>
                            @elseif ($operation->type === 'check_out')
                                <span class="badge bg-danger">Check Out</span>
                            @endif
                        </td>
                        <td class="text-muted">{{ $operation->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No operations found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
@endsection
