@extends('layout')

@section('head')
 <!-- Custom styles for this page -->
 <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }} " rel="stylesheet">
@endsection

@section('content')
  <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Customer</h6>
                    <a href="{{ route('customer.index') }}" class="btn btn-primary">View All</a>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive">
                    <form action="{{route('customer.update',$data->id)}}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="">Full Name</label>
                            <input type="text" name="full_name" value="{{ $data->full_name }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email Address</label>
                            <input type="email" name="email" value="{{ $data->email }}"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Mobile Number</label>
                            <input type="number" name="mobile" value="{{ $data->mobile }}"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea name="address" class="form-control" id=""  required>{{ $data->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Select Photo</label>
                            <img src="{{asset('storage/imgs/'.$data->photo)}}" class="ml-3 mb-2" style="width: 80px; height: 100%;"  alt="" srcset="">
                            <input type="file" name="photo" value="{{ $data->photo }}" class="form-control" id="">
                            <input type="hidden" name="prev_photo" value="{{ $data->photo }}" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
<!-- /.container-fluid -->
@endsection

@section('foot')

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

@endsection
