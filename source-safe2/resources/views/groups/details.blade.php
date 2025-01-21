@extends('layouts.app')
@section('title','group details')
@section('content')
<link  rel="stylesheet" href="{{asset('css/details-group-card.css')}}">
    <div class="container my-5">
            <div class="row g-4">
                <!-- Card 1: Members -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100" style="background-color: #CAF0F8; border-radius: 10px; border: none;">
                        <div class="card-body position-relative">
                            <!-- Card Title and Icon -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title fw-bold text-dark" style="font-size: 1.5rem;">Members</h4>
                                <i class="bi bi-people" style="font-size: 2rem; color: #03045E;"></i>
                            </div>
                            <!-- Card Description -->
                            <p class="card-text text-dark">Manage and view all members in the group.</p>
                            <!-- Line -->
                            <hr style="border: 1px solid #0077B6; margin: 15px 0;">
                            <!-- Read More Link -->
                            <a href="{{route('group.members')}}" class="stretched-link text-decoration-none" style="color: #0077B6;">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Files -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100" style="background-color: #CAF0F8; border-radius: 10px; border: none;">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title fw-bold text-dark" style="font-size: 1.5rem;">Files</h4>
                                <i class="bi bi-folder" style="font-size: 2rem; color: #03045E;"></i>
                            </div>
                            <p class="card-text text-dark">Access and manage group files.</p>
                            <hr style="border: 1px solid #0077B6; margin: 15px 0;">
                            <a href="#" class="stretched-link text-decoration-none" style="color: #0077B6;">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Card 3: File Reports -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100" style="background-color: #CAF0F8; border-radius: 10px; border: none;">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title fw-bold text-dark" style="font-size: 1.5rem;">File Reports</h4>
                                <i class="bi bi-file-earmark-bar-graph" style="font-size: 2rem; color: #03045E;"></i>
                            </div>
                            <p class="card-text text-dark">Generate and view reports about group files.</p>
                            <hr style="border: 1px solid #0077B6; margin: 15px 0;">
                            <a href="#" class="stretched-link text-decoration-none" style="color: #0077B6;">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Member Reports -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100" style="background-color: #CAF0F8; border-radius: 10px; border: none;">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title fw-bold text-dark" style="font-size: 1.5rem;">Member Reports</h4>
                                <i class="bi bi-bar-chart" style="font-size: 2rem; color: #03045E;"></i>
                            </div>
                            <p class="card-text text-dark">Generate detailed reports about group members.</p>
                            <hr style="border: 1px solid #0077B6; margin: 15px 0;">
                            <a href="#" class="stretched-link text-decoration-none" style="color: #0077B6;">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Add File Order -->
                <div class="col-md-6">
                    <div class="card shadow-sm h-100" style="background-color: #CAF0F8; border-radius: 10px; border: none;">
                        <div class="card-body position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title fw-bold text-dark" style="font-size: 1.5rem;">Add File Order</h4>
                                <i class="bi bi-file-earmark-plus" style="font-size: 2rem; color: #03045E;"></i>
                            </div>
                            <p class="card-text text-dark">Add and manage file orders for approval.</p>
                            <hr style="border: 1px solid #0077B6; margin: 15px 0;">
                            <a href="#" class="stretched-link text-decoration-none" style="color: #0077B6;">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>


@endsection

