<script type = "text/javascript">
$(".active").removeAttr('style');
$(window).scroll(function(event) {
  $(".active").removeClass('active');
});

$(document).ready(function() {
  load_nav();
});

function load_nav(){
  $("#container-nav").load("{{ asset('html/navbar/home_nav.php') }}",function(){
    $("#lnk_register").attr('href',"{{ route('register') }}");
    load_hello();
    login_form();
    announcements();
    faculty_sched();
    load_eval_steps();
    load_student_app();
    load_free_browsing();
    load_footer();
  });
}

function load_hello(){
  $( "#container-hello" ).load("{{ asset( 'html/home/hello.php' ) }}", function(){
    $("#world").removeAttr('style');
    var startup_popup = setInterval(function() {
      $("#world").attr('style','display: none;');
      $("#cict_firefox").removeAttr('style');
      $("#cict_firefox").hide().fadeIn("slow");
      startup_popup = setTimeout(function() {
        $("#world").hide().fadeIn("slow");
        $("#cict_firefox").attr('style','display: none;');
      },2000);
    },3000);
  });
}

function announcements(){
  $("#container-announcement").load("{{ asset('html/home/announcement.php') }}", function(){
    request_announcements();
  });
}

function request_announcements(){
  request = new Request();
  request.url = "{{ route('get-all-anno') }}";
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
      $("#tbl_announcements").append("<tr><td>"+value['all']['title']+"</td><td style='word-wrap: break-word'>"+value['all']['message']+"</td><td>"+value['date_time']+"</td><td>"+faculty_name+"</td></tr>");
    });
  }
}

function faculty_sched(){
  $("#container-faculty-sched").load("{{ asset('html/home/faculty_sched.php') }}", function(){
    request_faculty_name();
  });
}

function request_faculty_name(){
  request = new Request();
  request.url = "{{ route('get-faculty-name') }}";
  request.type = 'POST';
  request.replyType = 'json';
  // start
  request.begin = function(){

  }
  // success
  request.done = function(data, textStatus, xhr){
    onRequestFacultySuccess(data/*$.parseJSON(data)*/);
  }
  // failed
  request.fail = function(xhr, textStatus, errorThrown){
    //alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
    //alert("JQUERY TEXT STATUS: " + textStatus);
    //alert("ERROR DESCRIPTION: " + errorThrown);
  //  window.location = error_route + xhr.status;
  }
  // finished
  request.always = function(){
    // this will be called always whether fail or done at the end of this request
  }
  // send
  request.send(); // start the ajax request
}

function onRequestFacultySuccess(data){
  if(data == "No data"){
    $("#txt_faculty_name").val("No faculty record found");
  }else{
    var faculty_name = [];
    $.each(data, function(key, value) {
      var each = { label : value['last_name']+", "+value['first_name']+" "+value['middle_name'], id : value['id'] };
      faculty_name.push(each);
    });

    $("#txt_faculty_name").autocomplete({
      source: faculty_name,
      select: function (event, ui) {
        $("#txt_faculty_name").val(ui.item.label); // display the selected name
        $("#txt_faculty_id").val(ui.item.id); // save selected id to hidden input
        return false;
      }
    });

    $("#btn_search_faculty").click(function(event) {
      var id = $("#txt_faculty_id").val();
      request_faculty_sched(id);
    });
  }
}

var routee = "{{ route('get-faculty-sched','') }}/"
function request_faculty_sched(id){
  var validated_id = (id == "") ? ("no id") : (id);
  request = new Request();
  request.url = routee + validated_id;
  request.type = 'POST';
  request.replyType = 'json';
  // start
  request.begin = function(){

  }
  // success
  request.done = function(data, textStatus, xhr){
    onRequestFacultySchedSuccess(data/*$.parseJSON(data)*/);
  }
  // failed
  request.fail = function(xhr, textStatus, errorThrown){
    //alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
    //alert("JQUERY TEXT STATUS: " + textStatus);
    //alert("ERROR DESCRIPTION: " + errorThrown);
    window.location = error_route + xhr.status;
  }
  // finished
  request.always = function(){
    // this will be called always whether fail or done at the end of this request
  }
  // send
  request.send(); // start the ajax request
}

function onRequestFacultySchedSuccess(data){
  $(".scheds, #div_sched").html("");
  if(data[0]['result'] == "No faculty matched"){
    $("#div_sched").prepend('<h1>No results matched your search. Faculty does not exists.</h1>')
  }else if(data[0]['result'] == "No load_group"){
    $("#div_sched").prepend('<h1>faculty has no schedule</h1>')
  }else{
    $.each(data, function(key,value) {
      subject = value['subject'];
      schedule = value['load_group_schedule'];
      load_group = value['load_group'];
      if(value['load_group_schedule'] !=null ){
        for (var i = 0; i < schedule.length; i++) {
          var faculty_name = "";
          $("#"+schedule[i]['class_day']).after("<tr class='text-center scheds'> <td>"+subject[0]['code']+"</td><td>"+convert(schedule[i]['class_start'])+"</td> <td>"+convert(schedule[i]['class_end'])+"</td> <td>"+schedule[i]['class_room']+"</td><tr/>");
          $("#"+schedule[i]['class_day']).attr('style', 'background-color:#EEEEEE');
        }
      }else {
        //alert('Load group schedule empty');
      }
    });
  }
}

