@extends('backend.layouts.master')
@section('links')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

@endsection
@section('content')
    <div class="container">
        <h3> <b>Create Banner</b></h3>

    <form  method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
        @csrf
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
                    <input type="text" class="form-control" name="title" value="{{old('title')}}" required>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="form-goup">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" name="price" value="{{old('price')}}" required>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="form-goup">
                    <label for="discount">Discount</label>
                    <input type="number" class="form-control" max="100" name="discount" value="{{old('discount')}}" required>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="form-goup">
                    <label for="discount">Stock</label>
                    <input type="number" class="form-control" name="stock" value="{{old('discount')}}" required>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="form-group">

                        <label for="">Description</label>
                        <textarea class="summernote"  name="description" value="{{old('summary')}}">{{old('description')}}</textarea>

                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="form-group">
                        <label for="">Summary</label>
                        <textarea class="summernote"  name="summary" value="{{old('summary')}}" required>{{old('summary')}}</textarea>

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
                    @foreach (\App\Models\Category::where('is_parent',true)->get() as $brand)

                        <option value="{{$brand->id}}">{{$brand->title}}</option>
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
                <label for="size">Brand</label>
                <select name="size"  class="form-control">
                        <option value="">Choose Size</option>
                        <option value="XS">Extra Small</option>
                        <option value="S">Small</option>
                        <option value="M">Medium</option>
                        <option value="L">Large</option>
                        <option value="XL">Extra Large</option>
                </select>
            </div>

            <div class="col-md-12 mb-4" id="parent_select">
                <label for="condition">Condition</label>
                <select name="condition"  class="form-control">
                        <option value="">--Choose Condition--</option>
                        <option value="winter">Winter</option>
                        <option value="new">New</option>
                        <option value="Popular">Popular</option>
                </select>
            </div>

            <div class="col-md-12 mb-4">
                <label for="status">--Status--</label>
                <select name="status" id="status" class="form-control">
                    <option value="active" {{old('status') == 'active' ? 'selected' : ''}}>active</option>
                    <option value="inactive" {{old('status') == 'inactive' ? 'selected' : ''}}>inactive</option>
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
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


  <script>

    $(document).ready(function() {
    $('.summernote').summernote();
  });
  $('#lfm').filemanager('image');

$("#cat_id").change(function(){
    // e.preventDefault;
    var cat_id = $(this).val();
    alert(cat_id);
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
                    html_option += "<option value='"+id+"'>"+title+"</option>";
                    // console.log(title,id)
                })

            } else {
                html_option += "<option value='"+null+"'>"+res.msg+"</option>";
            }
            $('#child_cat_id').html(html_option)

        }
    })
})
</script>
@endsection


