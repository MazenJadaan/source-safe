<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center text-primary">Bootstrap Test Page</h1>
    <p class="lead">If you see styled text and buttons below, Bootstrap is working!</p>
    <button class="btn btn-success">Success Button</button>
    <button class="btn btn-danger">Danger Button</button>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 bg-light p-3">Column 1</div>
        <div class="col-md-4 bg-secondary text-white p-3">Column 2</div>
        <div class="col-md-4 bg-dark text-white p-3">Column 3</div>
    </div>
</div>
<div class="alert alert-warning mt-3" role="alert">
    This is a Bootstrap alert—check it out!
</div>
<div class="card mt-3">
    <div class="card-body">
        This is a simple card example.
    </div>
</div>
<!-- Trigger -->
<button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Open Modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                This is a Bootstrap modal.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<h3>Bootstrap Icons</h3>
<i class="bi bi-alarm"></i>
<i class="bi bi-heart-fill text-danger"></i>
<i class="bi bi-chat-dots text-primary"></i>
<div class="dropdown mt-3">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Dropdown button
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
    </ul>
</div>

</body>
</html>
