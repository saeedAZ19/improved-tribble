@extends('admin.layouts')
@section('title', 'new major')
@section('content')
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Major</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" id="form-rest">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="name" value="{{ old('name') }}">
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
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked name="is_active">
                            <label class="custom-control-label" for="customSwitch1">Activate</label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a  onclick="storeItem('/admin/majors')" class="btn btn-primary">Submit</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
 function storeItem(url){
    let formData = new FormData();
    formData.append('name' ,document.getElementById('name').value);
    if(document.getElementById('cover').files[0] != undefined){
        formData.append('cover' ,document.getElementById('cover').files[0]);
    }
        formData.append('is_active' ,document.getElementById('customSwitch1').checked);

    axios.post(url ,formData)
    .then(function(response){
        toastr.success(response.data.message)
         console.log(response.data)
        document.getElementById('form-rest').reset()
        // window.location.href = '/majors'
    }).catch(function(error){
        console.log(error.response.data.message)
        toastr.error(error.response.data.message)
    })

 }
</script>
@endsection
