@extends('admin.layouts')
@section('title', 'edit major')
@section('content')
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit major</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="name"
                            value="{{ $major->name }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Upload image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="cover" class="custom-file-input" id="cover">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="is_active" class="custom-control-input" id="customSwitch1"
                                @if ($major->is_active == 'true') checked @endif>
                            <label class="custom-control-label" for="customSwitch1">Activate</label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" onclick="updateItem({{ $major->id }})" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function updateItem(id) {
            let formData = new FormData();
            formData.append('_method','PUT');
            formData.append('name', document.getElementById('name').value);
            if (document.getElementById('cover').files[0] != undefined) {
                formData.append('cover', document.getElementById('cover').files[0]);
            }
            formData.append('is_active', document.getElementById('customSwitch1').checked);
            axios.post('/admin/majors/'+id, formData)
                .then(function(response) {
                    toastr.success(response.data.message)
                     console.log(response.data)
                    window.location.href = '/admin/majors'

                }).catch(function(error) {
                    console.log(error.response.data.message)
                    toastr.error(error.response.data.message)
                })
        }
    </script>
@endsection
