@include('global.html-start')
<head>
@include('global.html-header')
</head>

<body id="page-top" class="bg-orange"> <!-- Navigation -->
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

<div id="container-nav">
</div>

    @include('global.reusable-js')
    @include('registration.register-js')
    <!-- this will contain the reigster views -->
    <div id = "container">

    </div>

    <script src="{{ asset('js/bootstrap/scrolling-nav.js') }}"></script>
    @include('global.js-footer-scripts')
    @include('global.html-end')
