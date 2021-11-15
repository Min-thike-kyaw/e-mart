@extends('backend.layouts.master')

@section('links')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

@endsection



@section('content')
<div class="container">
    <h4>Banner list</h4>
    <span >Total: {{\App\Models\Product::count()}}</span>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$item->id}}">
                            <i class="fa fa-eye"></i>
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <strong>Name:</strong>
                                    <p>{{$item->title}}</p>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-6">


                                        <strong>Price:</strong>
                                        <p>{{$item->price}}</p>

                                        <strong>Offer Price:</strong>
                                        <p>{{$item->offer_price}}</p>

                                        <strong>Discount:</strong>
                                        <p>{{$item->discount}}%</p>

                                        <strong>Condition:</strong>
                                        <p>{{$item->condition}}</p>

                                        <strong>Brand:</strong>
                                        <p>{{$item->brand->title}}</p>
                                  </div>
                                  <div class="col-md-6">


                                    <strong>Category:</strong>
                                    <p>{{$item->category->title}}</p>

                                    <strong>Child Category:</strong>
                                    <p>{{$item->childCategory->title}}</p>

                                    <strong>Size:</strong>
                                    <p><button class="badge badge-info">{{$item->size}}</button></p>

                                    <strong>Status:</strong>
                                    <p><button class="badge {{$item->status == "active" ? "badge-success": "badge-danger"}} ">{{$item->status}}</button></p>
                                  </div>
                                  </div>
                                    <strong>Description:</strong>
                                    <p>{!!$item->description!!}</p>

                                    <strong>Size:</strong>
                                    <p>{!!$item->summary!!}</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>

                            <a href="{{route('product.edit',$item->id)}}" class="btn float-left btn-warning"><i class="fa fa-edit"></i></a>
                            <form class="float-left" action="{{route('product.delete', $item->id)}}" method="POST" >
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
        url : "{{route('product.status')}}",
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
