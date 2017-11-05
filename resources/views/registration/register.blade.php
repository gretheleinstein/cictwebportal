@include('global.html-start')
<head>
@include('global.html-header')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/scrolling-nav.css') }}">
</head>

<body id="page-top"> <!-- Navigation -->
  <div class="loader" style="position: fixed; top: 50%; left: 50%;">
       <div class="loader-inner ball-grid-pulse">
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         <div></div>
         <div></div>
       </div>
  </div>

  <div id="container-nav" class="">
  </div>

    @include('global.reusable-js')
    @include('registration.register-js')
    <!-- this will contain the reigster views -->
    <div id = "container">

    </div>

    <script src="{{ asset('js/bootstrap/scrolling-nav.js') }}"></script>
    @include('global.js-footer-scripts')
    @include('global.html-end')
