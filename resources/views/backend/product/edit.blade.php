@extends('backend.layouts.master')
@section('links')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endsection
@section('content')
    <div class="container">
        <h3> <b>Create Banner</b></h3>

    <form  method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        @endif

            <div class="col-lg-12 mb-4">
                <div class="form-goup">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="{{$product->title}}" required>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="form-goup">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" name="price" value="{{$product->price}}" required>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="form-goup">
                    <label for="discount">Discount</label>
                    <input type="number" class="form-control" max="100" name="discount" value="{{$product->discount}}" required>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="form-goup">
                    <label for="discount">Stock</label>
                    <input type="number" class="form-control" name="stock" value="{{$product->discount}}" required>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="form-group">

                        <label for="">Description</label>
                        <textarea class="summernote"  name="description" value="{{$product->description}}">{{$product->description}}</textarea>

                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="form-group">
                        <label for="">Summary</label>
                        <textarea class="summernote"  name="summary" value="{{$product->summary}}" required>{{$product->summary}}</textarea>

                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="input-group">
                    <label for="">Photo</label>

                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose photo
                      </a>
                    </span>
                    <input id="thumbnail" class="form-control" type="text" name="photo">
                  </div>
                  <div id="holder" style="margin-top:15px;max-height:100px;"></div>
            </div>

            <div class="col-md-12 mb-4" id="parent_select">
                <label for="">Parent Category</label>
                <select name="cat_id" id="cat_id"  class="form-control">
                    <option value="">--Parent Category--</option>
                    @foreach (\App\Models\Category::where('is_parent',true)->get() as $p_cat)

                        <option value="{{$p_cat->id}}" {{$product->cat_id == $p_cat->id? "selected": ""}}>{{$p_cat->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12  mb-4 d-none" id="child_cat_div">
                <label for="child_cat_id">Child Category</label>
                <select name="child_cat_id" id="child_cat_id"  class="form-control">

                </select>
            </div>

            <div class="col-md-12 mb-4" id="parent_select">
                <label for="brand_id">--Brand--</label>
                <select name="brand_id" id="brand_id"  class="form-control">
                    @foreach (\App\Models\Brand::all() as $brand)
                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12 mb-4" id="parent_select">
                <label for="size">Size</label>
                <select name="size"  class="form-control">
                        <option  value="">--Choose Size--</option>
                        <option {{$product->size == "XS"? "selected": ""}} value="XS">Extra Small</option>
                        <option {{$product->size == "S"? "selected": ""}} value="S">Small</option>
                        <option {{$product->size == "M"? "selected": ""}} value="M">Medium</option>
                        <option {{$product->size == "L"? "selected": ""}} value="L">Large</option>
                        <option {{$product->size == "XL"? "selected": ""}} value="XL">Extra Large</option>
                </select>
            </div>

            <div class="col-md-12 mb-4" id="parent_select">
                <label for="condition">Condition</label>
                <select name="condition"  class="form-control">
                        <option  value="">--Choose Condition--</option>
                        <option {{$product->condition == "winter"? "selected": ""}} value="winter">Winter</option>
                        <option {{$product->condition == "new"? "selected": ""}} value="new">New</option>
                        <option {{$product->condition == "popular"? "selected": ""}} value="popular">Popular</option>
                </select>
            </div>

            <div class="col-md-12 mb-4">
                <label for="status">--Status--</label>
                <select name="status" id="status" class="form-control">
                    <option value="active" {{$product->status == 'active' ? 'selected' : ''}}>active</option>
                    <option value="inactive" {{$product->status == 'inactive' ? 'selected' : ''}}>inactive</option>
                </select>
            </div>



        <div class="d-flex">

            <button class="btn btn-success ml-auto" id="submit" type="submit">Submit</button>
        </div>
    </form>
    </div>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


  <script>

$(document).ready(function() {
    $('.summernote').summernote();
  });
  $('#lfm').filemanager('image');

  var child_cat_id = {{ $product->child_cat_id }};
$("#cat_id").change(function(){
    // e.preventDefault;
    var cat_id = $(this).val();
    alert(cat_id);
    if(cat_id != null) {
        $.ajax({
        url : "/admin/product/"+cat_id,
        method : "POST",
        data : {
            _token : '{{csrf_token()}}'
        },
        success : function (res) {
            var html_option = "<option>--Child Category--</option>";
            if(res.status) {
                console.log(res)
                $('#child_cat_div').removeClass('d-none');
                $.each(res.data, function(id,title){
                    html_option += "<option value='"+id+"' "+(child_cat_id == id ? 'selected': '')+">"+title+"</option>";
                    // console.log(title,id)
                })

            } else {
                html_option += "<option value='"+null+"'>"+res.msg+"</option>";
            }
            $('#child_cat_id').html(html_option)

        }
    })
    }
})
if(child_cat_div != null) {
    $('#cat_id').change();
}
</script>
@endsection


