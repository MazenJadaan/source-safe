@extends('layouts.app')

@section('title', 'Files Orders')

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
                            <li class="breadcrumb-item active" aria-current="page">Orders</li>
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
                        <i class="bi bi-person table-icon"></i> Uploaded By
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
                @forelse ($fileRequests as $request)
                    <tr >
                        <!-- File Name -->
                        <td class="text-muted">{{ $request->file_name }}</td>

                        <!-- Uploaded By -->
                        <td class="text-muted">
                            {{ $request->uploader->name }}
                        </td>
                        <td >
                            <span class="badge {{ $request->status === 'pending' ? 'bg-warning' : 'bg-danger' }} w-50">
                            {{ ucfirst($request->status) }}
                        </span>
                        </td>

                        <!-- Actions -->
                        <td>
                            <!-- Open File -->
                            <a
                                href="{{route('file.download',$request->id)}}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded me-2 "
                                target="_blank"
                            >
                                Open File
                            </a>

                            <!-- Accept Button -->
                            <form
                                action="{{route('file.accept',$request->id)}}"
                                method="POST"
                                class="inline"
                            >
                                @csrf
                                @method('PATCH')
                                <button
                                    type="submit"
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"
                                >
                                    Accept
                                </button>
                            </form>

                            <!-- Reject Button -->
                            <form
                                action="{{route('file.reject',$request->id)}}"
                                method="POST"
                                class="inline"
                            >
                                @csrf
                                @method('PATCH')
                                <button
                                    type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
                                >
                                    Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center p-4">No file requests available for this group.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

@endsection
