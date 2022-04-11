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
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">Staff Department</h5>
                <a href="{{ route('department.create') }}" class="btn btn-primary">Add New</a>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Detail</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($data)
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->title }}</td>
                                        <td>{{ $d->detail }}</td>

                                        <td>
                                            <a href="{{ route('department.show',$d->id) }}" class="btn  btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('department.edit',$d->id)  }}" class="btn  btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('department.delete',$d->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn  btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif


                        </tbody>
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
