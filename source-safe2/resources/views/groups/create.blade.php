@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

@section('title','Create Group')

<style>
    /* Breadcrumb styles */
    .breadcrumb {
        background: none;
        padding: 0;
        margin: 0;
        font-size: 14px;
    }

    /* Form styling */
    .form-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: bold;
        color: #0077B6;
    }

    .form-select, .form-control {
        box-shadow: none;
    }


    /* User Selector */
    .user-select {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .user-item {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f8f9fa;
        padding: 5px 10px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .user-item:hover {
        background: #90E0EF;
    }

    .user-photo {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-item input[type="checkbox"] {
        accent-color: #00B4D8;
        width: 20px;
        height: 20px;
    }


    /* image */
    .image-preview-container {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        margin-top: 10px;
    }

    .group-image-preview {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #0077B6;
        margin-bottom: 10px; /* Space between image and the button */
    }

    .add-image-btn {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #0077B6;
        color: white;
        border-radius: 50%;
        cursor: pointer;
        transition: background-color 0.3s;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .add-image-btn:hover {
        background-color: #005f86;
    }

    .add-image-btn i {
        font-size: 16px;
    }


</style>

@section('content')
    @include('components.alert.AlertMessages')
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="content-header d-flex justify-content-between align-items-center mb-4">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="color: #0077B6">
                            <i class="bi bi-house"></i>
                            <a href="{{ route('dashboard') }}" style="color: #0077B6; text-decoration: none;">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Group</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Body Section -->
        <div class="content-body">
            <div class="container">
                <div class="form-container">
                    <form method="POST" action="{{route('group.store')}}"  enctype="multipart/form-data">
                        @csrf
                        <div class="row gap-5">
                            <!-- Group Name -->
                            <div class="col-md-5 mb-3">
                                <label for="name" class="form-label">Group Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter group name" required>
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="image" class="form-label" style="position: relative ;bottom: 140px">Group Image</label>
                                <div class="image-preview-container">
                                    <img id="image-preview" src="{{\App\Utils\FileUtility::getFileUrl('group-images/default-group.jpg')}}" alt="Group Image" class="group-image-preview">
                                    <label for="image" class="add-image-btn">
                                        <i class="bi bi-plus"></i>
                                        <input type="file" name="image" id="image" class="form-control" style="display: none;" accept="image/*">
                                    </label>
                                </div>
                            </div>

                        </div>

                        <!-- User List -->
                        <div class="mb-3">
                            <label for="users" class="form-label">Select Users</label>
                            <div class="user-select">
                                @foreach($users as $user)
                                    <label class="user-item">
                                        <input type="checkbox" name="users[]" value="{{ $user->id }}">
                                        <img @if($user->photo)  src="{{asset($user->photo)}}"  @else  src="{{ \App\Utils\FileUtility::getFileUrl('img/undraw_profile.svg')}}" @endif alt="{{ $user->name }}" class="user-photo">
                                        <span>{{ $user->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row d-flex justify-content-end mt-5">
                            <div class="col-2">
                                <button type="submit" class="btn" style="background-color: #0077B6; color: white">Create Group</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            } else {
                // Reset to the default image if no file is chosen
                preview.src = "{{ asset('img/default-group.jpg') }}";
            }
        });
    </script>


@endsection

