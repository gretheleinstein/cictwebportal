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
