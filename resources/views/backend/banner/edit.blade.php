@extends('backend.layouts.master')

@section('content')
    <div class="container">
        <h3> <b>Create Banner</b></h3>

    <form  method="post" action="{{route('banner.update', $banner->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                    <input type="text" class="form-control" name="title" value="{{$banner->title}}" required>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="form-group">

                        <label for="">Description</label>
                        <textarea id="summernote"  name="description" value="{{$banner->description}}" required>{{$banner->description}}</textarea>

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
                    <option value="active" {{$banner->status == 'active' ? 'selected' : ''}}>active</option>
                    <option value="inactive" {{$banner->status == 'inactive' ? 'selected' : ''}}>inactive</option>
                </select>
            </div>

            <div class="col-md-12 mb-4">
                <label for="">--Condition--</label>
                <select name="condition" id="" class="form-control">
                    <option value="banner" {{$banner->condition == 'banner' ? 'selected' : ''}}>Banner</option>
                    <option value="promo" {{$banner->condition == 'promo' ? 'selected' : ''}}>Promo</option>
                </select>
            </div>

        <div class="d-flex justify-content-end ">

            <a href="{{route('banner')}}" class="btn btn-secondary mr-1"  type="submit">Cancel</a>
            <button class="btn btn-success " id="submit" type="submit">Update</button>
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

  <script>

    $(document).ready(function() {
    $('#summernote').summernote();
  });
  $('#lfm').filemanager('image');

</script>
@endsection


