@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

        <div class="col-md-12">
          @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
        </div>
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>
            </div>

        
            <div class="card-body">
              <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('patch')
              <div class="form-group">
                <label for="inputName">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Title" name="title" value="{{$category->title }}">
              </div>

              <div class="form-group">
                <label for="inputDescription">Summary</label>
                <textarea class="form-control" id="description" placeholder="Write some text..." name="summary" rows="4">{{ $category->summary }}</textarea>
              </div>

              <div class="form-group">
                <label for="inputDescription">Is parent :</label>
                <input type="checkbox" id="is_parent" name="is_parent" value="1" {{ $category->is_parent==1 ? 'checked':'' }} >
              </div>

              <div class="form-group {{ $category->is_parent==1 ? 'd-none':'' }}" id="parent_cat_div">
                <label for="parent_id">Parent Category</label>
                <select name="parent_id" class="form-control custom-select">
                  <option value="">-- Parent Category --</option>
                  @foreach($parent_cats as $pcats)
                    <option value="{{ $pcats->id }}" {{ $pcats->id==$category->parent_id ? 'selected':'' }}>{{ $pcats->title }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="inputDescription">Photo</label>
                <div class="input-group">
                   <span class="input-group-btn">
                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                       <i class="fa fa-picture-o"></i> Choose
                     </a>
                   </span>
                   <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ $category->photo }}">
                 </div>
                 <div id="holder" style="margin-top:15px;max-height:100px;"></div>             
               </div>

                <button type="submit" class="btn btn-success">Update</button>
                  <button type="submit" class="btn btn-outline-secondary">Cancel</button>
              </form>

            </div>

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  @endsection

  @section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
       $('#lfm').filemanager('image');
    </script>

    <script>
    $(document).ready(function() {
        $('#description').summernote();
    });
  </script>
  <script>
    $('#is_parent').change(function(e) {
      e.preventDefault();
      var is_checked=$('#is_parent').prop('checked');
      //alert(is_checked);
      if(is_checked){
        $('#parent_cat_div').addClass('d-none');
        $('#parent_cat_div').val('');
      }else{
        $('#parent_cat_div').removeClass('d-none');
      }
    })
  </script>
  @endsection
