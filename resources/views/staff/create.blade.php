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
                    <h6 class="m-0 font-weight-bold text-primary">Add New Staff</h6>
                    <a href="{{ route('staff.index') }}" class="btn btn-primary">View All</a>
                </div>
            </div>
            <div class="card-body">

                @if (Session::has('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive">
                    <form action="{{route('staff.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <td><input type="text" name="full_name" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td>
                                        <select name="department_id" id="" class="custom-select">
                                            <option value="0">---Select Department---</option>
                                            @foreach ($departments as $dp)
                                                <option value="{{ $dp->id }}">{{ $dp->title }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Photo</th>
                                    <td><input type="file" class="form-control" name="photo"></td>
                                </tr>
                                <tr>
                                    <th>Bio</th>
                                    <td><textarea name="bio" id="" class="form-control"></textarea></td>
                                </tr>
                                <tr>
                                    <th>Salary Type</th>
                                    <td>
                                        <div class="form-check">
                                            <input name="salary_type" value="Daily" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                              Daily
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <input name="salary_type" value="Monthly" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                            <label class="form-check-label" for="flexRadioDefault2">
                                              Monthly
                                            </label>
                                          </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Salary Amount</th>
                                    <td><input type="number" name="salary_amt" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </td>
                                </tr>
                            </thead>


                        </table>
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
