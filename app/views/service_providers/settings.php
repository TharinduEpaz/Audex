<div class="service-provider-profile">
  <div class="white-box">
    <span id="edit-profile-heading">Edit Profile</span>
    <button class="add-event-btn" id="edit-event-btn" onclick="window.location.href='<?php echo URLROOT . '/users/change_password/' . $data['details']->user_id; ?>'">Change Password</button>
    <button class="add-event-btn" id="edit-event-btn" onclick="window.location.href='<?php echo URLROOT . '/users/change_email/' . $data['details']->user_id; ?>'">Change Email</button>
    <?php if ($data['details']->is_paid == 0) : ?>
      <button class="add-event-btn" id="edit-event-btn" onclick="window.location.href='<?php echo URLROOT . '/users/checkout_service_provider/' . $data['details']->user_id . '/' . urlencode(json_encode($data1)); ?>'">Make Payment</button>
    <?php endif; ?>
    <button class="add-event-btn" id="edit-event-btn" onclick="window.location.href='<?php echo URLROOT . '/users/change_phone/' . $data['details']->user_id; ?>'">Change Phone Number</button>

    <?php if ($data['details']->admin_approved == 0 || $data['details']->admin_ignored == 1) : ?>
      <button class="add-event-btn" id="myBtn">Get Admin Approval</button>
    <?php endif; ?>

    <!-- The Modal -->
    <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <form action="<?php echo URLROOT . '/service_providers/adminApprove/' ?>" enctype="multipart/form-data" method="POST">
          <div class="formbold-form-file-flex">
            <?php if ($data != 0 && $data['details']->admin_ignored == 1) : ?>

              <span style="color:red">Your request is ignored because : </span>
              <span><?php echo $data['details']->ignore_reason ?></span>
            <?php endif; ?>
            <label for="profile" class="formbold-form-label">
              Upload your qualifications in PDF format you can upload your degrees and certificates or the past experiences
            </label>
            <input type="file" name="approve" id="approve" class="formbold-form-file" />
          </div>
          <button name="submit" type="submit" class="add-event-btn" style="margin-top:40px">Submit to Admin</button>


        </form>
      </div>

    </div>
    <hr>

    <?php if (!empty($data['errors'])) : ?>
      <?php foreach ($data['errors'] as $error) : ?>
        <p id="error-text-box"><?php echo $error ?></p>
      <?php endforeach; ?>
    <?php endif; ?>


    <div class="formbold-main-wrapper">
      <div class="formbold-form-wrapper">

        <form id="edit-settings-form" action="<?php echo URLROOT . '/service_providers/setDetails/' ?>" method="POST" enctype="multipart/form-data">
          <div class="formbold-input-flex">
            <div>
              <label for="first_name" class="formbold-form-label"> First Name </label>
              <input type="text" name="first_name" id="first_name" placeholder="<?php echo $data['details']->first_name ?>" pattern="[A-Za-z]+" title="Name should only contain letters" class="formbold-form-input" />
            </div>

            <div>
              <label for="second_name" class="formbold-form-label"> Last Name </label>
              <input type="text" name="second_name" id="second_name" placeholder="<?php echo $data['details']->second_name ?>" class="formbold-form-input" pattern="[A-Za-z]+" title="Name should only contain letters" />
            </div>
          </div>





          <div class="formbold-mb-3">
            <label for="profession" class="formbold-form-label"> Profession: </label>
            <input type="text" name="profession" id="profession" placeholder="<?php echo $data['details']->profession ?>" class="formbold-form-input" maxlength="30" />
          </div>


          <div class="formbold-mb-3">
            <label for="address1" class="formbold-form-label"> Address </label>

            <input type="text" name="address1" id="address1" placeholder="<?php echo $data['details']->address_line_one ?>" class="formbold-form-input formbold-mb-3" maxlength="100" />
            <br>
            <br>
            <input type="text" name="address2" id="address2" placeholder="<?php echo $data['details']->address_line_two ?>" class="formbold-form-input formbold-mb-3" maxlength="100" />


          </div>

          <div class="formbold-mb-3">
            <label for="qualifications" class="formbold-form-label"> Qualifications: </label>
            <input type="text" name="qualifications" id="qualifications" placeholder="<?php echo $data['details']->qualifications ?>" class="formbold-form-input" maxlength="100" />
          </div>

          <div class="formbold-mb-3">
            <label for="achievements" class="formbold-form-label"> Achievements </label>
            <input type="text" name="achievements" id="achievements" placeholder="<?php echo $data['details']->achievements ?>" class="formbold-form-input" maxlength="50" />
          </div>

          <div class="formbold-mb-3">
            <label for="description" class="formbold-form-label">
              Profile Description
            </label>
            <textarea rows="6" name="description" id="description" placeholder="<?php echo $data['details']->description ?>" class="formbold-form-input" maxlength="1000"></textarea>
          </div>

          <div class="formbold-form-file-flex">
            <label for="profile" class="formbold-form-label">
              Upload Profile Image
            </label>
            <input type="file" name="profile" id="profile" class="formbold-form-file" accept="image/png, image/gif, image/jpeg" />
          </div>
          <br><br>
          <button type="submit" class="add-event-btn" id="edit-event-btn" name='submit'>Save Settings</button>
          <button class="cancel" id="edit-event-btn" type="reset" onclick="exit()">Cancel</button>
        </form>
      </div>
    </div>


    <script>
      //make alert window before exiting
      function exit() {
        var r = confirm("Are you sure you want to exit?");
        if (r == true) {
          window.location.href = "<?php echo URLROOT . '/service_providers/profile/' ?>";
        } else {
          return
        }
      }

      //if all of the form inputs are empty then display alert after clicking submit
      const form = document.getElementById('edit-settings-form');

      form.addEventListener('submit', function(event) {
        event.preventDefault();
        validateForm();
      });

      function validateForm() {
        // get all form fields
        const formFields = document.querySelectorAll('#myForm input, #myForm select, #myForm textarea');

        // check if all fields are empty
        const allFieldsEmpty = Array.from(formFields).every(field => field.value.trim() === '');

        // if all fields are empty, alert the user and don't submit the form
        if (allFieldsEmpty) {
          alert('Please fill out at least one field before submitting the form.');
          return;
        }

        // if not all fields are empty, submit the form
        form.submit();
      }
      var uploadField = document.getElementById("profile");

      uploadField.onchange = function() {
        if (this.files[0].size > 5000000) {
          alert("File is too big!");
          this.value = "";
        };
      };



      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks on the button, open the modal
      btn.onclick = function() {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>
    <script src="<?php echo URLROOT . '/public/js/form.js'; ?>"></script>