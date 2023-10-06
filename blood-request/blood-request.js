function validateForm() {
          var name = document.getElementById('editName').value.trim();
          var bloodgroup = document.getElementById('editBloodgroups').value;
          var contact = document.getElementById('editContact').value.trim();
          var nameRegex = /^[a-zA-Z]+$/;
          var contactRegex = /^\d{10}$/;
  
          var nameError = "";
          var bloodgroupError = "";
          var contactError = "";
  
          if (!name || !name.match(nameRegex)) {
              nameError = "Please enter a valid name containing only alphabet characters.";
          }
  
          if (!bloodgroup) {
              bloodgroupError = "Please select a blood group.";
          }
  
          if (!contact || !contact.match(contactRegex)) {
              contactError = "Please enter a valid 10-digit contact number.";
          }
  
          document.getElementById('error-msg-name').innerHTML = nameError;
          document.getElementById('error-msg-bloodgroup').innerHTML = bloodgroupError;
          document.getElementById('error-msg-contact').innerHTML = contactError;
  
          if (nameError || bloodgroupError || contactError) {
              return false;
          }
  
          return true;
      }

  
  
  
  
  