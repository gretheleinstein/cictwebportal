<script type = "text/javascript">

var startup_popup;
var get_photo = "{{ route('get-photo','') }}/";

$(document).ready(function() {
  load_nav();
  //load_popups();
  student_profile();
  load_footer();
  request_profile_values();
});

function load_nav(){
  $("#container-nav").load("{{ asset('html/navbar/profile_nav.php') }}",function(){
      $(".loader").attr('style', 'display:none');
      load_side_nav_collapse();
      load_side_nav();
  });
}

function request_profile_values(){
    request = new Request();
    request.url = "{{ route('profile-get') }}";
    request.type = 'POST';
    request.replyType = 'json';
    // start
    request.begin = function(){
    }
    // success
    request.done = function(data, textStatus, xhr){
        //alert(data);
        load_profile_values(data);
    }
    // failed
    request.fail = function(xhr, textStatus, errorThrown){
      //  alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
      //  alert("JQUERY TEXT STATUS: " + textStatus);
      //  alert("ERROR DESCRIPTION: " + errorThrown);
        xhr_methods(xhr.readyState, xhr.status);
    }
    // finished
    request.always = function(){
        // this will be called always whether fail or done at the end of this request
    }
    // send
    request.send(); // start the ajax request
}

function load_profile_values(data){
  info = data['info'];
  if(info['has_profile']=="1"){
  $("#btn_history").unbind('click');
  $("#btn_sched").unbind('click');
  $("#btn_grade").unbind('click');
  $("#btn_linked").unbind('click');
  $("#btn_settings").unbind('click');
  $("#btn_help").unbind('click');

  $("#btn_history_sub").unbind('click');
  $("#btn_sched_sub").unbind('click');
  $("#btn_grade_sub").unbind('click');
  $("#btn_linked_sub").unbind('click');
  $("#btn_settings_sub").unbind('click');
  $("#btn_help_sub").unbind('click');

  $("#btn-logout").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    logout_request();
  });

  $("#btn_profile").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_profile('#container');
  });

  $("#btn_history").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_history();
  });

  $("#btn_sched").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_sched();
  });

  $("#btn_grade").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_grade();
  });

  $("#btn_linked").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_linked_account();
  });

  $("#btn_settings").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_settings();
  });

  $("#btn_help").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_help();
  });

  $("#btn_profile_sub").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_profile('#container');
  });

  $("#btn_history_sub").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_history();
  });

  $("#btn_sched_sub").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_sched();
  });

  $("#btn-logout_sub").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    logout_request();
  });

  $("#btn_grade_sub").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_grade();
  });

  $("#btn_linked_sub").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_linked_account();
  });

  $("#btn_settings_sub").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_settings();
  });

  $("#btn_help_sub").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    loader('#container');
    student_help();
  });

}else{
  $("#btn-logout").click(function(event) {
    clearTimeout(startup_popup);clearInterval(mymy);
    logout_request();
  });

  $("#btn_profile").click(function(event) {
    clearTimeout(startup_popup);
    loader('#container');
    student_profile('#container');
    $("#divMessageBox").remove();
  });

  $("#btn_grade").click(function(event) {
    clear_notify();
  });

  $("#btn_linked").click(function(event) {
    clear_notify();
  });

  $("#btn_settings").click(function(event) {
    clear_notify();
  });

  $("#btn_help").click(function(event) {
    clear_notify();
  });

  $("#btn-logout_sub").click(function(event) {
    clearTimeout(startup_popup);
    logout_request();
  });

  $("#btn_profile_sub").click(function(event) {
    clearTimeout(startup_popup);
    loader('#container');
    student_profile('#container');
    $("#divMessageBox").remove();
  });

  $("#btn_grade_sub").click(function(event) {
    clear_notify();
  });

  $("#btn_linked_sub").click(function(event) {
    clear_notify();
  });

  $("#btn_settings_sub").click(function(event) {
    clear_notify();
  });

  $("#btn_help_sub").click(function(event) {
    clear_notify();
  });
}

  $("#nav_collapse_sm li").click(function(event) {
        $(".navbar-toggle").click();
    });
}

function clear_notify(){
  clearTimeout(startup_popup);
  notify('Hi There! New here right?','Please complete your student profile to proceed.');
}

function load_side_nav_collapse(){
    $("#linked_logo_sub").attr('src',"{{ asset('img/linked.png') }}");
    side_nav_collapse_request_values();
        //side nav options
}

function load_side_nav(){
  $("#container-side-nav").load("{{ asset('html/navbar/profile_side_nav.php') }}",function(){
    $("#linked_logo").attr('src',"{{ asset('img/linked.png') }}");
    $("#monosync_logo").attr('src',"{{ asset('img/monosync_logo.jpg') }}");
    side_nav_request_values();
        //side nav options
    });
}

function load_popups(){
  startup_popup = setTimeout(function() {
    $("#container").load("{{ asset('html/profile/tip/tip_one.php') }}",function(){
      $("#container").hide().fadeIn("slow");
        startup_popup = setTimeout(function() {
        $("#container").load("{{ asset('html/profile/tip/tip_two.php') }}",function(){});
        $("#container").hide().fadeIn("slow");
      },5000) ;
    });
  },0);
}

function load_footer(){
  $("#footer-nav").load("{{ asset('html/footer/profile_footer.php') }}",function(){
    $("#footer-nav").hide().fadeIn("slow");
      $("#monosync_logo_footer").attr('src', "{{ asset('img/monosync_logo.jpg') }}");
  });
}
function student_help(){
  $("#container").load("{{ asset('html/profile/student_help.php') }}",function(){
      $(".loader").attr('style', 'display:none');
  });
}

