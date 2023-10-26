@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-md-12">
        @include('backend.layouts.notification')
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Products
                  <a class="btn btn-sm btn-outline-secondary" href="{{ route('banner.create') }}"><i class="fas fa-plus"></i> Create Product</a>
                </h1>
                <p class="float-right">Total Products :{{ \App\Models\Product::count() }}</p>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Photo</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Size</th>
                    <th>Condition</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($products as $item)

                    @php
                      $photo=explode(',',$item->photo);
                    @endphp
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->title }}</td>
                      <td><img src="{{ $photo[0] }}" alt="banner photo" style="max-height: 90px;max-width: 120px;"></td>
                      <td>{{ number_format($item->price,2) }}</td>
                      <td>{{ $item->discount }}%</td>
                      <td>{{ $item->size }}</td>
                      <td>
                        @if($item->condition=='new')
                          <span class="badge badge-success">{{ $item->condition }}</span>
                        @elseif($item->condition=='popular')
                          <span class="badge badge-warning">{{ $item->condition }}</span>
                        @else
                          <span class="badge badge-primary">{{ $item->condition }}</span>
                        @endif
                      </td>
                      <td>
                        <input type="checkbox" name="toogle" value="{{ $item->id }}" data-toggle="toggle" {{ $item->status=='active' ? 'checked' : '' }} data-on="active" data-off="inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                      </td>
                      <td>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#productID{{ $item->id }}" title="view"  data-placement="bottom" class="float-left btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i></a>

                        <a href="{{ route('product.edit', $item->id) }}" data-toggle="tooltip" title="edit"  data-placement="bottom" class="float-left btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>

                        <form class="float-left ml-1" action="{{ route('product.destroy', $item->id) }}" method="POST">
                          @csrf
                          @method('delete')
                          <a href="" data-toggle="tooltip" title="delete" data-id="{{ $item->id }}"  data-placement="bottom" class="dltBtn btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></a> 
                        </form>
                        
                      </td>
                      {{--MODAL--}}
                      <div class="modal fade" id="productID{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          @php
                            $product=\App\Models\Product::where('id', $item->id)->first();
                          @endphp
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">{{ \Illuminate\Support\Str::upper($product->title) }}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <strong>Summary:</strong>
                              <p>{!! html_entity_decode($product->summary) !!}</p>
                              <strong>Description:</strong>
                              <p>{!! html_entity_decode($product->description) !!}</p>

                              <div class="row">
                                <div class="col-md-4">
                                  <strong>Price:</strong>
                                  <p>${{ number_format($product->price,2) }}</p>
                                </div>
                                <div class="col-md-4">
                                  <strong>Offer Price:</strong>
                                  <p>${{ number_format($product->offer_price,2) }}</p>
                                </div>
                                <div class="col-md-4">
                                  <strong>Stock:</strong>
                                  <p>{{$product->stock }}</p>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                  <strong>Category:</strong>
                                  <p>{{ \App\Models\Category::where('id', $product->cat_id)->value('title') }}</p>
                                </div>
                                <div class="col-md-6">
                                  <strong>Child Category:</strong>
                                  <p>{{ \App\Models\Category::where('id', $product->child_cat_id)->value('title') }}</p>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-4">
                                  <strong>Brand:</strong>
                                  <p>{{ \App\Models\Brand::where('id', $product->brand_id)->value('title') }}</p>
                                </div>
                                <div class="col-md-4">
                                  <strong>Size:</strong>
                                  <p class="badge badge-success">{{ $product->size }}</p>
                                </div>
                                <div class="col-md-4">
                                  <strong>Vendor:</strong>
                                  <p>{{ \App\Models\User::where('id', $product->vendor_id)->value('full_name') }}</p>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <strong>Condition:</strong>
                                  <p class="btn btn-primary">{{ $product->condition }}</p>
                                </div>
                                <div class="col-md-6">
                                  <strong>Status:</strong>
                                  <p class="btn btn-danger">{{ $product->status }}</p>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.dltBtn').click(function(e) {
      var form=$(this).closest('form');
      var dataId=$(this).data('id');
      e.preventDefault();
      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();
          swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
          });
        } else {
          swal("Your imaginary file is safe!");
        }
      });
    });
  </script>

  <script>
    $('input[name=toogle]').change(function() {
      var mode=$(this).prop('checked');
      var id=$(this).val();
      //alert(id);
      $.ajax({
        url:"{{route('product.status')}}",
        type:"POST",
        data:{
          _token:'{{ csrf_token()}}',
          mode:mode,
          id:id,
        },
        success:function (response) {
          if(response.status){
            alert(response.msg);
          }
          else{
            alert('Please try again!');
          }
        }
      })
    })
  </script>
@endsection
