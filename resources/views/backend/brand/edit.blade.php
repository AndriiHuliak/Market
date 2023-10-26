@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Brand</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Brand</a></li>
              <li class="breadcrumb-item active">Edit Brand</li>
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
            <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('patch')
              <div class="form-group">
                <label for="inputName">Title</label>
                <input type="text" class="form-control" placeholder="Title" name="title" value="{{ $brand->title }}">
              </div>

              <div class="form-group">
                <label for="inputDescription">Photo <span class="text-danger">*</span></label>
                <div class="input-group">
                   <span class="input-group-btn">
                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                       <i class="fa fa-picture-o"></i> Choose
                     </a>
                   </span>
                   <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ $brand->photo }}">
                 </div>
                 <div id="holder" style="margin-top:15px;max-height:100px;"></div>             
               </div>

                <button type="submit" class="btn btn-primary">Update</button>
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
  @endsection
