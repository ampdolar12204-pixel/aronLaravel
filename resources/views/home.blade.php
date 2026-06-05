@extends('layouts.main')

@section('content')

    @include('toastdisplay')

    <h1 class="h1 mb-4">Welcome, {{session('user')->name}}</h1>
    <div class="container">
        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-12 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="card-text text-muted mb-1">Your Total Projects</p>
                                <h3 class="card-title mb-0 text-success">{{ $totalProjects }}</h3>
                            </div>
                            <div class="text-success" style="font-size: 2.5rem;">
                                📊
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <p class="card-text text-muted mb-1">Pending</p>
                        <h2 class="card-title mb-0" style="color: #dc3545;">{{ $pendingProjects }}</h2>
                        <small class="text-muted">projects</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <p class="card-text text-muted mb-1">Ongoing</p>
                        <h2 class="card-title mb-0" style="color: #ffc107;">{{ $ongoingProjects }}</h2>
                        <small class="text-muted">projects</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <p class="card-text text-muted mb-1">Completed</p>
                        <h2 class="card-title mb-0" style="color: #28a745;">{{ $completedProjects }}</h2>
                        <small class="text-muted">projects</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    View Other Analytics
                </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-white border-bottom">
                                        <h5 class="card-title mb-0">Project Status Distribution</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="projectStatusChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-white border-bottom">
                                        <h5 class="card-title mb-0">Project Count Breakdown</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="projectCountChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            
        </div>

        
        <!-- Projects Table Section -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0">Your Projects</h5>
            </div>
            <div class="card-body">
        <button class="btn btn-primary mb-3" 
        data-bs-toggle="modal" 
        data-bs-target="#staticBackdrop"
        >Add new project <b class="fs-5">+</b></button>
       
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form action="/addproj" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">New Project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Project Name</label>
                            <input required name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Finals Project">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Project Description</label>
                            <textarea required name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</a>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </div>
            </div>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Project Name</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Updated At</th>
                <th scope="col">Created at</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$project->name}}</td>
                <td>{{$project->desc}}</td>
                <td>@if($project->status === 'Pending')
                        <span class="badge text-bg-danger">Pending</span>
                    @elseif($project->status === 'Ongoing')
                        <span class="badge text-bg-warning">Ongoing</span>
                    @else
                        <span class="badge text-bg-success">Completed</span>
                    @endif
                </td>
                <td>{{$project->updated_at}}</td>
                <td>{{$project->created_at}}</td>
                <td><button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{$project->id}}">View</button></td>
                </tr>

                <div class="modal fade" id="viewModal{{$project->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <form action="/editproj/{{ $project->id }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$project->name}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Project Name</label>
                                <input required value="{{$project->name}}" name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Finals Project">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Project Description</label>
                                <textarea required name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$project->desc}}</textarea>
                            </div>
                            
                            <p>Project Status</p>
                            <div class="mb-3 d-flex flex-row container-fluid justify-content-evenly" >
                                
                                <div class="form-check rounded-pill bg-danger text-light py-2 px-3 d-flex justify-content-center">
                                    <input class="form-check-input ms-1 me-1" value="Pending" type="radio" name="status" id="radioDefault1" @checked($project->status === 'Pending')>
                                    <label class="form-check-label" for="radioDefault1">
                                        Pending
                                    </label>
                                </div>
                                <div class="form-check rounded-pill bg-warning text-light py-2 px-3 d-flex justify-content-center">
                                    <input class="form-check-input ms-1 me-1" value="Ongoing" type="radio" name="status" id="radioDefault2" @checked($project->status === 'Ongoing')>
                                    <label class="form-check-label" for="radioDefault2">
                                        Ongoing
                                    </label>
                                </div>
                                <div class="form-check rounded-pill bg-success text-light py-2 px-3 d-flex justify-content-center">
                                    <input class="form-check-input ms-1 me-1" value="Completed" type="radio" name="status" id="radioDefault23" @checked($project->status === 'Completed')>
                                    <label class="form-check-label" for="radioDefault3">
                                        Completed
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#delete{{$project->id}}" class="btn btn-danger">Delete Project</a>
                         
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="delete{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete: {{$project->name}} </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Delete this project?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="/deleteproj/{{$project->id}}" type="button" class="btn btn-danger">Delete</a>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Project Status Pie Chart
        const statusCtx = document.getElementById('projectStatusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Ongoing', 'Completed'],
                datasets: [{
                    label: 'Project Status',
                    data: [{{ $pendingProjects }}, {{ $ongoingProjects }}, {{ $completedProjects }}],
                    backgroundColor: [
                        '#dc3545',
                        '#ffc107',
                        '#28a745'
                    ],
                    borderColor: [
                        '#c82333',
                        '#e0a800',
                        '#218838'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 12
                            },
                            padding: 15
                        }
                    }
                }
            }
        });

        // Project Count Bar Chart
        const countCtx = document.getElementById('projectCountChart').getContext('2d');
        new Chart(countCtx, {
            type: 'bar',
            data: {
                labels: ['Pending', 'Ongoing', 'Completed'],
                datasets: [{
                    label: 'Number of Projects',
                    data: [{{ $pendingProjects }}, {{ $ongoingProjects }}, {{ $completedProjects }}],
                    backgroundColor: [
                        '#dc3545',
                        '#ffc107',
                        '#28a745'
                    ],
                    borderColor: [
                        '#c82333',
                        '#e0a800',
                        '#218838'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        max: Math.max({{ $pendingProjects }}, {{ $ongoingProjects }}, {{ $completedProjects }}) + 1
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endsection