//---------------------------------------------------------------------------------------------------------
//-------------------------------------------REQUEST VALUES------------------------------------------------
/*when requesting existing profile values in the db*/
function side_nav_collapse_request_values(){
  // settings
  request = new Request();
  request.url = "{{ route('profile-get') }}";
  request.type = 'POST';
  request.replyType = 'json';
  // start
  request.begin = function(){
  }
  // success
  request.done = function(data, textStatus, xhr){
      //alert(data);
      //alert("3");
      side_nav_collapse_load_values(data);
  }
  // failed
  request.fail = function(xhr, textStatus, errorThrown){
    //  alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
    //  alert("JQUERY TEXT STATUS: " + textStatus);
    //  alert("ERROR DESCRIPTION: " + errorThrown);
      xhr_methods(xhr.readyState, xhr.status);
  }
  // finished
  request.always = function(){
      // this will be called always whether fail or done at the end of this request
  }
  // send
  request.send(); // start the ajax request
}
function side_nav_request_values(){
  // settings
  request = new Request();
  request.url = "{{ route('profile-get') }}";
  request.type = 'POST';
  request.replyType = 'json';
  // start
  request.begin = function(){
  }
  // success
  request.done = function(data, textStatus, xhr){
    //  alert(JSON.stringify(data));
  //  alert("2");
      side_nav_load_values(data);
  }
  // failed
  request.fail = function(xhr, textStatus, errorThrown){
    //  alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
    //  alert("JQUERY TEXT STATUS: " + textStatus);
    //  alert("ERROR DESCRIPTION: " + errorThrown);
      xhr_methods(xhr.readyState, xhr.status);
  }
  // finished
  request.always = function(){
      // this will be called always whether fail or done at the end of this request
  }
  // send
  request.send(); // start the ajax request
}

function request_values(){
  request = new Request();
  request.url = "{{ route('profile-get') }}";
  request.type = 'POST';
  request.replyType = 'json';
  // start
  request.begin = function(){
  }
  // success
  request.done = function(data, textStatus, xhr){
      //alert(data);
      //alert("1");
      load_values(data);
  }
  // failed
  request.fail = function(xhr, textStatus, errorThrown){
    //  alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
    //  alert("JQUERY TEXT STATUS: " + textStatus);
    //  alert("ERROR DESCRIPTION: " + errorThrown);
      xhr_methods(xhr.readyState, xhr.status);
  }
  // finished
  request.always = function(){
      // this will be called always whether fail or done at the end of this request
  }
  // send
  request.send(); // start the ajax request
}
//---------------------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------------------
//-------------------------------------------LOAD VALUES---------------------------------------------------

var newImg1 = document.createElement("img");
function side_nav_collapse_load_values(data){
  // can use multi dimensional literals data['profile']['mobile']
  // or save it first to a variable
  info = data['info'];
  profile = data['profile'];

  $("#side-bar-name_sub").html(info['first_name'] +" "+info['last_name']);
    load_display_picture_sub("#profile-pic_sub");
  $("#side-bar-id_sub").html("STUDENT ID: " + info['id']);
}

function load_display_picture_sub(id){
  $(id).attr('src',"{{ asset('img/load-2.gif') }}");
  var _img = $(id);
  newImg1.id = "profile-pic_sub";
  newImg1.src = get_photo+profile['profile_picture'];
  newImg1.className = 'img-responsive img-circle text-center';
  newImg1.style.border="1px solid #EEEEEE;";
  newImg1.width="100";
  newImg1.height="100";
}

function onload_display_picture_sub(id){
  if(newImg1.src.includes("NONE")){
    newImg1.src = 'img/img.png';
  }else{
  //  alert("3-1 - collapse");
    var _img = $(id);
    _img.src = newImg1.src;
  }
  $("#"+id).replaceWith(newImg1);
  //alert("3-2 - end collapse");
}

var newImg2 = document.createElement("img");
function side_nav_load_values(data){
  // can use multi dimensional literals data['profile']['mobile']
  // or save it first to a variable
  info = data['info'];
  profile = data['profile'];

  $("#side-bar-name").html(info['first_name'] +" "+info['last_name']);
  load_display_picture("#profile-pic_img");
  $("#side-bar-id").html("STUDENT ID: " + info['id']);
}

function load_display_picture(id){
  $(id).attr('src',"{{ asset('img/load-2.gif') }}");
  var _img = $(id);
  newImg2.id = "profile-pic_img";
  newImg2.src = get_photo+profile['profile_picture'];
  newImg2.className = 'img-responsive img-circle text-center';
  newImg2.style.border="1px solid #EEEEEE;";
  newImg2.width="100";
  newImg2.height="100";
}

function onload_display_picture(id){
  if(newImg2.src.includes("NONE")){
    newImg2.src = 'img/img.png';
  }else{
  //  alert("2-1 side");
    var _img = $(id);
    _img.src = newImg2.src;
  }
  $("#"+id).replaceWith(newImg2);
//  alert("2-2 end side");
}

var newImg3 = document.createElement("img");
function load_values(data){
  info = data['info'];
  if('curriculum' in data){
    curriculum = data['curriculum'];
    $("#curriculum").val(curriculum['name']);
  }else{
    $("#curriculum").val("---");
  }
  $("#first_name").val(info['first_name']);
  $("#last_name").val(info['last_name']);
  $("#middle_name").val(info['middle_name']);
  $("#stud-id").val(info['id']);
  if((info['year_level']!=null) && (info['section']!=null) && (info['_group']!=null)){
    $("#year-sec-gr").val(info['year_level']+info['section']+"-G"+info['_group']);
  }else {
    $("#year-sec-gr").val("---");
  }
  if(info['gender']!= null){
    $("#"+info['gender']+"").attr("checked", "checked");
    $("."+info['gender']+"").addClass('active');
  }
  if(info['admission_year'] == 'NOT_SET'){
    $("#admission-year").val('---');
  }else{
    $("#admission-year").val(info['admission_year']);
  }

  profile = data['profile'];
    update_profile_picture("#display-pic");
  $("#contact_no").val(data['profile']['mobile']);
  $("#email").val(profile['email']);
  $("#house_no").val(profile['house_no']);
  $("#street").val(profile['street']);
  $("#zipcode").val(profile['zipcode']);
  $("#brgy").val(profile['brgy']);
  $("#city").val(profile['city']);
  $("#province").val(profile['province']);
  $("#ice_name").val(profile['ice_name']);
  $("#ice_contact").val(profile['ice_contact']);
  $("#ice_address").val(profile['ice_address']);
}

