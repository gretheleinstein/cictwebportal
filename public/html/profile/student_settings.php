<form id = "frm_change_flr_ass">
  <div class="row white-bg div-white-shadow" style="padding:3%;">
    <div class="col-12">
      <h5>Change Cluster Assignment</h5><hr>
    </div>
      <div class="col-lg-10 form-group ">
        <label class="control-label col-sm-4">Select new Cluster assignment:</label>
        <div class="col-sm-8">
          <select name="floor_assignment" class="form-control" id="floor_assignment">
            <option value="3">Cluster 1</option>
            <option value="4">Cluster 2</option>
          </select>
        </div>
      </div><br><br>
      <div class="col-lg-10 alert alert-secondary alert-flr text-center col-lg-offset-1" style="display: none"></div>
      <div class="col-lg-12 text-center" style="margin-top:1%" >
      <button type="button" name="btn_save_flr" id="btn_save_flr" class="btn btn-orange pull-right" style="margin-bottom:1%">SAVE CHANGES</button>
    </div>
  </div>
</form>
<br>
<form id = "frm_change_password">
  <div class="row white-bg div-white-shadow" style="padding: 3%;">
    <div class="col-lg-12">
      <h5>Change Password</h5><hr>
    </div>
      <div class="col-lg-10 form-group col-lg-offset-1">
        <label class="control-label col-sm-4">Old Password:</label>
        <div class="col-sm-8">
        <input type="password" name="old_password" class="form-control input-sm" id="old_password" value="">
        <label id="old-password-error-1" class="error" style="display: none"></label>
        </div><br>
      </div>
      <div class="col-lg-10 form-group col-lg-offset-1">
        <label class="control-label col-sm-4">New Password:</label>
        <div class="col-sm-8">
        <input type="password" name="new_password" class="form-control input-sm" id="new_password" value="">
        </div>
      </div><br>
      <div class="col-lg-10 form-group col-lg-offset-1">
        <label class="control-label col-sm-4">Confirm New Password:</label>
        <div class="col-sm-8">
        <input type="password" name="confirm_new_password" class="form-control input-sm" id="confirm_new_password" value=""  >
        </div>
      </div><br><br>
      <div class="col-lg-10 alert alert-secondary alert-pass text-center col-lg-offset-1" style="display: none"></div>
      <div class="col-lg-12 text-center" style="margin-top:1%" >
      <button type="button" name = "btn_save" id="btn_save" class="btn btn-orange pull-right" style="margin-bottom:1%">SAVE CHANGES</button>
    </div>
  </div>
</form>
