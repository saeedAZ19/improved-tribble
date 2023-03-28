@extends('admin.layouts')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@endsection
@section('title', 'majors')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mt-2">majors Table</h3>
                <a href="{{ route('majors.create') }}" class="btn btn-success float-right">new major</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Active</th>
                            <th>Image</th>
                            <th>Create Date</th>
                            <th>Update Date</th>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $major)
                            <tr>
                                <td>{{ $major->id }}</td>
                                <td>{{ $major->name }}</td>
                                <td>{{ $major->is_active == 'true' ? 'active' : 'non active' }}</td>
                                <td><img src="{{ Storage::url('majors/' . $major->cover) }}" alt="major image"
                                        width="60" height="60"></td>
                                <td>{{ $major->created_at }}</td>
                                <td>{{ $major->updated_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <div class="btn-group">
                                            <a href="{{ route('majors.edit', $major->id) }}" class="btn btn-info"><i
                                                    class="fas fa-edit"></i></a>
                                            {{-- ---------------------- --}}
                                            {{-- <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="fab fa-elementor"></i></button> --}}
                                            {{-- ------------------------------------ --}}
                                            <button onclick="deleteItem('/admin/majors/' , this , {{ $major->id }})"
                                                class="btn btn-danger"><i class="fas fa-trash"></i></button>

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
    <script>
        function deleteItem(url, ref, id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(url+id)
                    .then(function(response){
                        showMessage(response.data)
                        ref.closest('tr').remove()
                    }).catch(function(error){
                        showMessage(error.response.data)
                    })
                }
            })
        }

        function showMessage(data) {
            Swal.fire({
                    icon: data.icon,
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500
                }
            )
        }
    </script>

@endsection
