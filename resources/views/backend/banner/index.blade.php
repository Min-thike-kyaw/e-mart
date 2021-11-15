@extends('backend.layouts.master')

@section('links')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

@endsection



@section('content')
<div class="container">
    <h4>Banner list</h4>
    <span >Total: {{\App\Models\Banner::count()}}</span>
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Status</th>
                <th>Condition</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{!!$item->description!!}</td>
                    <td><img src="{{$item->photo}}" class="img-thumbnail " alt=""></td>
                    <td><input type="checkbox" name="toggle" value="{{$item->id}}" {{$item->status == "active" ? "checked" : ""}} data-toggle="toggle" data-on="active" data-off="inactive" data-onstyle="success" data-offstyle="danger"></td>

                    <td>{{$item->condition}}</td>
                    <td>

                            <a href="{{route('banner.edit',$item->id)}}" class="btn float-left btn-warning"><i class="fa fa-edit"></i></a>
                            <form class="float-left" action="{{route('banner.delete', $item->id)}}" method="POST" >
                                @csrf
                                @method("DELETE")
                                <a  class="del-btn btn btn-danger"><i class="fa fa-trash"></i></a>

                            </form>

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready( function () {
    $('#table_id').DataTable();
} );

$('input[name=toggle]').change(function(){
    var mode = $(this).prop('checked');
    var id = $(this).val()
    // alert(mode);
    $.ajax({
        url : "{{route('banner.status')}}",
        method : "POST",
        data : {
            id : id,
            mode : mode,
            _token : '{{csrf_token()}}'
        },
        success : function (res) {
            swal(res.data, {
                icon: "success"
            })
        }
    })
})

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(".del-btn").click(function(e){
    var form = $(this).closest("form")
    var dataId = $(this).data('id')
    e.preventDefault()
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            form.submit()
            swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
            });
        } else {
            swal("Your imaginary file is safe!");
        }
        });

})

</script>
@endsection
