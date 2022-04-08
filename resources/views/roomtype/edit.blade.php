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
                    <h6 class="m-0 font-weight-bold text-primary">Edit {{ $data->title }}</h6>
                    <a href="{{ route('roomtype.index') }}" class="btn btn-primary">View All</a>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                <div class="table-responsive">
                    <form action="{{route('roomtype.update',$data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <td><input type="text" value="{{ $data->title }}" name="title" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td><input type="text" value="{{ $data->price }}" name="price" class="form-control"></td>
                                </tr>
                                <tr>
                                    <th>Detail</th>
                                    <td><textarea  name="detail" class="form-control" id="" >{{ $data->detail }}</textarea></td>
                                </tr>
                                <tr>
                                    <th>Gallery</th>
                                    <td><input type="file" name="imgs[]" class="form-control" multiple></td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        @foreach ($data->roomtypeImages as $img)
                                        <div class="position-relative d-inline-block p-2 mr-2 mb-2 mt-3 image-box-{{ $img->id }}">
                                            <img src="{{ asset('storage/imgs/'.$img->img_src) }}" class="rounded" style="width: 100px; height: 130px" alt="" srcset="">

                                            {{--add button type="button" to change button default type="submit" --}}
                                            <button type="button" onclick="return confirm('Are you sure you want to delete this image?')" class="btn btn-danger btn-sm position-absolute shadow delete-image-btn" image-id="{{ $img->id }}" style="top: 5px; right: 5px;"><i class="fas fa-trash"></i></button>
                                        </div>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button class="btn btn-primary" type="submit">Update</button>
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

<script>
    $(document).ready(function(){
        $('.delete-image-btn').on('click',function(){
            var img_id = $(this).attr('image-id');
            var current = $(this);
            $.ajax({
                url: "{{ url('admin/roomtypeimage/delete') }}/"+img_id,
                dataType: 'json',
                beforeSend:function(){
                    current.addClass('disabled');
                },
                success:function(res){
                    if(res.bool==true){
                        $('.image-box-'+img_id).remove();
                    }
                    current.removeClass('disabled');
                }
            })
        })
    })

</script>
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

@endsection
