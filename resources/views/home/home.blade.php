@include('global.html-start')
<head>
@include('global.html-header')
<style media="screen">
body {
font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
font-size: 16px;
background-color: #ffffff;
color: #46484a; }

a {
color: #59a0d7; }

h1 {
font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
font-size: 4rem;
font-weight: 600; }

h2 {
font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
font-size: 2.8rem;
font-weight: 500; }

h3 {
font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
font-size: 2rem;
font-weight: 500; }

h4 {
font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
font-size: 1rem;
font-weight: 700;
text-transform: uppercase; }

p {
color: #696b6e;
font-size: .9rem; }

.divider {
display: block;
width: 6rem;
height: 0.3rem;
background-color: #dfe1e5;
margin: 2rem auto; }

.navbar-trans {
background: transparent; }

a.navbar-brand, a.logo {
font-family: "Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif;
color: #fff !important;
font-size: 2rem;
font-weight: bold;
margin-top: 0; }

a.logo:hover, a.logo:active, a.logo:focus {
text-decoration: none; }

li.nav-item .btn {
margin-top: .2rem;
margin-left: .4rem; }
li.nav-item .btn-white {
color: #46484a; }

.cover {
/*background: #2b2d34 url(http://dev.turquoiseltd.com/wp-content/uploads/2017/05/081020159999_1_slide-970x677.jpg) center;*/
background-color: #000;
background-size: cover;
min-height: 50rem;
height: auto;
border-radius: 0;
width: 100%;
color: #fff;
padding-top: 1rem; }

.cover h1 {
  font-weight: 200; }

.cover p.lead {
  margin: 2rem auto;
  color: rgba(255, 255, 255, 0.75); }

.cover .cover-container {
  display: table;
  height: 100%;
  min-height: 44rem;
  margin: 0 auto; }

  .btn-primary, .btn-outline-primary, .btn-secondary, .btn-outline-secondary, .btn-white, .btn-outline-white, .btn-success, .btn-outline-success, .btn-info, .btn-outline-info, .btn-warning, .btn-outline-warning, .btn-danger, .btn-outline-danger {
font-size: .75rem;
text-transform: uppercase;
font-weight: 700;
border-radius: .3rem; }

.btn-outline-primary, .btn-outline-secondary, .btn-outline-white, .btn-outline-success, .btn-outline-info, .btn-outline-warning, .btn-outline-danger {
border-width: 0.15rem; }

.btn-lg {
padding: 1.1rem 2.5rem;
font-size: .9rem; }

.btn-primary, .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
background-color: #59a0d7;
border-color: #59a0d7; }

.btn-primary:hover, .btn-primary:focus, .btn-primary:active {
background-color: #4089c1;
border-color: #4089c1; }

.btn-outline-primary, .btn-outline-primary:visited {
color: #59a0d7;
border-color: #59a0d7;
background: none; }

.btn-outline-primary:hover, .btn-outline-primary:focus, .btn-outline-primary:active {
background-color: #59a0d7;
border-color: #59a0d7;
color: #fff; }

.btn-secondary {
border-color: #696b6e;
background-color: #696b6e;
color: #fff; }

.btn-secondary:hover, .btn-secondary:focus, .btn-secondary:active {
border-color: #46484a;
background-color: #46484a;
color: #fff; }

.btn-outline-secondary, .btn-outline-secondary:visited {
color: #696b6e;
border-color: #696b6e;
background: none; }

.btn-outline-secondary:hover, .btn-outline-secondary:focus, .btn-outline-secondary:active {
border-color: #696b6e;
background: #696b6e;
color: #fff; }

.btn-white {
border-color: #fff;
background-color: #fff;
color: #46484a; }

.btn-white:hover, .btn-white:focus, .btn-white:active {
border-color: #dfe1e5;
background-color: #dfe1e5;
color: #46484a; }

.btn-outline-white, .btn-outline-white:visited {
background: none;
color: #fff;
border-color: #fff; }

.btn-outline-white:hover, .btn-outline-white:focus, .btn-outline-white:active {
color: #46484a;
background: #fff; }

.link-white, link-white:visited {
font-size: .75rem;
text-transform: uppercase;
font-weight: 700;
border-radius: .3rem;
border: 0;
color: #fff; }

.link-white:hover, .link-white:focus, .link-white:active {
color: #dfe1e5 !important; }

</style>
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/scrolling-nav.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
<script src="{{ asset('js/bootstrap/scrolling-nav.js') }}"></script> -->
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top"> <!-- Navigation -->
  <div id="container-nav"></div>

  <div id = "container-hello"></div>

  <div id = "container-steps-in-eval"></div>

  @include('global.reusable-js')
  @include('home.home-js')

  <!-- this will contain the login form -->
  <div id = "container"></div>

  <div id = "container-announcement"></div>

  <div id = "container-faculty-sched"></div>

  <div id = "container-student-app"></div>

  <div id = "container-offline-webs"></div>

  <div id = "container-footer"></div>

  @include('global.js-footer-scripts')
  @include('global.html-end')
