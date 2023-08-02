
          
// JavaScript to toggle modal visibility

function openModal() {
  var modal = document.getElementById("modal");
  modal.style.display = "block";
}
function closeModal() {
  var modal = document.getElementById("modal");
  var smodal = document.getElementById("smodal");
  var lmodal = document.getElementById("loginmodal");
  modal.style.display = "none";
  smodal.style.display = "none";
  lmodal.style.display = "none";
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
  var username = document.getElementByName('username').value.trim();
  var password = document.getElementByName('Password').value.trim();
  var errormsg3 = "";
  var errormsg4 = "";

  if (!username) {
     var errormsg3="please enter username"
    
  }
   if (!password) {
    var errormsg4="please enter password"
   

 }
 document.getElementById('error-msg-3').innerHTML = errormsg3;
 document.getElementById('error-msg-4').innerHTML = errormsg4;


 // If either of the error messages is not empty, return false to prevent form submission
 if (errormsg3 || errormsg4) {
     return false;
 }


  // If everything is valid, return true to submit the form
return true;
}


function validateSignUpForm() {
  var username = document.getElementByName('name').value.trim();
  var address = document.getElementByName('address').value.trim();
  var age = document.getElementByName('age').value.trim();
  var contact = document.getElementByName('contact').value.trim();
  var bloodGroup = document.getElementByName('bloodgroup').value.trim();
  var password = document.getElementByName('Password').value.trim();
  var errormsg5 = "";
  var errormsg6 = "";
  var errormsg7 = "";
  var errormsg8 = ""; var errormsg10 = "";
  var errormsg9 = "";

  if (!username) {
     var errormsg5="please enter name"
     document.getElementById('error-msg-5').innerHTML = errormsg5;
  }
  if (!address) {
    var errormsg6="please enter address"
    document.getElementById('error-msg-6').innerHTML = errormsg6;

 }
   if (!password) {
    var errormsg10="please enter password"
    document.getElementById('error-msg-10').innerHTML = errormsg10;

 }
 if (!age) {
  var errormsg7="please enter age"
  document.getElementById('error-msg-7').innerHTML = errormsg7;

}
if (!contact) {
  var errormsg8="please enter contact"
  document.getElementById('error-msg-8').innerHTML = errormsg8;

}
if (!bloodGroup) {
  var errormsg9="please enter your blood group"
  document.getElementById('error-msg-9').innerHTML = errormsg9;

}




 // If either of the error messages is not empty, return false to prevent form submission
 if (errormsg5 || errormsg6 ||errormsg7||errormsg8||errormsg9||errormsg10) {
     return false;
 }


  // If everything is valid, return true to submit the form
return true;
}
