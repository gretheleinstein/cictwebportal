@include('global.html-start')
<head>
@include('global.html-header')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/scrolling-nav.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/forgot_pass.css') }}">
</head>

<body id="page-top">
  <div class="loader" style="position: absolute; top: 50%; left: 50%;">
      <div class="loader-inner square-spin">
        <div></div>
      </div>
  </div>

  <div id="container-nav" class="">
  </div>

   @include('global.reusable-js')
   @include('forgot_password.forgot-pass-js')
    <!-- this will contain the reigster views -->
    <div id="container">
    </div>

    @include('global.js-footer-scripts')
    @include('global.html-end')
