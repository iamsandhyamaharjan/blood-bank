
          
// JavaScript to toggle modal visibility

function openModal() {
  var modal = document.getElementById("modal");
  modal.style.display = "block";
}
function closeModal() {
  var modal = document.getElementById("modal");
  var smodal = document.getElementById("smodal");
  var lmodal = document.getElementById("loginmodal");
  var dropdown = document.getElementById("dropdown-content");
  modal.style.display = "none";
  smodal.style.display = "none";
  lmodal.style.display = "none";
  dropdown.style.display = "none";
}
window.onclick = function(event) {
  var modal = document.getElementById("modal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
 // JavaScript to toggle dropdown menu visibility
 function toggleDropdown() {
  var dropdownContent = document.getElementById("dropdown-content");
  dropdownContent.style.display = (dropdownContent.style.display === "none") ? "block" : "none";
}
function openLoginModal() {
  var lmodal = document.getElementById("loginmodal");
  lmodal.style.display = "block";
}
window.onclick = function(event) {
  var lmodal = document.getElementById("loginmodal");
  if (event.target == lmodal) {
    lmodal.style.display = "none";
  }
}
function openSignModal() {
  var modal = document.getElementById("smodal");
  modal.style.display = "block";
}
window.onclick = function(event) {
  var modal = document.getElementById("smodal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


function validateAdminLoginForm() {
    var username = document.getElementById('username').value.trim();
    var password = document.getElementById('Password').value.trim();
    var errormsg1 = "";
    var errormsg2 = "";

    if (!username) {
       var errormsg1="please enter username"
    }
     if (!password) {
      var errormsg2="please enter password"
   }
   document.getElementById('error-msg-1').innerHTML = errormsg1;
   document.getElementById('error-msg-2').innerHTML = errormsg2;

   // If either of the error messages is not empty, return false to prevent form submission
   if (errormsg1 || errormsg2) {
       return false;
   }


    // If everything is valid, return true to submit the form
 return true;
}
function validateLoginForm() {
  var username = document.getElementsByName('username')[0].value.trim();
  var password = document.getElementsByName('Password')[0].value.trim();
  var errormsg3 = "";
  var errormsg4 = "";

  if (!username) {
      errormsg3 = "Please enter username";
  }
  if (!password) {
      errormsg4 = "Please enter password";
  }
  document.getElementById('error-msg-3').innerHTML = errormsg3;
  document.getElementById('error-msg-4').innerHTML = errormsg4;

  // If either of the error messages is not empty, return false to prevent form submission
  return !(errormsg3 || errormsg4);
}



function validateSignUpForm() {
  var username = document.getElementsByName('name')[0].value.trim();
  var address = document.getElementsByName('address')[0].value.trim();
  var age = document.getElementsByName('age')[0].value.trim();
  var contact = document.getElementsByName('contact')[0].value.trim();
  var bloodGroup = document.getElementsByName('bloodgroup')[0].value.trim();
  var password = document.getElementsByName('Password')[0].value.trim();
  var errormsg5 = "";
  var errormsg6 = "";
  var errormsg7 = "";
  var errormsg8 = "";
  var errormsg9 = "";
  var errormsg10 = "";

  if (!username) {
      errormsg5 = "Please enter name";
  }
  if (!address) {
      errormsg6 = "Please enter address";
  }
  if (!age) {
      errormsg7 = "Please enter age";
  }
  if (!contact) {
      errormsg8 = "Please enter contact";
  }
  if (!bloodGroup) {
      errormsg9 = "Please enter your blood group";
  }
  if (!password) {
      errormsg10 = "Please enter password";
  }

  document.getElementById('error-msg-5').innerHTML = errormsg5;
  document.getElementById('error-msg-6').innerHTML = errormsg6;
  document.getElementById('error-msg-7').innerHTML = errormsg7;
  document.getElementById('error-msg-8').innerHTML = errormsg8;
  document.getElementById('error-msg-9').innerHTML = errormsg9;
  document.getElementById('error-msg-10').innerHTML = errormsg10;

  // If any error messages are present, return false to prevent form submission
  return !(errormsg5 || errormsg6 || errormsg7 || errormsg8 || errormsg9 || errormsg10);
}
document.addEventListener("DOMContentLoaded", function() {
  // Smooth scroll when clicking on "About Us" link
  var aboutUsLink = document.querySelector("a[href='#about-section']");
  if (aboutUsLink) {
      aboutUsLink.addEventListener("click", function(event) {
          event.preventDefault();
          var section = document.getElementById("about-section");
          section.scrollIntoView({ behavior: "smooth" });
      });
  }
});
