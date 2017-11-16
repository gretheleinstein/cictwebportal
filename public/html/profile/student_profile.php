<div id="modal" class="mont" title="Upload Display Photo">
  <form id="form_upload" enctype="multipart/form-data">
  <div id="image_preview"><img id="preview" class="img-responsive img-thumbnail"/></div>
  <hr>
  <div id="selectImage">

    <div id="upload_message"></div>
  <label>Select Your Image</label><br/>
  <input type="file" name="image-file" id="image-file"/>
  <button type="button" class="btn btn-options" name="image-upload" id="image-upload" style="padding:2%">Upload Image</button>
  </div>
  </form>
</div>

<form id = "frm_student_profile">
  <div class="row white-bg" style="margin-bottom: 1%;  padding: 3%">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
      <label for="">Student ID</label><br>
      <input type="text" class="span_grey" id="stud-id" value="" disabled>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
      <label for="">Year/Sec/Group</label><br>
      <input type="text" class="span_grey" id="year-sec-gr" value="" disabled>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
      <label for="">Curriculum</label><br>
      <input type="text" class="span_grey" id="curriculum" value="" disabled>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
      <label for="">Floor Assignment</label><br>
      <input type="text" class="span_grey" id="floor-assignment-lbl" value="" disabled>
    </div>
  </div>
  <div class="row white-bg" style="padding: 3%">
    <div class="col-lg-12">
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-7" style="padding:0%">
      <h5 class="bold">STUDENT PROFILE</h5>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4" id="div_view_pdf">
        <a id="btn_view_pdf" class="btn btn-options pull-left" style="padding: 7%" target="_blank"><span class="glyphicon glyphicon-file"></span> VIEW PDF</a>
    </div>
    <br><br><hr>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center" id="profile-pic-1">
      <img id="display-pic" onload="onload_profile_photo(this.id)" class="img-responsive img-thumbnail" width="150" height="150" alt=""><br>
      <button id="btn_change_pic" class="btn btn-options" style="padding: 2%" type="button">Change Picture</button>
    </div>

    <div class="col-lg-9 col-md-8 col-xs-12">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">First name</label><br>
        <input type="text" name="" class="form-control input-sm" id="first_name" value="" disabled>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Last name</label><br>
        <input type="text" name="" class="form-control input-sm" id="last_name" value="" disabled>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Middle name</label><br>
        <input type="text" name="" class="form-control input-sm" id="middle_name" value="" disabled>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">Contact no. *</label><br>
        <input type="text" name="contact_no" id="contact_no" class="form-control input-sm" placeholder="e.g. 09437083011" value="">
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <label for="">E-mail address *</label><br>
        <input type="text" name="email" id="email" class="form-control input-sm" placeholder="e.g. juandelacruz@gamil.com" value="">
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 10%">
        <label for="">Gender *</label><br>
        <div class="btn-group" id="radio_gender" data-toggle="buttons">
          <label class="btn btn-blue MALE">
            <input type="radio" name="gender" id="MALE" value="MALE">Male
          </label>
          <label class="btn btn-blue FEMALE">
            <input type="radio" name="gender" id="FEMALE" value="FEMALE">Female
          </label>
        </div>
      </div>
    </div>
    <div class="">
      <h5 class="bold">COMPLETE ADDRESS</h5><hr>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <label for="house_no" class="">House no *</label><br>
      <input type="text" id="house_no" name="house_no" class="form-control input-sm" placeholder="e.g. 03" value="">
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <label for="street" class="">Street</label><br>
      <input type="text" id="street" name="street" class="form-control input-sm" placeholder="e.g. St. Palayan" value="">
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <label for="zipcode" class="">Zipcode *</label><br>
      <input type="text" id="zipcode" name="zipcode" class="form-control input-sm" placeholder="e.g. 3005" value="">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <label for="brgy" class="">Barangay *</label><br>
      <input type="text" id="brgy" name="brgy" class="form-control input-sm" placeholder="e.g. Paltao" value="">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <label for="city" class="">City/District *</label><br>
      <input type="text" id="city" name="city" class="form-control input-sm" placeholder="e.g. Pulilan" value="">
    </div>
    <div class="col-lg-12 col-xs-12">
      <label for="province" class="">Province *</label><br>
      <input type="text" id="province" name="province" class="form-control input-sm" placeholder="e.g. Bulacan" value=""><br>
    </div>

    <div class=""><br>
      <h5 class="bold" style="margin-top:20%;">GUARDIAN'S INFORMATION</h5><hr>
      <h5 style="font-size:9pt">In case of emergency, please contact:</h5>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <label for="">Full name *</label><br>
      <input type="text" name="ice_name" id="ice_name" class="form-control input-sm" placeholder="e.g. Mario Dela Cruz">
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <label for="">Contact no. *</label><br>
      <input type="text" name="ice_contact" id="ice_contact" class="form-control input-sm" placeholder="e.g. 09228575766">
    </div>
    <div class="col-xs-12">
      <label for="">Complete address *</label><br>
      <input type="text" name="ice_address" id="ice_address" class="form-control input-sm" placeholder="e.g. #07 National Road Cut-Cot, Pulilan, Bulacan">
    </div>
    <div class="col-xs-12 text-center">
      <br><div class="alert alert-info" style="display:none">
      </div>
    </div>
    <div id="div_btn" class="text-center" style="margin-top:5%;" >
      <button type="button" name = "btn_save" id="btn_save" class="btn btn-options" style="padding: 2%"><span class="glyphicon glyphicon-floppy-disk"></span> SAVE CHANGES</button>
    </div>
  </form>
  </div>
