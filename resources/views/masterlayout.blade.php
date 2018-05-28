<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <title>New Điểm Danh</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="{!! asset('/assets/js/dropzone.js') !!}"></script>
    <script src="{{asset('/assets/js/toastr.min.js')}}"></script>
    <script src="{!! asset('/assets/js/require.min.js') !!}"></script>
   
    <script>
      requirejs.config({
          baseUrl: '/'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="{!! asset('/assets/css/dashboard.css') !!}" rel="stylesheet" />
    <link href="{!! asset('/assets/css/dropzone.css') !!}" rel="stylesheet" />
    <script src="{!! asset('/assets/js/dashboard.js') !!}"></script>
    <!-- Input Mask Plugin -->
    <script src="{!! asset('/assets/plugins/input-mask/plugin.js') !!}"></script>
    <link href="{!! asset('/assets/css/custom.css') !!}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('/assets/css/toastr.min.css')}}">
  </head>
  <body>
      <script>
        $(document).ready( function() {
            $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
            });
    
            $('.btn-file :file').on('fileselect', function(event, label) {
                
                var input = $(this).parents('.input-group').find(':text'),
                    log = label;
                
                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }
            
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#img-upload').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                }
            }
    
            $("#imgInp").change(function(){
                readURL(this);
            }); 	
        });
        function mess(a,b){
            Command: toastr[a](b)

            toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
        }
    </script>
  @include('header')
    <div class="d-flex">
        
        @include('sidebar')
        @yield('content')
    </div>
  </body>
  <script type="text/javascript">
     $(document).ready(function () {
         $('#sidebarCollapse').on('click', function () {
             $('#sidebar').toggleClass('active');
         });
     });
     
 </script>
</html>