function load_eval_steps(){
  $( "#container-steps-in-eval" ).load("{{ asset( 'html/home/steps_in_eval.php' ) }}", function(){
  });
}

function load_student_app(){
  $( "#container-student-app" ).load("{{ asset( 'html/home/student_app.php' ) }}", function(){
    $("#btn_dl_app").attr('href',"{{ route('get-app') }}");
    var android_pic = setInterval(function() {
      $("#android-pic").attr('src', "{{ asset('img/login.png') }}");
      android_pic = setTimeout(function() {
        $("#android-pic").attr('src', "{{ asset('img/loggedin.png') }}");
      },2000);
    },3000);
  });
}

function load_free_browsing(){
  $("#container-offline-webs").load("{{ asset('html/home/free_browsing.php') }}",function(){
    $("#w3s_link").attr('href',"http://10.10.10.10/offline/w3schools/W3School/www.w3schools.com/index.html");
    $("#tp_link").attr('href', "http://10.10.10.10/offline/tutorialspoint/Tutorialspoint/www.Tutorialspoint.com/index.html");
    $("#w3s").attr('src', "{{ asset('/img/wsh.png') }}");
    $("#tp").attr('src', "{{ asset('/img/tp.png') }}");
  });
}

function load_footer(){
  $( "#container-footer" ).load("{{ asset( 'html/home/footer.php' ) }}", function(){
  });
}

function login_form(){
  $( "#container" ).load("{{ asset( 'html/home/login.php' ) }}", function(){
    $(window).ready(function(){
      if ($(window).width() < 767) {
        $(".orig-login-div").removeAttr('id')
        $(".col-login-div").attr('id', "login-div");
      }
      else {
        $(".orig-login-div").attr('id', "login-div");
        $(".col-login-div").removeAttr('id');
      }
    });

    $("#btn_register").attr('href',"{{ route('register') }}");
    $("#lnk_forgot_pass").attr('href',"{{ route('forgot-pass') }}");
    $("#btn_dl_app_login").attr('href',"{{ route('get-app') }}");

    @if ($view_type === "login")
    $(document).ready(function() {
      //  $("#li_login").click();
      $("#login-form").click();
    });
    // route() na may required na get parameter
    //window.location.href = "{{ route('home',['type' => 'login']) }}" + "#login-section";
    @elseif ($view_type === "hello")
    // do nothing as is na
    @endif

    $("form").validate({
      rules: {
        username: {
          required: true,
          alphanumeric: true,
          minlength: 6
        },
        password: {
          required: true,
          minlength: 6
        },
      },
      messages: {
        username: {
          required: "Please enter your username.",
        },
        password: {
          required: "Please enter your password.",
        }
      },
    }); //end of validate */

    $( "#btn_signin" ).click(function(){
      var isValid = $("#frm_login").valid();
      if(isValid == true){
        var form_values = $("#frm_login").serializeObject();
        login_details(form_values);
      }else{
      }
    }); //end of btn click
    onKeyPress('#password','#btn_signin');
  });
}


function login_details(post_parameters){
  request = new Request();
  request.url = "{{ route('login-verify') }}";
  request.type = 'POST';
  request.data = post_parameters;
  request.replyType = 'json';
  // start
  request.begin = function(){
    btn_clicked_start("#btn_signin");
  }
  // success
  request.done = function(data, textStatus, xhr){
    //alert(data);
    btn_clicked_end("#btn_signin");
    onCheckAccountSuccess(data/*$.parseJSON(data)*/);
  }
  // failed
  request.fail = function(xhr, textStatus, errorThrown){
    //alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
    //alert("JQUERY TEXT STATUS: " + textStatus);
    //alert("ERROR DESCRIPTION: " + errorThrown);
    btn_clicked_end("#btn_signin");
    window.location = error_route + xhr.status;
  }
  // finished
  request.always = function(){
    // this will be called always whether fail or done at the end of this request
    btn_clicked_end("#btn_signin");
  }
  // send
  request.send(); // start the ajax request
}

function onCheckAccountSuccess(data){
  if(data['result'] == "existing"){
    $(document).ready(function() {
      window.location.href = "{{ route('profile') }}";
    });
  }else if(data['result'] == "wrong_pass"){
    show_result('#password-error-1','Please re-check your password.');
    hide_result('#password','#password-error-1');
  }else{
    show_result('#username-error-1','Please check, account does not exists');
    hide_result('#username','#username-error-1');
  }
}
</script>
