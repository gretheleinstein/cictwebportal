<script type = "text/javascript">
var error_route = "{{ route('error-status','') }}/";

function loader(id){
  $(id).html('<div class="loader" style="height:300px;"></div>');
  $(".loader").append('<div class="loader-inner ball-scale-ripple-multiple" style="position: relative; top: 50%; left: 50%; width:50px;"></div>');
  $(".loader-inner").append('<div></div><div></div><div></div>');
}

function load_gif_one(id){
  $(id).prepend('<img src="{{ asset("img/load-2.gif") }}" height="20px" width="20px" id="btn-img"/>');
}

function hide_buttons(id, elem){
  $(id).attr('style', 'display:none');
  $(elem).append('<img id="img_load_btn" src="{{ asset("img/load-2.gif") }}" height="40px" width="40px" id="btn-img"/>');
}

function show_buttons(id){
  $(id).removeAttr('style');
  $('#img_load_btn').remove();
}

function btn_clicked_start(id){
  $(id).prop('disabled', true);
  $(id).prepend('<img id="btn_loading_gif" src="{{ asset("img/load-2.gif") }}" height="20px" width="20px"/>');
}

function btn_clicked_end(id){
  $(id).prop('disabled', false);
  $("#btn_loading_gif").remove();
}

function show_result(elem, text){
  $(elem).text("");
  $(elem).show().append(text);
  $(elem).hide().fadeIn("slow");
}

function hide_result(id, elem){
  $(id).click(function(){
    $(elem).hide().fadeOut("slow");
  });
}

function show_notif(elem, text){
  $(elem).text("");
  $(elem).show().append(text);
  $(elem).hide().fadeIn("slow");
  setTimeout(function() {
    $(elem).fadeOut("slow");
  },2000);
}

function onKeyPress(id, btn){
$(id).keypress(function(e) {
  var key = e.which;
  if(key == 13) // the enter key code
  {
    $(btn).click();
    return false;
  }
});
}

function convert(hours){
  var hrs = hours.slice(0, 2);
  var mm = hours.slice(2, 5);
  var hrs12 = hrs > 12 ? hrs - 12 : hrs;
  var hr = hrs12.toString();
  var zero = (hr.length == 1) ? (hrs12 = "0"+hrs12) : ("");
  var mer = (hrs <= 12) ? (merridian = "AM") : (merridian = "PM");
  var new_time = hrs12 + mm +" "+ merridian;
  return new_time;
}


function change_to_words(year_level){
  if(year_level == 1){
    year_level_word = "First"
  }else if(year_level == 2){
    year_level_word = "Second"
  }else if(year_level == 3){
    year_level_word = "Third"
  }else{
    year_level_word = "Fourth"
  }
  return year_level_word;
}

///------------------------------------

function notify(title, msg){
  $("#divMessageBox").remove();
  $("body").append('<div class="divMessageBox slideInUp animated" id="divMessageBox"></div>')
  $("#divMessageBox").append('<div class="div_sub_box"></div>');
  $(".div_sub_box").append('<div class="div_title mont"><span class="glyphicon glyphicon-exclamation-sign" style="font-size:20px"></span> '+title+'</div></br>');
  $(".div_title").append('<span class="glyphicon glyphicon-option-horizontal pull-right" id="close_notif" style="font-size:20px; color: #A4A4A4; cursor: pointer">');
  $(".div_sub_box").append('<div class="div_body s-light">'+msg+'</div>');

  $("#close_notif").click(function(event) {
    $("#divMessageBox")
    .animate({
      opacity: 0,
      paddingBottom: 0,
      paddingTop: 0,
      queue: false
    }, 1000, function() {
      $(this).remove();
    });
  });

  setTimeout(function() {
      $("#close_notif").click();
  },5000);
}

/*function notify(title, msg){
  Push.create(title,{
    body: msg,
    icon: "{{ asset('img/logo/CICT_RED.png') }}",
    timeout: 5000,
  });
} */

</script>
