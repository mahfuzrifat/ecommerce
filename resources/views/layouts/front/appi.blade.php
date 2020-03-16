<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge"> 
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ecommerce') }} / @yield('title')</title> 
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/images/favicon.ico') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/front/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/assets/css/icon-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/assets/css/style.css') }}">
    <script src="{{ asset('assets/front/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <link href="{{ asset('assets/backend/css/themes/all-themes.css') }}" rel="stylesheet" /> 
    <link rel="stylesheet" href="{{ asset('assets/backend/lobibox/dist/css/lobibox.min.css') }}"/>
    @stack('css')
</head>

<body>

<!-- Header Section Start -->
<div class="header-section section">

    <!-- Header Top Start -->
    @include('layouts.front.partials.header')
    <!-- Header Top End -->

    <!-- Header Bottom Start -->
    @include('layouts.front.partials.nav_one')
    <!-- Header Bottom End -->

    <!-- Header Category Start -->
    @include('layouts.front.partials.nav_two') 
    <!-- Header Category End -->

</div><!-- Header Section End -->

<!-- Mini Cart Wrap Start -->                      
<div class="mini-cart-wrap">
    <!-- Mini Cart Top -->
@include('layouts.front.partials.cart')
</div><!-- Mini Cart Wrap End --> 

<!-- Cart Overlay -->
<div class="cart-overlay"></div>

<!-- Hero Section Start -->
@yield('content')

@include('layouts.front.partials.footer')


<!-- jQuery JS -->
<script src="{{ asset('assets/front/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
<!-- Popper JS -->
<script src="{{ asset('assets/front/assets/js/popper.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('assets/front/assets/js/bootstrap.min.js') }}"></script>
<!-- Plugins JS -->
<script src="{{ asset('assets/front/assets/js/plugins.js') }}"></script>
<!-- Ajax Mail -->
<script src="{{ asset('assets/front/assets/js/ajax-mail.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('assets/front/assets/js/main.js') }}"></script>

<script src="{{ asset('assets/backend/js/demo.js') }}"></script>  
<script src="{{ asset('assets/backend/lobibox/dist/js/lobibox.min.js') }}"></script>
           

 <script>
      @if(Session::has('messege'))
        var type="{{Session::get('alert-type','info')}}"
        switch(type){
            case 'info':
                 Lobibox.notify('info', {
                  pauseDelayOnHover: true,
                  continueDelayOnInactiveTab: false,
                  icon: 'fa fa-info-circle',
                  position: 'right top',
                  showClass: 'lightSpeedIn',
                  hideClass: 'lightSpeedOut',
                  width: 400,
                  msg: "{{ Session::get('messege') }}"
                  });
                 break;
            case 'success':
                Lobibox.notify('success', {
                  pauseDelayOnHover: true,
                  continueDelayOnInactiveTab: false,
                  icon: 'fa fa-check-circle',
                  position: 'right top',
                  showClass: 'lightSpeedIn',
                  hideClass: 'lightSpeedOut',
                  width: 400,
                  msg: "{{ Session::get('messege') }}"
                  });
                break;
            case 'warning':
                Lobibox.notify('warning', {
                  pauseDelayOnHover: true,
                  continueDelayOnInactiveTab: false,
                  icon: 'fa fa-exclamation-circle',
                  position: 'right top',
                  showClass: 'lightSpeedIn',
                  hideClass: 'lightSpeedOut',
                  width: 400,
                  msg: "{{ Session::get('messege') }}"
                  });
                break;
            case 'error':
                  Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    icon: 'fa fa-times-circle',
                    position: 'right top',
                    showClass: 'lightSpeedIn',
                    hideClass: 'lightSpeedOut',
                    width: 400,
                    msg: "{{ Session::get('messege') }}"
                    });
                break;
        }
      @endif
    </script>
@stack('js')
</body>
</html>