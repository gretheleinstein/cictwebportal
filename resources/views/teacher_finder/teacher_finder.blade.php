@include('global.html-start')
<head>
@include('global.html-header')

<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top"> <!-- Navigation -->
  <div id="container-nav"></div>

  @include('global.reusable-js')
  @include('teacher_finder.teacher_finder-js')

  <div id = "container-teacher-finder"></div>

  <div id = "container-footer"></div>

  @include('global.js-footer-scripts')
  @include('global.html-end')
