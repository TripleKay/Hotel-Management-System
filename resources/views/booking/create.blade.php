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
                    <h6 class="m-0 font-weight-bold text-primary">Add New Booking</h6>
                    <a href="{{ route('booking.index') }}" class="btn btn-primary">View All</a>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive">
                    <form action="{{route('booking.store')}}" method="post" >
                        @csrf

                        <div class="form-group">
                            <label for="">Customer Name</label>
                            <select name="customer_id" id="" class="custom-select">
                                <option value="0">---Select Customer---</option>
                                @foreach ($customers as $c)
                                    <option value="{{ $c->id }}">{{ $c->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">CheckIn Date</label>
                            <input type="date" name="checkin_date" class="form-control checkinDate" required>
                        </div>
                        <div class="form-group">
                            <label for="">CheckOut Date</label>
                            <input type="date" name="checkout_date" class="form-control checkoutDate" required>
                        </div>
                        <div class="form-group">
                            <label for="">Total Adults</label>
                            <input type="number" name="totol_adults" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Total Children</label>
                            <input type="number" name="total_children" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Available Rooms</label>
                            <select name="room_id" id="" class="roomLists custom-select">
                                <option value="0">Selelect Rooms</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
<!-- /.container-fluid -->
@endsection

@section('foot')

<script>
    $(document).ready(function(){
        $('.checkinDate').on('blur',function(){
            var checkinDate = $(this).val();
            $.ajax({
                url: "{{ url('admin/booking/avaiable-rooms') }}/"+checkinDate,
                dataType: 'json',
                beforeSend:function(){
                    $('.roomLists').html('<option>---Loading---</option>');
                },
                success:function(res){
                    var roomListsHtml='';
                    $.each(res.data,function(index,row){
                        roomListsHtml += '<option value="'+row.id+'">'+row.title+'</option>';
                    });
                    $('.roomLists').html(roomListsHtml);
                }
            })
        })
    })
</script>


@endsection
