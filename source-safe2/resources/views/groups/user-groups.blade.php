@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@section('title','My Groups')

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
                        <li class="breadcrumb-item active" aria-current="page">My Groups</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('group.create') }}" class="btn" style="background-color: #0077B6; color: white">
                <i class="bi bi-plus-circle"></i> Add Group
            </a>
        </div>

        <table class="table table-hover table-custom">
            <thead >
            <tr>
                <th scope="col">
                    <i class="bi bi-image table-icon"></i> Group Image
                </th>
                <th scope="col">
                    <i class="bi bi-card-text table-icon"></i> Group Name
                </th>
                <th scope="col">
                    <i class="bi bi-tools table-icon"></i> Actions
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($groups as $group)
                <tr>
                    <td>
                        <img src="{{ \App\Utils\FileUtility::getFileUrl($group->image) }}" alt="Group Image"
                             class="img-thumbnail" style="width: 75px; height: 75px;">
                    </td>
                    <td class="text-muted">{{ $group->name }}</td>
                    <td>
                        <div>
                            <a href="#" class="btn btn-outline-success btn-md" title="details">
                                <i class="bi bi-eye"></i>
                            </a>
                            <button class="btn btn-outline-info btn-md" title="edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editGroupModal"
                                    onclick="populateModal({{ $group->id }}, '{{ $group->name }}', '{{ \App\Utils\FileUtility::getFileUrl($group->image) }}')">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('group.delete',$group->id) }}" method="POST" class="d-inline-block"
                                  onsubmit="return confirm('Are you sure you want to delete this group?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-md" title="delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No groups found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Edit Group Modal -->
    <div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" id="editGroupForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editGroupModalLabel">Edit Group</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="groupName" class="form-label">Group Name</label>
                            <input type="text" class="form-control" id="groupName" name="name" required>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="image" class="form-label" >Group Image</label>
                            <div class="image-preview-container">
                                <img id="image-preview" src="" alt="Group Image" class="group-image-preview">
                                <label for="image" class="add-image-btn">
                                    <i class="bi bi-plus"></i>
                                    <input type="file" name="image" id="image" class="form-control" style="display: none;" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" style="background-color: #0077B6">Update Group</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Populate the modal with group data
        function populateModal(groupId, groupName, groupImage) {
            document.getElementById('groupName').value = groupName;
            document.getElementById('image-preview').src = groupImage;

            const form = document.getElementById('editGroupForm');
            form.action = `/group/update/${groupId}`; // Update the form action dynamically
        }

        // Image picker script
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