function update_profile_picture(id){
    $(id).attr('src',"{{ asset('img/load-2.gif') }}");
//    $("#btn_change_pic").prop('disabled', true);
    newImg3.id = "display-pic";
    newImg3.src = get_photo+profile['profile_picture'];
    newImg3.className = 'img-responsive img-thumbnail';
    newImg3.width="150";
    newImg3.height="150";
  //  newImg.onload = huhu;
}

function onload_profile_photo(id){
      if(newImg3.src.includes("NONE")){
        newImg3.src = 'img/img.png';
      }else{
      //  alert("1-1");
        var _img = $(id);
        _img.src = newImg3.src;
      }
      $("#"+id).replaceWith(newImg3);
      $("#btn_change_pic").prop('disabled', false);
      //alert("1-2");
}
//---------------------------------------------------------------------------------------------------------


//---------------------------------------------------------------------------------------------------------
//-------------------------------------------LOG OUT------------------------------------------------------
function logout_request(){
  $.post("{{ route('profile-logout') }}")
  .done(function(data){
    window.location.href = "{{ route('home','hello') }}";
  })
  .fail(function(data){
  });
}
//---------------------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------------------
//-----------------------------------------STUDENT PROFILE-------------------------------------------------
function student_profile(){
  $( "#container" ).load("{{ asset( 'html/profile/student_profile.php' ) }}", function(){
    $( "#container" ).hide().fadeIn("slow");
    load_upload();
    request_values();
    $("#preview").attr('src',"{{ asset('img/no_image.png') }}");
    $("#btn_view_pdf").attr('href',"{{ route('pdf-view', ['id'=>session('SES_CICT_ID')]) }}");

    /* frm_student_profile validation rules on saving a profile */
    $("#frm_student_profile").validate({
      rules: {
        gender:{
          required: true
        },
        house_no: {
          required: true,
          maxlength: 10,
          digits: true
        },
        street: {
          required: true,
          maxlength: 25
        },
        zipcode: {
          required: true,
          digits: true,
          maxlength: 10
        },
        city: {
          required: true,
          maxlength: 25
        },
        brgy: {
          required: true,
          maxlength: 25
        },
        province: {
          required: true,
          maxlength: 25
        },
        email: {
          required: true,
          email: true,
          maxlength: 40
        },
        contact_no: {
          required: true,
          digits: true,
          minlength: 11,
          maxlength: 11
        },
        ice_name: {
          required: true,
          letterswithbasicpunc: true,
          maxlength: 60
        },
        ice_address: {
          required: true,
          maxlength: 100
        },
        ice_contact: {
          required: true,
          digits: true,
          minlength: 11,
          maxlength: 11
        },
      },
      errorPlacement: function(error, element) {
      if (element.attr("name") == "gender") {
         error.insertAfter("#radio_gender");
      } else {
         error.insertAfter(element);
      }
    },
  }); //end of validate *///
    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------

    $( "#btn_save" ).click(function(){
      var isValid = $("#frm_student_profile").valid(); // check if form is valid
      if(isValid == true){
        var form_values =  $("#frm_student_profile").serializeObject(); // serialize the form\
        update_profile(form_values); // pass the values as post parameters
      }else{
        notify("Oops. You missed something.","Please complete all fields to save changes to your profile.");
      }
    }); //end of btn click
    onKeyPress('#ice_address','#btn_save');
  });// on_load end methods
}

function update_profile(post_parameters){
  request = new Request();
  request.url = "{{ route('profile-update') }}";
  request.type = 'POST';
  request.data = post_parameters;
  request.replyType = 'json';
  // start
  request.begin = function(){
    btn_clicked_start("#btn_save");
  }
  // success
  request.done = function(data, textStatus, xhr){
      //alert(data);
      btn_clicked_end("#btn_save");
      onUpdateProfileSuccess(data/*$.parseJSON(data)*/);
  }
  // failed
  request.fail = function(xhr, textStatus, errorThrown){
      //alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
      //alert("JQUERY TEXT STATUS: " + textStatus);
      //alert("ERROR DESCRIPTION: " + errorThrown);
      btn_clicked_end("#btn_save");
      xhr_methods(xhr.readyState, xhr.status);
  }
  // finished
  request.always = function(){
      // this will be called always whether fail or done at the end of this request
     btn_clicked_end("#btn_save");
  }
  // send
  request.send(); // start the ajax request
}

function onUpdateProfileSuccess(data){
  show_buttons('#btn_save');
  if(data['result'] == "saved"){
    show_notif('.alert-info',"Saved Changes");
    // reload values after changes
    request_values();
    request_profile_values();
  }else{
  }
}
//---------------------------------------------------------------------------------------------------------


