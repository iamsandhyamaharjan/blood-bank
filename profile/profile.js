function validateForm() {
        
          var username = document.getElementById('editName').value.trim();
          var address = document.getElementById('editAddress').value.trim();
          var age = document.getElementById('editAge').value.trim();
          var contact = document.getElementById('editContact').value.trim();
          var bloodGroup = document.getElementById('editBlood').value.trim();
          
          var errormsg5 = "";
          var errormsg6 = "";
          var errormsg7 = "";
          var errormsg8 = "";
          var errormsg9 = "";
      
          if (!username) {
              errormsg5 = "Please enter name";
          } else if (!/^[a-zA-Z]+$/.test(username)) {
              errormsg5 = "Name should contain only alphabet characters";
          }
          
          if (!address) {
              errormsg6 = "Please enter address";
          }
          
          if (!age) {
              errormsg7 = "Please enter age";
          }
          
          if (!contact) {
              errormsg8 = "Please enter contact";
          } else if (!/^\d{10}$/.test(contact)) {
              errormsg8 = "Phone number must be exactly 10 digits";
          }
          
          if (!bloodGroup) {
              errormsg9 = "Please select the blood group";
          }
      
          document.getElementById('hi').innerHTML = errormsg5;
          document.getElementById('hi2').innerHTML = errormsg6;
          document.getElementById('hi3').innerHTML = errormsg7;
          document.getElementById('hi4').innerHTML = errormsg8;
          document.getElementById('hi5').innerHTML = errormsg9;
      
          // If any error messages are present, return false to prevent form submission
          if (errormsg5 || errormsg6 || errormsg7 || errormsg8 || errormsg9) {
              return false;
          }
          
          return true;
      }
      