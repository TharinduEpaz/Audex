
<div class="service-provider-profile">
    <div class="white-box">
        <span id="edit-profile-heading">Edit Profile</span>
        <button class="add-event-btn" id="edit-event-btn">Change Password</button>
        <button class="add-event-btn" id="edit-event-btn">Change Email</button>
        <button class="add-event-btn" id="edit-event-btn">Make Payment</button>

        <hr>
       
<div class="formbold-main-wrapper">
  <div class="formbold-form-wrapper">
    <form action="<?php echo URLROOT . '/service_providers/setDetails/' ?>" method="POST" enctype="multipart/form-data">
      <div class="formbold-input-flex">
        <div>
          <label for="firstname" class="formbold-form-label"> First Name </label>
          <input
            type="text"
            name="firstname"
            id="firstname"
            placeholder="<?php echo $data['details']->first_name ?>"
            class="formbold-form-input"
          />
        </div>

        <div>
          <label for="second_name" class="formbold-form-label"> Last Name </label>
          <input
            type="text"
            name="second_name"
            id="second_name"
            placeholder="<?php echo $data['details']->second_name ?>"
            class="formbold-form-input"
          />
        </div>
      </div>

      <div class="formbold-input-flex">
        <div>
            <label for="email" class="formbold-form-label"> Email </label>
            <input
            type="email"
            name="email"
            id="email"
            placeholder="example@email.com"
            class="formbold-form-input"
            />
        </div>

        <div>
            <label class="formbold-form-label">Gender</label>

            <select class="formbold-form-input" name="occupation" id="occupation">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="others">Others</option>
            </select>
        </div>
      </div>

      <div class="formbold-mb-3 formbold-input-wrapp">
        <label for="mobile" class="formbold-form-label"> Phone </label>
         
          <input
            type="number"
            name="mobile"
            id="mobile"
            placeholder="<?php echo $data['details']->mobile ?>"
            class="formbold-form-input"
          />
       
      </div>

      <div class="formbold-mb-3">
        <label for="profession" class="formbold-form-label"> Profession: </label>
        <input
          type="text"
          name="profession"
          id="profession"
          placeholder="<?php echo $data['details']->profession ?>"
          class="formbold-form-input"
        />
      </div>


      <div class="formbold-mb-3">
        <label for="address1" class="formbold-form-label"> Address </label>

        <input
          type="text"
          name="address1"
          id="address1"
          placeholder="<?php echo $data['details']->address_line_one ?>"
          class="formbold-form-input formbold-mb-3"
        />
        <input
          type="text"
          name="address2"
          id="address2"
          placeholder="<?php echo $data['details']->address_line_two ?>"
          class="formbold-form-input formbold-mb-3"
        />

      </div>

      <div class="formbold-mb-3">
        <label for="qualifications" class="formbold-form-label"> Qualifications: </label>
        <input
          type="text"
          name="qualifications"
          id="qualifications"
          placeholder="<?php echo $data['details']->qualifications ?>"
          class="formbold-form-input"
        />
      </div>

      <div class="formbold-mb-3">
        <label for="achievements" class="formbold-form-label"> Achievements </label>
        <input
          type="text"
          name="achievements"
          id="achievements"
          placeholder="<?php echo $data['details']->achievements ?>"
          class="formbold-form-input"
        />
      </div>

      <div class="formbold-mb-3">
        <label for="description" class="formbold-form-label">
          Profile Description
        </label>
        <textarea
          rows="6"
          name="description"
          id="description"
          placeholder="<?php echo $data['details']->description ?>"
          class="formbold-form-input"
        ></textarea>
      </div>

      <div class="formbold-form-file-flex">
        <label for="profile" class="formbold-form-label">
          Upload Profile Image
        </label>
        <input
          type="file"
          name="profile"
          id="profile"
          class="formbold-form-file"
        />
      </div>
      <button type="submit" class="formbold-btn">Save Settings</button>
      <button id="cancel" type="reset"  class="" onclick="exit()">Cancel</button>
    </form>
  </div>
</div>


<script>


//make alert window before exiting
function exit(){
  var r = confirm("Are you sure you want to exit?");
  if (r == true) {
    window.location.href = "<?php echo URLROOT . '/service_providers/profile/' ?>";
  } else {
    return
  }
}








</script>

