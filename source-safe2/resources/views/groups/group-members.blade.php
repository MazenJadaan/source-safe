@extends('layouts.app')
@section('title','group members')
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
                        <li class="breadcrumb-item active" aria-current="page">Members</li>
                    </ol>
                </nav>
            </div>

        </div>

        <table class="table table-hover table-custom">
            <thead>
            <tr>
                <th scope="col">
                    <i class="bi bi-image table-icon"></i> Photo
                </th>
                <th scope="col">
                    <i class="bi bi-card-text table-icon"></i> Name
                </th>
                <th scope="col">
                    <i class="bi bi-mailbox table-icon"></i> Email
                </th>
                <th scope="col">
                    <i class="bi bi-tools table-icon"></i>Action
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($members as $member)
                <tr>
                    <td>
                        <img src="{{ isset($member->photo) && $member->photo
                        ? \App\Utils\FileUtility::getFileUrl($member->photo)
                        : \App\Utils\FileUtility::getFileUrl('/default-images/undraw_profile.svg') }}"
                             alt="{{ $member->name }}"
                             class="img-thumbnail"
                             style="width: 50px; height: 50px; object-fit: cover;">
                    </td>
                    <td class="text-muted">{{ $member->name }}</td>
                    <td class="text-muted">{{ $member->email }}</td>
                    <td>
                        <a href="{{ route('member.reports', $member->id) }}" class="btn btn-sm" style="background-color: #0077B6; color: white">Reports</a>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No user found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
@endsection
