@extends('backend.layouts.master')
@section('links')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

@endsection
@section('content')
    <div class="container">
        <h3> <b>Create Banner</b></h3>

    <form  method="post" action="{{route('category.update', $category->id)}}" enctype="multipart/form-data">
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
                    <input type="text" class="form-control" name="title" value="{{$category->title}}" required>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="form-group">

                        <label for="">Summary</label>
                        <textarea id="summernote"  name="summary" required>{{$category->summary}}</textarea>

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

            <div class="col-md-12 mb-4">
                <label for="">--Status--</label>
                <select name="status" id="" class="form-control">
                    <option value="active" {{$category->status == 'active' ? 'selected' : ''}}>active</option>
                    <option value="inactive" {{$category->status == 'inactive' ? 'selected' : ''}}>inactive</option>
                </select>
            </div>

            <label for="is_parent">Is Parent</label>
            <input type="checkbox" id="is_parent" name="is_parent" data-toggle="toggle" {{$category->is_parent ? "checked" : ""}} value="1" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="default" data-width="100">

            <div class="col-md-12 mb-4 {{$category->is_parent ? "d-none" : ""}}" id="parent_select">
                <label for="">--Parent Category--</label>
                <select name="parent_id"  class="form-control">
                    @foreach ($parent_categories as $item)
                        <option value="{{$item->id}}" {{$category->parent_id == $item->id ? 'selected' : ''}}>{{$item->title}}</option>

                    @endforeach
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
    $('#summernote').summernote();
  });
  $('#lfm').filemanager('image');

$("#is_parent").change(function(e){
    e.preventDefault;
    var isChecked = $(this).prop('checked');
    // alert(isChecked);
    if(isChecked) {
        $('#parent_select').addClass('d-none');
    } else {
        $('#parent_select').removeClass('d-none');
    }
})
</script>
@endsection


