@include('global.html-start')
<head>
@include('global.html-header')
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/scrolling-nav.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
<script src="{{ asset('js/bootstrap/scrolling-nav.js') }}"></script>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top"> <!-- Navigation -->

  <div class = "jumbotron text-center" id = "info">
		<label>BULSU ID:</label><input type = "text" id = "bulsu_ID" name = "bulsu_ID"><br/>
		<label>Lastname:</label><input type = "text" id = "last_name" name = "last_name"><br/>
		<label>Firstname:</label><input type = "text" id = "first_name" name = "first_name"><br/>
		<label>Middlename:</label><input type = "text" id = "first_name" name = "first_name"><br/>
		</div>

  @include('global.reusable-js')


  @include('global.js-footer-scripts')
  @include('global.html-end')
