@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
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
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('patch')
              <div class="form-group">
                <label for="inputName">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Title" name="title" value="{{ $product->title }}">
              </div>

              <div class="form-group">
                <label for="inputName">Summary</label>
                <textarea id="summary" class="form-control" placeholder="Some text..." name="summary">{{ $product->summary }}</textarea>
              </div>

              <div class="form-group">
                <label for="inputDescription">Description</label>
                <textarea class="form-control" id="description" placeholder="Write some text..." name="description" rows="4">{{ $product->description }}</textarea>
              </div>

              <div class="form-group">
                <label for="inputName">Stock <span class="text-danger">*</span></label>
                <input type="number" class="form-control" placeholder="Stock" name="stock" value="{{ $product->stock }}">
              </div>

              <div class="form-group">
                <label for="inputName">Price <span class="text-danger">*</span></label>
                <input type="number" step="any" class="form-control" placeholder="Price" name="price" value="{{ $product->price }}">
              </div>

              <div class="form-group">
                <label for="inputName">Discount <span class="text-danger">*</span></label>
                <input type="number" min="0" max="100" step="any" class="form-control" placeholder="Discount" name="discount" value="{{ $product->discount }}">
              </div>

              <div class="form-group">
                <label for="inputDescription">Photo</label>
                <div class="input-group">
                   <span class="input-group-btn">
                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                       <i class="fa fa-picture-o"></i> Choose
                     </a>
                   </span>
                   <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ $product->photo }}">
                 </div>
                 <div id="holder" style="margin-top:15px;max-height:100px;"></div>             
               </div>

              <div class="form-group">
                <label for="">Brands <span class="text-danger">*</span></label>
                <select name="brand_id" class="form-control custom-select">
                  <option>-- Brands --</option>
                  @foreach(\App\Models\Brand::get() as $brand)
                    <option value="{{ $brand->id }}" {{ $brand->id==$product->brand_id ? 'selected':'' }}>{{ $brand->title }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="">Category<span class="text-danger">*</span></label>
                <select id="cat_id" name="cat_id" class="form-control custom-select">
                  <option>-- Category --</option>
                  @foreach(\App\Models\Category::where('is_parent',1)->get() as $cat)
                    <option value="{{ $cat->id }}" {{ $cat->id==$product->cat_id ? 'selected':'' }}>{{ $cat->title }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group d-none" id="child_cat_div">
                <label for="">Child Category <span class="text-danger">*</span></label>
                <select id="child_cat_id" name="child_cat_id" class="form-control custom-select">
                  
                  
                </select>
              </div>

              <div class="form-group">
                <label for="">Size <span class="text-danger">*</span></label>
                <select name="size" class="form-control custom-select">
                  <option>Size</option>
                  <option value="S" {{ $product->size=='S' ? 'selected':'' }}>Small</option>
                  <option value="M" {{ $product->size=='M' ? 'selected':'' }}>Medium</option>
                  <option value="L" {{ $product->size=='L' ? 'selected':'' }}>Large</option>
                  <option value="XL" {{ $product->size=='XL' ? 'selected':'' }}>Extra Large</option>
                </select>
              </div>

              <div class="form-group">
                <label for="">Condition <span class="text-danger">*</span></label>
                <select name="condition" class="form-control custom-select">
                  <option>Conditions</option>
                  <option value="new" {{ $product->condition=='new' ? 'selected':'' }}>New</option>
                  <option value="popular" {{ $product->condition=='popular' ? 'selected':'' }}>Popular</option>
                  <option value="winter" {{ $product->condition=='winter' ? 'selected':'' }}>Winter</option>
                </select>
              </div>

              <div class="form-group">
                <label for="">Vendors <span class="text-danger">*</span></label>
                <select name="vendor_id" class="form-control custom-select">
                  <option>-- Vendors --</option>
                  @foreach(\App\Models\User::where('role', 'vendor')->get() as $vendor)
                    <option value="{{ $vendor->id }}" {{ $vendor->id==$product->vendor_id ? 'selected':'' }}>{{ $vendor->full_name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control custom-select">
                  <option>Status</option>
                  <option value="active" {{ $product->status=='active' ? 'selected':'' }}>Active</option>
                  <option value="inactive" {{ $product->status=='inactive' ? 'selected':'' }}>Inactive</option>
                </select>
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

  <script>
    $(document).ready(function() {
        $('#summary').summernote();
    });
  </script>

  <script>

    var child_cat_id={{ $product->child_cat_id }};

    $('#cat_id').change(function(){
      var cat_id=$(this).val();

      if(cat_id !=null){
        $.ajax({
          url:"/admin/category/"+cat_id+"/child",
          type:"POST",
          data:{
            _token:"{{ csrf_token() }}",
            cat_id:cat_id,
          },
          success:function(response){
            var html_option="<option value=''>--- Child Category ---</option>";
            if(response.status) {
              $('#child_cat_div').removeClass('d-none');
              $.each(response.data,function(id,title){
                html_option +="<option value='"+id+"' "+(child_cat_id==id ? 'selected':'')+">"+title+"</option>"
              });
            }
            else{
              $('#child_cat_div').addClass('d-none');
            }
            $('#child_cat_id').html(html_option);
          }
        });
      }
    });

    if(child_cat_id !=null){
      $('#cat_id').change();
    }
  </script>

  @endsection
