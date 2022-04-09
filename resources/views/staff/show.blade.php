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
                    <h6 class="m-0 font-weight-bold text-primary">{{ $data->full_name }} Information</h6>
                    <a href="{{ route('staff.index') }}" class="btn btn-primary">View All</a>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <td>{{ $data->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td>{{ $data->department->title }}</td>
                                </tr>
                                <tr>
                                    <th>Photo</th>
                                    <td><img src="{{ asset('storage/imgs/'.$data->photo) }}" style="width:100px; height:100%;" alt="" srcset=""></td>
                                </tr>
                                <tr>
                                    <th>Bio</th>
                                    <td>{{ $data->bio }}</td>
                                </tr>
                                <tr>
                                    <th>Salary Type</th>
                                    <td>{{ $data->salary_type }}</td>
                                </tr>
                                <tr>
                                    <th>Salary Amount</th>
                                    <td>{{ $data->salary_amt }}</td>
                                </tr>

                            </thead>


                        </table>

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