//---------------------------------------------------------------------------------------------------------
//-------------------------------------STUDENT SETTINGS----------------------------------------------------
 function student_settings(){
  $( "#container" ).load("{{ asset( 'html/profile/student_settings.php' ) }}", function(){
    $( "#container" ).hide().fadeIn("slow");
        $("#frm_change_flr_ass").validate({
          rules: {
            floor_assignment: {
              required: true
            },
          },
        }); //end of validate

        $("#btn_save_flr").click(function(){
          var isValid = $("#frm_change_flr_ass").valid();
          if(isValid == true){
          var form_values = $("#frm_change_flr_ass").serializeObject();
          update_floor_assignment(form_values);
          }else{
          }
        }); //end of btn click
        onKeyPress('#floor_assignment','#btn_save_flr');

        $("#frm_change_password").validate({
          rules: {
            old_password: {
              required: true,
              minlength: 6
            },
            new_password: {
              required: true,
              minlength: 6
            },
            confirm_new_password: {
              required: true,
              minlength: 6,
              equalTo: "#new_password"
            },
          },
          messages: {
            confirm_new_password: {
              equalTo: "Please enter your correct new password again.",
            }
          }
        }); //end of validate

        $("#btn_save").click(function(){
          var isValid = $("#frm_change_password").valid();
          if(isValid == true){
          var form_values = $("#frm_change_password").serializeObject();
          update_password(form_values);
          }else{
          }
        }); //end of btn click
        onKeyPress('#confirm_new_password','#btn_save');
    });
  }

  function update_floor_assignment(post_parameters){
    request = new Request();
    request.url = "{{ route('settings-change-flr') }}";
    request.type = 'POST';
    request.data = post_parameters;
    request.replyType = 'json';
    // start
    request.begin = function(){
      btn_clicked_start("#btn_save_flr");
    }
    // success
    request.done = function(data, textStatus, xhr){
        //alert(data);
        btn_clicked_end("#btn_save_flr");
        onUpdateFlrSuccess(data/*$.parseJSON(data)*/);
    }
    // failed
    request.fail = function(xhr, textStatus, errorThrown){
        //alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
        //alert("JQUERY TEXT STATUS: " + textStatus);
        //alert("ERROR DESCRIPTION: " + errorThrown);
        btn_clicked_end("#btn_save_flr");
        xhr_methods(xhr.readyState, xhr.status);
    }
    // finished
    request.always = function(){
        // this will be called always whether fail or done at the end of this request
       btn_clicked_end("#btn_save_flr");
    }
    // send
    request.send(); // start the ajax request
  }

  function onUpdateFlrSuccess(data){
    if(data['result']=="saved"){
      show_notif('.alert-flr',"Room successfully changed");
    }else{
      alert("failed");
    }
  }

  function update_password(post_parameters){
    request = new Request();
    request.url = "{{ route('settings-pass-reset') }}";
    request.type = 'POST';
    request.data = post_parameters;
    request.replyType = 'json';
    // start
    request.begin = function(){
      btn_clicked_start("#btn_save");
    }
    // success
    request.done = function(data, textStatus, xhr){
        //alert(data);
        btn_clicked_end("#btn_save");
        onUpdateSuccess(data/*$.parseJSON(data)*/);
    }
    // failed
    request.fail = function(xhr, textStatus, errorThrown){
        //alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
        //alert("JQUERY TEXT STATUS: " + textStatus);
        //alert("ERROR DESCRIPTION: " + errorThrown);
        btn_clicked_end("#btn_save");
        xhr_methods(xhr.readyState, xhr.status);
    }
    // finished
    request.always = function(){
        // this will be called always whether fail or done at the end of this request
       btn_clicked_end("#btn_save");
    }
    // send
    request.send(); // start the ajax request
  }

  function onUpdateSuccess(data){
    if(data['result']=="saved"){
      show_notif('.alert-pass',"Password successfully changed");
    }else if(data['result']=="wrong_pass"){
      show_notif('#old-password-error-1',"Old password incorrect");
      hide_result('#old_password','#old-password-error-1');
    }else{
      alert("failed");
    }
  }
