@extends('admin.layouts')
@section('title', 'new hospital')
@section('content')
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Hospital</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('hospitals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Errors!</h5>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    <div class="form-group" data-select2-id="28">
                        <label>Enter hospitals majors</label>
                        <select class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State"
                            style="width: 100%;" data-select2-id="6" tabindex="-1" aria-hidden="true" name="majors[]">
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}">{{ $major->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="name"
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Enter location</label>
                        <input type="text" name="location" class="form-control" id="exampleInputPassword1"
                            placeholder="location" value="{{ old('location') }}">
                    </div>
                    <div class="form-group">
                        <label>Descrption</label>
                        <textarea class="form-control" name="info" rows="3" placeholder="Enter your descrption"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Upload image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="cover" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="is_active" class="custom-control-input" id="customSwitch1" checked>
                            <label class="custom-control-label" for="customSwitch1">Activate</label>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            // $('.select2').select2()
            $('.select2').select2({
                majors: true,
                theme: 'bootstrap4'
            })
        })
    </script>
@endsection
{{--     tokenSeparators: [',', '  '], --}}
