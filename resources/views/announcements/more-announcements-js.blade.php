<script type = "text/javascript">
$(document).ready(function() {
  load_nav();
});

function load_nav(){
  $("#container-nav").load("{{ asset('html/navbar/nav.php') }}",function(){
    $("#lnk_home").attr('href',"{{ route('home','hello') }}");
    $("#lnk_search").attr('href',"{{ route('register') }}");
    $("#lnk_app").attr('href',"{{ route('get-app') }}");
    $("#lnk_register").attr('href',"{{ route('register') }}");
    $("#logo").attr('src', '{{ asset("img/logo/navnav.png") }}');
    announcements();
  });
}

function announcements(){
  $("#container-announcement").load("{{ asset('html/announcements/announcement.php') }}", function(){
    request_announcements();
  });
}

function request_announcements(){
  request = new Request();
  request.url = "{{ route('get-more-anno') }}";
  request.type = 'POST';
  request.replyType = 'json';
  // start
  request.begin = function(){

  }
  // success
  request.done = function(data, textStatus, xhr){
    onRequestAnnouncementSuccess(data/*$.parseJSON(data)*/);
  }
  // failed
  request.fail = function(xhr, textStatus, errorThrown){
    //alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
    //alert("JQUERY TEXT STATUS: " + textStatus);
    //alert("ERROR DESCRIPTION: " + errorThrown);
//    window.location = error_route + xhr.status;
  }
  // finished
  request.always = function(){
    // this will be called always whether fail or done at the end of this request
  }
  // send
  request.send(); // start the ajax request
}

function onRequestAnnouncementSuccess(data){
  if(data == ""){
    $("#tbl_announcements").append("<tr><td colspan='3'>No announcements<td></tr>");
  }else {
    $.each(data, function(key, value) {
      faculty_name = (value['faculty'] != null) ? (value['faculty']['last_name']+", "+value['faculty']['first_name'] +" "+value['faculty']['middle_name']) : ("");
      $("#card_announcements").append('<div class="card text-left wow fadeInUp animated anno-cards s-light"><div class="card-body anno-cards-body"><h4 class="card-title bold">'+value['all']['title']+'</h4><div class="collapse" id="'+key+'"><p class="card-text">'+value['all']['message']+'</p></div><p class="card-text"><small class="">-'+faculty_name+'</small><a data-toggle="collapse" href="#'+key+'" class="btn btn-black-bordered float-right btn-sm">Read More</a></p></div><div class="card-footer div-black-top-bordered"><small class="">' +value['date_time']+'</small></div></div><br/>')
    });
    load_footer();
  }
}

function load_footer(){
  $( "#container-footer" ).load("{{ asset( 'html/home/footer.php' ) }}", function(){
  });
}

</script>