//---------------------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------------------
//-------------------------------------STUDENT GRADE-------------------------------------------------------
  function student_grade(){
  // $( "#container" ).load("{{ asset( 'html/profile/student_grade.php' ) }}", function(){
  //   $( "#container" ).hide();
     request_table();
//     });
   }

   function request_table(){
     // settings
     request = new Request();
     request.url = "{{ route('grade-get') }}";
     request.type = 'GET';
     request.replyType = 'json';
     // start
     request.begin = function(){
     }
     // success
     request.done = function(data, textStatus, xhr){
         //alert(data);
         load_grades(data);
     }
     // failed
     request.fail = function(xhr, textStatus, errorThrown){
       //  alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
       //  alert("JQUERY TEXT STATUS: " + textStatus);
       //  alert("ERROR DESCRIPTION: " + errorThrown);
         xhr_methods(xhr.readyState, xhr.status);
     }
     // finished
     request.always = function(){
         // this will be called always whether fail or done at the end of this request
     }
     // send
     request.send(); // start the ajax request
}// end of function

  function clicked(id){
  //  $("#"+id+"").append("<span class='glyphicon glyphicon-remove-circle pull-right'></span>");
    var div = id.replace('term','div');
    $("#"+div+"").toggle("slideDown");
  }

  function load_grades(data){
    $("#container").html('<div class="row white-bg" style="padding: 3%;"><div id="div_grade"></div></div>')
    if(Array.isArray(data)){ //checks if json_request is an array
    $.each(data,function(key,value){
      var a=1;
      for(var i=0; i<=2; i+=2){  // 0,2 sem
      var e = i+1;
      var year_word = change_to_words(value[i][0]['cur']['year']);
      var sem_word = change_to_words(value[i][0]['cur']['semester']);
    //  if(json_request.hasOwnProperty('cur')){ //checks if curriculum subjects exists
     $("#div_grade").append("<div onclick='clicked(this.id)' style='color:#808D8E; font-weight:bolder; cursor:pointer' id=term_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']+"><span class='glyphicon glyphicon-calendar' style='font-size: 10pt; font-weight:lighter; color:#808D8E'></span> "+year_word+" Year "+sem_word+" Semester"+"</div><hr>");
    //  $("#div_grade").append("<div onclick='clicked(this.id)' class='btn' id=term_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']+" "+"style='cursor:pointer'>YEAR: "+value[i][0]['cur']['year']+" SEM: "+value[i][0]['cur']['semester']+"</div><hr>");
      $("#div_grade").append("<div class='table-responsive' id=div_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']+" "+"style='display:none;'></div>"); //div creation
      $("#div_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']).append('<table id=table_'+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']+' class="table table-striped table-responsive table-bordered" cellspacing="0" style="padding: 5%" width="100%">');
      $("#table_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']).append("<tbody><tr style='background-color: #1A4D57;'> <th>Code</th><th>Descriptive Title</th><th>Grade</th><th>Units</th><th>Remarks</th> </tr>");
          var gwa = 0.0; var subj_count = 0; var units_passed = 0; var units = 0;
          if(typeof value[a]['count'] === 'undefined'){
            $("#div_grade").append("<tr> <td> index error </td> </tr>");
          }else{
              for (var j = 0; j < value[a]['count']; j++) {
                if(typeof value[i][j]['cur']['id'] === 'undefined'){
                    $("#div_grade").append("<tr> <td> index error </td>");
                  }
                else{
                  if(value[i][j]['grade'] != null){
                    if(isNaN(value[i][j]['grade']['rating'])){
                    }else{
                      subj_count += 1; units_passed += parseFloat(value[i][j]['grade']['credit']);
                      gwa += parseFloat(value[i][j]['grade']['rating']);
                    }
                     units += parseFloat(value[i][j]['grade']['credit']);
                    $("#table_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']).append("<tr> <td>"+value[i][j]['subject']['code']+"</td>"+ "<td>"+value[i][j]['subject']['descriptive_title']+"</td>" +"<td>"+value[i][j]['grade']['rating']+"</td>"+"<td>"+value[i][j]['grade']['credit']+"</td>"+"<td>"+value[i][j]['grade']['remarks']+"</td>"+"</tr>");
                  }else{
                    //UNPOSTED GRADE
                    $("#table_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']).append("<tr> <td>"+value[i][j]['subject']['code']+"</td>"+ "<td>"+value[i][j]['subject']['descriptive_title']+"</td> <td></td><td></td><td></td></tr>");
                  }
                }
              } //end of for loop cur id
               gwa = gwa/subj_count;
               gwa = gwa.toFixed(5);
               $("#table_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']).append("<tr> <td></td><td></td><td>GWA : "+gwa+"<br/><sub>Gen. Weighted Average</sub></td><td>UNITS : "+units+"<br/><sub>Unit Enrolled</sub></th><td>EARNED: "+units_passed+"<br/><sub>Unit(s) Earned</sub></td></tr>");
          } //else of count index error
  //      }else{
  //        $("#div_grade").append("semester subjects for this curriculum is incomplete-> shows as the numbers of semester in a curriculum<br/>");
  //      }
        a+=2;
        $("#div_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']).append('</tbody></table>');
      }//end of for loop sem
    });// each
  }else{
      $("#div_grade").append("<div class='text-center'><h3><span class='glyphicon glyphicon-info-sign'></span> Curriculum not available</h3>Please complete all procedures to view your grades.</div>");
  }
  }
//--------------------------------------------------------------------------------------------------------


//---------------------------------------------------------------------------------------------------------

//---------------------------------------------------------------------------------------------------------
//-------------------------------------STUDENT CURRICULUM-------------------------------------------------------
  function student_curriculum(){
   $( "#container" ).load("{{ asset( 'html/profile/student_curriculum.php' ) }}", function(){
     $( "#container" ).hide();
     $("#bulsu_logo").attr('src', "{{ asset('img/logo/BULSU_LOGO.png' )}}");
     $("#cict_logo").attr('src', "{{ asset('img/logo/CICT_LOGO.png' )}}");
     request_curriculum_table();
     });
   }

   function request_curriculum_table(){
     // settings
     request = new Request();
     request.url = "{{ route('grade-get') }}";
     request.type = 'GET';
     request.replyType = 'json';
     // start
     request.begin = function(){
     }
     // success
     request.done = function(data, textStatus, xhr){
         //alert(data);
         if(Array.isArray(data)){ //checks if json_request is an array
         $.each(data,function(key,value){
           var a=1;
           for(var i=0; i<=2; i+=2){  // 0,2 sem
           var e = i+1;
           var year_word = change_to_words(value[i][0]['cur']['year']);
           var sem_word = change_to_words(value[i][0]['cur']['semester']);
         //  if(json_request.hasOwnProperty('cur')){ //checks if curriculum subjects exists
          $("#div_grade").append("<div onclick='clicked(this.id)' style='color:#808D8E; cursor:pointer' id=term_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']+"><span class='glyphicon glyphicon-book' style='color:#808D8E'></span> "+year_word+" Year "+sem_word+" Semester"+"</div><hr>");
         //  $("#div_grade").append("<div onclick='clicked(this.id)' class='btn' id=term_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']+" "+"style='cursor:pointer'>YEAR: "+value[i][0]['cur']['year']+" SEM: "+value[i][0]['cur']['semester']+"</div><hr>");
           $("#div_grade").append("<div class='table-responsive' id=div_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']+" "+"style='display:none;'></div>"); //div creation
           $("#div_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']).append('<table id=table_'+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']+' class="table table-striped table-responsive table-bordered" cellspacing="0" style="padding: 5%" width="100%">');
           $("#table_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']).append("<tbody><tr style='background-color: #1A4D57;'> <th>Code</th><th>Descriptive Title</th><th>Grade</th><th>Units</th><th>Remarks</th> </tr>");
               if(typeof value[a]['count'] === 'undefined'){
                 $("#div_grade").append("<tr> <td> index error </td> </tr>");
               }else{
                   for (var j = 0; j < value[a]['count']; j++) {
                     if(typeof value[i][j]['cur']['id'] === 'undefined'){
                         $("#div_grade").append("<tr> <td> index error </td>");
                       }
                     else{
                       if(value[i][j]['grade'] != null){
                         $("#table_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']).append("<tr> <td>"+value[i][j]['subject']['code']+"</td>"+ "<td> Title: "+value[i][j]['subject']['descriptive_title']+"</td>" +"<td>"+value[i][j]['grade']['rating']+"</td>"+"<td>"+value[i][j]['grade']['credit']+"</td>"+"<td>"+value[i][j]['grade']['remarks']+"</td>"+"</tr>");
                       }else{
                         //UNPOSTED GRADE
                         $("#table_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']).append("<tr> <td>"+value[i][j]['subject']['code']+"</td>"+ "<td> Title: "+value[i][j]['subject']['descriptive_title']+"</td> <td></td><td></td><td></td></tr>");
                       }
                     }
                   } //end of for loop cur id
               } //else of count index error
       //      }else{
       //        $("#div_grade").append("semester subjects for this curriculum is incomplete-> shows as the numbers of semester in a curriculum<br/>");
       //      }
             a+=2;
             $("#div_"+value[i][0]['cur']['year']+"_"+value[i][0]['cur']['semester']).append('</tbody></table>');
           }//end of for loop sem
         });// each
       }else{
         $("#div_curriculum").append("<div class='text-center'><h3><span class='glyphicon glyphicon-info-sign'></span> Curriculum not available</h3>Please complete all procedures to view your Curriculum.</div>");
       }
     }
     // failed
     request.fail = function(xhr, textStatus, errorThrown){
       //  alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
       //  alert("JQUERY TEXT STATUS: " + textStatus);
       //  alert("ERROR DESCRIPTION: " + errorThrown);
         xhr_methods(xhr.readyState, xhr.status);
     }
     // finished
     request.always = function(){
         // this will be called always whether fail or done at the end of this request
         $( "#container" ).hide().fadeIn("slow");
     }
     // send
     request.send(); // start the ajax request
}// end of function

  function clicked(id){
  //  $("#"+id+"").append("<span class='glyphicon glyphicon-remove-circle pull-right'></span>");
    var div = id.replace('term','div');
    $("#"+div+"").toggle("slideDown");
  }
//--------------------------------------------------------------------------------------------------------

function load_upload(){
  var filename;
    $("#modal").dialog({
    autoOpen: false,
    modal: true,
    resizable: false,
    width: 300,
    dialogClass: 'modal_class fadeIn animated',
    buttons: [
    {
        text: 'Cancel',
        style: "background-color:#1A4D57; color: white",
        click: function() {
            $(this).dialog("close");
        }
    },
  ],
  });

  $( "#btn_change_pic" ).click(function() {
    $('#modal').dialog('open');
  });

  $("#image-file").change(function(event) {
    $("#image-upload").prop('disabled', false);
    $("#upload_message").html("");
    var file = this.files[0];
    var imagefile = file.type;
    var match= ["image/jpeg","image/png","image/jpg"];
    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
    {
      $("#image-upload").prop('disabled', true);
      $("#upload_message").html("<span class='glyphicon glyphicon-picture'></span> <span class='fadeIn animated'>Please select a valid Image File. Only jpeg, jpg and png image's type are allowed</span><hr>");
      return false;
    }else{
      var reader = new FileReader();
      reader.onload = imageIsLoaded;
      reader.readAsDataURL(this.files[0]);
      }
    });

    function imageIsLoaded(e) {
      filename = e.target.result;
      $('#preview').attr('src', e.target.result);
      $('#preview').attr('width', '250px');
      $('#preview').attr('height', '250px');
    };

   $("#image-upload").click(function(event) {
     start_ajax();
     return false;
  });
}// end of function

function start_ajax(){
  request = new Request();
  request.processData = false;
  request.contentType = false;
  request.url = "{{ route('upload-photo') }}";
  request.type = 'POST';
  request.data = new FormData($("#form_upload")[0]),
  request.replyType = 'json';
  // start
  request.begin = function(){
    btn_clicked_start("#image-upload");
  }
  // success
  request.done = function(data, textStatus, xhr){
     //alert(JSON.stringify(data));
    if(data['result'] == "file_not_recieved"){
      $("#upload_message").html("<span class='glyphicon glyphicon-picture'></span> <span class='fadeIn animated'>File not found! Please try again.</span><hr>");
    }else if (data['result'] == "file_not_valid"){
      $("#upload_message").html("<span class='glyphicon glyphicon-picture'></span> <span class='fadeIn animated'>File too large. The maximum file size allowed is 512 KB only.</span><hr>");
    }else{
      reload_display_photo();
      window.location.reload()
    }
    btn_clicked_end("#image-upload");
  }
  // failed
  request.fail = function(xhr, textStatus, errorThrown){
      //alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
      //alert("JQUERY TEXT STATUS: " + textStatus);
      //alert("ERROR DESCRIPTION: " + errorThrown);
      xhr_methods(xhr.readyState, xhr.status);
  }
  // finished
  request.always = function(){
      // this will be called always whether fail or done at the end of this request
     btn_clicked_end("#image-upload");
     return false;
  }
  // send
  request.send(); // start the ajax request
}

function reload_display_photo(){
  $("#modal").dialog("close");
  side_nav_collapse_request_values();
  side_nav_request_values();
  request_values();
//  $("#btn_change_pic").prop('disabled', false);
onload_profile_photo("display-pic");
}

//---------------------------------------------------------------------------------------------------------
//-------------------------------STUDENT LINKED ACCOUNT----------------------------------------------------

var mymy
function student_linked_account(){
//  $("#container").load("{{ asset('html/profile/student_linked_account.php') }}", function(){
//    $( "#container" ).hide().fadeIn("slow");
     request_qrcode();
     mymy = setInterval(function() {
     request_linked_acc_info();
     },3000);
//  });
}

var qr_code;
var qr_id;
var qr_name;
var qr_cur;
var qr_gender;

function request_qrcode(){
    request = new Request();
    request.url = "{{ route('profile-get') }}";
    request.type = 'POST';
    request.replyType = 'json';
    // start
    request.begin = function(){
    }
    // success
    request.done = function(data, textStatus, xhr){
        //alert(data);
        //load_qrcode(data);
        info = data['info'];
        curriculum = data['curriculum'];
        term = data['current_term'];
        qr_code = info['id']+'_'+info['cict_id']+'_'+term['id']
        qr_id = info['id']
        qr_name = info['first_name']+" "+info['middle_name']+" "+info['last_name']
        qr_cur = curriculum['description']
        qr_gender = info['gender']
    }
    // failed
    request.fail = function(xhr, textStatus, errorThrown){
      //  alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
      //  alert("JQUERY TEXT STATUS: " + textStatus);
      //  alert("ERROR DESCRIPTION: " + errorThrown);
        xhr_methods(xhr.readyState, xhr.status);
    }
    // finished
    request.always = function(){
        // this will be called always whether fail or done at the end of this request
    }
    // send
    request.send(); // start the ajax request
}

function load_qrcode(data){
//  alert(info['id']+'_'+info['cict_id']+'_'+term['id']);
  $("#div_linked").append('<h4>Reference Code</h4><img id="qrcode" style = "height: 200px; width: 200px; border: 1px solid #EEEEEE" src=""><hr/>');
  $("#qrcode").attr('src',"qrclient/qrclient.php?content=LINKED_NONE_"+qr_code);
  $("#div_linked").append("<p>STUDENT ID: "+qr_id+"</p>");
  $("#div_linked").append("<p>NAME: "+qr_name+"</p><hr/>");
  $("#div_linked").append("<div id='div_linked_sub' class='col-lg-8 col-lg-offset-2 text-left'></div>");
  $("#div_linked_sub").append("<p><span class='glyphicon glyphicon-education'></span> CURRICULUM: "+ qr_cur+"</p>");
  $("#div_linked_sub").append("<p><span class='glyphicon glyphicon-user'></span> GENDER: "+ qr_gender+"</p>");
  $("#div_linked_sub").append("<p><span class='glyphicon glyphicon-phone'></span> IMEI: None</p><hr/>");
}

function request_linked_acc_info(){
  //alert('jiji');
    request = new Request();
    request.url = "{{ route('check-number', ['cict_id'=>session('SES_CICT_ID')]) }}";
    request.type = 'GET';
    request.replyType = 'json';
    // start
    request.begin = function(){
    }
    // success
    request.done = function(data, textStatus, xhr){
  //      alert(JSON.stringify(data));
        load_linked_acc_info(data);
    }
    // failed
    request.fail = function(xhr, textStatus, errorThrown){
      //  alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
      //  alert("JQUERY TEXT STATUS: " + textStatus);
      //  alert("ERROR DESCRIPTION: " + errorThrown);
        xhr_methods(xhr.readyState, xhr.status);
    }
    // finished
    request.always = function(){
        // this will be called always whether fail or done at the end of this request
    }
    // send
    request.send(); // start the ajax request
}

function load_linked_acc_info(data){
  $("#container").html('');
  $("#container").html('<div class="row white-bg text-center" style="padding: 3%;"><div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3" id="div_linked" style="font-weight: bold; font-size: 9pt"><div class="txt-white" style="display:none; background-color: #1A4D57;padding:5%; border-bottom: 5px solid #BDC3C7;"></div></div></div>');
  reference = data['reference'];
  pila_info = data['pila_info'];
  linked_settings = data['settings'];
//  alert(data['pila_status']);
  if(data['pila_status'] == "yes"){
    $("#div_linked").append('<h6>Currently Serving:</h6>');
    $("#div_linked").append(data['called']);
    $("#div_linked").append("<div id='div_linked_sub' class='col-lg-8 col-lg-offset-2 text-left'></div>");
    $("#div_linked_sub").append('<hr/><h6>Reference Details</h6>');
    $("#div_linked_sub").append("<p>&nbsp;&nbsp;<span class='glyphicon glyphicon-menu-hamburger'></span> Reference No. # "+reference['id']+"</p>");
    $("#div_linked_sub").append("<p>&nbsp;&nbsp;<span class='glyphicon glyphicon-blackboard'></span> Room assignment "+linked_settings['floor_'+pila_info['floor_assignment']+'_name']+"</p>");
    $("#div_linked_sub").append("<p>&nbsp;&nbsp;<span class='glyphicon glyphicon-calendar'></span> Accepted "+ new Date(pila_info['request_accepted']).toLocaleString() +"</p>");
    var var_request_called;
    if(pila_info['request_called'] == null){ var_request_called="UNCALLED"; }else{ var_request_called = pila_info['request_called']}
    $("#div_linked_sub").append("<p>&nbsp;&nbsp;<span class='glyphicon glyphicon-bullhorn'></span> Called "+var_request_called+"</p>");
    var var_request_validity;
    if(pila_info['request_validity'] == null){ var_request_validity="VALID"; }else{ var_request_validity = new Date(pila_info['request_validity']).toLocaleString()}
    $("#div_linked_sub").append("<p>&nbsp;&nbsp;<span class='glyphicon glyphicon-warning-sign'></span> Expiration "+var_request_validity+"</p><hr/>");
    $("#div_linked_sub").append("<p>&nbsp;&nbsp;<span class='glyphicon glyphicon-warning-bullhorn'></span> Announcement</p><p> The lazy fox jumps over. mehehehe</p>");
  }else {
    load_qrcode();
  }
}

//---------------------------------------------------------------------------------------------------------
//-------------------------------------STUDENT SCHED-------------------------------------------------------
function student_sched(){
 $( "#container" ).load("{{ asset( 'html/profile/student_sched.php' ) }}", function(){
   request_sched();
   $("#bulsu_logo").attr('src', "{{ asset( 'img/logo/BULSU_LOGO.png' ) }}");
   $("#cict_logo").attr('src', "{{ asset( 'img/logo/CICT_LOGO.png' ) }}");
   });
 }

 function request_sched(){
   // settings
   request = new Request();
   request.url = "{{ route('sched-get') }}";
   request.type = 'GET';
   request.replyType = 'json';
   // start
   request.begin = function(){
    // alert("start");
   }
   // success
   request.done = function(data, textStatus, xhr){
    //   alert(JSON.stringify(data));
    //   load_sched(data);
       load_table_sched(data);
   }
   // failed
   request.fail = function(xhr, textStatus, errorThrown){
     //  alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
     //  alert("JQUERY TEXT STATUS: " + textStatus);
     //  alert("ERROR DESCRIPTION: " + errorThrown);
       xhr_methods(xhr.readyState, xhr.status);
   }
   // finished
   request.always = function(){
       // this will be called always whether fail or done at the end of this request
       //alert("alwa");
   }
   // send
   request.send(); // start the ajax request
}// end of function

function load_table_sched(data){
    $.each(data, function(key,value) {
      subject = value['subject'];
      schedule = value['load_group_schedule'];
      if(value['load_group_schedule'] !=null ){
        $("#tbl_sched").append("<tr class='text-center'><td>"+schedule['class_day']+"</td> <td>"+subject['code']+"</td> <td>"+schedule['class_start']+"</td> <td>"+schedule['class_end']+"</td> <td>"+schedule['class_room']+"</td><td>"+""+"</td><tr/>");
      }else {
      }

    });
}

function load_sched(data){
//  $("[id='Sunday-7:00']").append('Some text');
    var n = 1;
    $.each(data,function(key,value){
    subject = value['subject'];
    schedule = value['load_group_schedule'];
    if(value['load_group_schedule'] !=null ){
      var end = schedule['class_end'];
      end = end.slice(0, -3);
      var start = schedule['class_start'];
      start = start.slice(0, -3);
      var rowspan =  end - start;
      //alert(rowspan);
      $("[id='"+schedule['class_day']+"-"+schedule['class_start']+"']").attr('rowspan', rowspan);
      $("[id='"+schedule['class_day']+"-"+schedule['class_start']+"']").attr('style','background-color:#8BB4C0; color:white;');
      $("[id='"+schedule['class_day']+"-"+schedule['class_start']+"']").append(subject['code'] +"<br/>"+schedule['class_room']);

  //    $("[id='SUNDAY-08:00']").remove();
  //    $("[id='MONDAY-08:00']").remove();
  //    $("[id='MONDAY-09:00']").remove();
  //    $("[id='TUESDAY-11:00']").remove();
  // /*
  for (var i = 1; i <rowspan; i++) {
        var next = parseInt(start) + i;
        next = next.toString();
        if(next.length >= 2){
          next = next+":00";
        }else{
          next = "0"+next+":00";
        }
        $("[id='"+schedule['class_day']+"-"+next+"']").remove();
      //  alert("[id='"+schedule['class_day']+"-"+next+"']");
    } //*/
    }else{
      $("[id='Sunday-7:00']").append(n+ "-waley ");
    }
      n++;
    });// each
}

function student_history(){
  $( "#container" ).load("{{ asset( 'html/profile/student_eval.php' ) }}", function(){
    request_eval();
    });
  }

  function request_eval(){
    // settings
    request = new Request();
    request.url = "{{ route('eval-get') }}";
    request.type = 'GET';
    request.replyType = 'json';
    // start
    request.begin = function(){
     // alert("start");
    }
    // success
    request.done = function(data, textStatus, xhr){
     //   alert(JSON.stringify(data));
     //   load_sched(data);
        load_table_eval(data);
    }
    // failed
    request.fail = function(xhr, textStatus, errorThrown){
      //  alert("STATUS AND READY STATE: " + xhr.status + "-" +xhr.readyState);
      //  alert("JQUERY TEXT STATUS: " + textStatus);
      //  alert("ERROR DESCRIPTION: " + errorThrown);
        xhr_methods(xhr.readyState, xhr.status);
    }
    // finished
    request.always = function(){
        // this will be called always whether fail or done at the end of this request
        //alert("alwa");
    }
    // send
    request.send(); // start the ajax request
 }// end of function


 function load_table_eval(data){
   var n = 1;
     $.each(data, function(key,value) {
       eval = value['eval'];
       acad = value['acad'];
       if(value['eval'] !=null ){
         $("#tbl_eval").append("<tr id='"+n+"'class='text-center'><td>"+acad['school_year']+" "+acad['semester']+"</td> <td>"+eval['id']+"</td> <td>"+eval['evaluation_date']+"</td> <td>"+""+"</td> <td>"+""+"</td><td>"+""+"</td><td>"+eval['year_level']+"</td><td>"+eval['remarks']+"</td><tr/>");
         if(eval['active'] == 1){
           $("#"+n+"").attr('style', 'background-color:#8DCF8C');
         }
       }else {
       }
       n++;
     });
 }
</script>
