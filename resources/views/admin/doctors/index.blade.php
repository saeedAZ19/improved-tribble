@extends('admin.layouts')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@endsection
@section('title', 'doctors')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mt-2">doctors Table</h3>
                <a href="{{ route('doctors.create') }}" class="btn btn-success float-right">new doctor</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Success</h5>
                        <h2>{{ session()->get('message') }}</h2>
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>email</th>
                            <th>phone</th>

                            <th>Image</th>
                            <th>Create Date</th>
                            <th>Update Date</th>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $doctor)
                            <tr>
                                <td>{{ $doctor->id }}</td>
                                <td>{{ $doctor->name }}</td>
                                <td>{{ $doctor->email }}</td>
                                 <td>{{ $doctor->phone }}</td>
                                {{-- <td><span class="brdge {{ $doctor->is_active ? 'bg-success' : 'bg-danger' }}">{{ $doctor->active_status }}</span></td> --}}
                                <td><img src="{{ Storage::url('doctors/' . $doctor->cover) }}" alt="doctor image"
                                        width="60" height="60"></td>
                                <td>{{ $doctor->created_at }}</td>
                                <td>{{ $doctor->updated_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <div class="btn-group">
                                            <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-info"><i
                                                    class="fas fa-edit"></i></a>
                                            {{-- ---------------------- --}}
                                            {{-- <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="fab fa-elementor"></i></button> --}}
                                            {{-- ------------------------------------ --}}
                                            <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>

                </ul>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
@endsection
