<!doctype html>
<html lang="en">

<head>
    
    @include('frontend.layouts.head')

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <!-- Header Area -->
    <header class="header_area" id="header-ajax">
        @include('frontend.layouts.header')
    </header>
    <!-- Header Area End -->

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
    </div>
    
    <!-- *** Content *** -->

        @yield('content')

    <!-- *** CONTENT END *** -->


    <!-- Footer Area -->
        @include('frontend.layouts.footer')
    <!-- Footer Area -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
        
        @include('frontend.layouts.script')

        <script>
        $(document).on('click','.cart_delete',function(e){
            e.preventDefault();
            var cart_id=$(this).data('id');

            var token="{{ csrf_token() }}";
            var path="{{ route('cart.delete') }}";

            $.ajax({
                url:path,
                type:"POST",
                dataType:"JSON",
                data:{
                    cart_id:cart_id,
                    _token:token,
                },
                success:function(data){
                    console.log(data);
                    if(data['status']){
                        $('body #header-ajax').html(data['header']);
                        $('body #cart-counter').html(data['cart_counter']);
                        swal({
                          title: "Good job!",
                          text: data['message'],
                          icon: "success",
                          button: "Ok",
                        });
                    }
                },
                error:function(err){
                    console.log(err);
                }
            });
        });
    </script>
</body>

</html>