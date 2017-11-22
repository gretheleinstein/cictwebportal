<script type = "text/javascript">
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
  if (key == 13) // the enter key code
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
function xhr_methods(state, status){
  if(state == "0"){
    notify('Status Error','Request not initialized. Refresh browser.');
  }
  if(state == "1"){
    notify('Status Result','Server connection established');
  }
  if(state == "2"){
    notify('Status Result','Request received');
  }
  if(state == "3"){
    notify('Status Result','Processing request');
  }
  if(status == "300"){
    notify("300 Multiple Choices","A link list. The user can select a link and go to that location. Maximum five addresses.");
  }
  if(status == "301"){
    notify("301 Moved Permanently","The requested page has moved to a new URL .");
  }
  if(status == "302"){
    notify("302 Found","The requested page has moved temporarily to a new URL .");
  }
  if(status == "303"){
    notify("303 See Other","The requested page can be found under a different URL.");
  }
  if(status == "304"){
    notify("304 Not Modified","Indicates the requested page has not been modified since last requested.");
  }
  if(status == "306"){
    notify("306 Switch Proxy","No longer used")
  }
  if(status == "307"){
    notify("307 Temporary Redirect","The requested page has moved temporarily to a new URL.");
  }
  if(status == "308"){
    notify("308 Resume Incomplete","Used in the resumable requests proposal to resume aborted PUT or POST requests.");
  }
  if(status == "400"){
    notify("400 Bad Request",'The request cannot be fulfilled due to bad syntax');
  }
  if(status == "401"){
    notify('401 Unauthorized','The request was a legal request, but the server is refusing to respond to it. For use when authentication is possible but has failed or not yet been provided');
  }
  if(status == "402"){
    notify("402 Payment required","Reserved for future use");
  }
  if(status == "403"){
    notify("403 Forbidden","The request was a legal request, but the server is refusing to respond to it");
  }
  if(status == "404"){
  //  new Notification('Hello', {body: 'Yay!'});
    notify("404 Not Found","The requested page could not be found but may be available again in the future");
    //window.location.href = "{{ route('error-404') }}";
  }
  if(status == "405"){
    notify("405 Method not allowed","A request was made of a page using a request method not supported by that page");
  }
  if(status == "406"){
    notify("406 Not Acceptable","The server can only generate a response that is not accepted by the client");
  }
  if(status == "407"){
    notify("407 Proxy Authentication","Required	The client must first authenticate itself with the proxy");
  }
  if(status == "408"){
    notify("408 Request Timeout","The server timed out waiting for the request");
  }
  if(status == "409"){
    notify("409 Conflict","The request could not be completed because of a conflict in the request");
  }
  if(status == "410"){
    notify("410 Gone","The requested page is no longer available");
  }
  if(status == "411"){
    notify("411","Length Required	The 'Content-Length' is not defined. The server will not accept the request without it ");
  }
  if(status == "412"){
    notify("412 Precondition Failed","The precondition given in the request evaluated to false by the server");
  }
  if(status == "413"){
    notify("413 Request Entity Too Large","The server will not accept the request, because the request entity is too large");
  }
  if(status == "414"){
    notify("414 Request-URI Too Long","The server will not accept the request, because the URL is too long. Occurs when you convert a POST request to a GET request with a long query information ");
  }
  if(status == "415"){
    notify("415 Unsupported Media Type","The server will not accept the request, because the media type is not supported ");
  }
  if(status == "416"){
    notify("416 Requested Range Not Satisfiable","The client has asked for a portion of the file, but the server cannot supply that portion");
  }
  if(status == "417"){
    notify("417 Expectation Failed","The server cannot meet the requirements of the Expect request-header field");
  }
  if(status == "500"){
    notify("500 Internal Server Error","Please refresh your browser and try again after a few seconds.")
    //A generic error message, given when no more specific message is suitable
    }
  if(status == "501"){
    notify("501 Not Implemented","The server either does not recognize the request method, or it lacks the ability to fulfill the request")
    }
  if(status == "502"){
    notify("502 Bad Gateway","The server was acting as a gateway or proxy and received an invalid response from the upstream server")
    }
  if(status == "503"){
    notify("503 Service Unavailable","The server is currently unavailable (overloaded or down)")
    }
  if(status == "504"){
    notify("504 Gateway Timeout","The server was acting as a gateway or proxy and did not receive a timely response from the upstream server")
    }
  if(status == "505"){
    notify("505 HTTP Version Not Supported","The server does not support the HTTP protocol version used in the request")
    }
  if(status == "511"){
    notify("511 Network Authentication Required","The client needs to authenticate to gain network access")
    }
}

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
}

/*function notify(title, msg){
  Push.create(title,{
    body: msg,
    icon: "{{ asset('img/logo/CICT_RED.png') }}",
    timeout: 5000,
  });
} */

</script>
