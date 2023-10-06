

function deleteDonor(id) {
    if (confirm('Are you sure you want to delete this donor?')) {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'delete_donor';
        input.value = 'true';
        form.appendChild(input);

        var inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = 'donor_id';
        inputId.value = id;
        form.appendChild(inputId);

        document.body.appendChild(form);
        form.submit();
    }
}

function openEditForm(id) {
    // Fetch donor details using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_donor.php?id=' + id, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var donor = JSON.parse(xhr.responseText);

            // Populate form fields with donor details
            document.getElementById('editDonorId').value = donor.id;
            document.getElementById('editName').value = donor.Name;
            document.getElementById('editAddress').value = donor.Address;
            document.getElementById('editAge').value = donor.Age;
            document.getElementById('editContact').value = donor.Contact;
            document.getElementById('editBloodGroup').value = donor.BloodGroup;

            // Show the edit form
            document.getElementById('editFormContainer').style.display = 'block';
        } else {
            console.error('Error:', xhr.status);
        }
    };
    xhr.send();
}

function closeEditForm() {
    // Hide the edit form
    document.getElementById('editFormContainer').style.display = 'none';
}

function validateForm() {
    // alert('i am her')

    var username = document.getElementById('editName').value.trim();
    console.log("username",username)
  
    var address = document.getElementById('editAddress').value.trim();
    var age = document.getElementById('editAge').value.trim();
    var contact = document.getElementById('editContact').value.trim();
    var bloodGroup = document.getElementById('editBloodGroup').value.trim();
    var password = document.getElementById('editPassword').value.trim();
    var errormsg5 = "";
    var errormsg6 = "";
    var errormsg7 = "";
    var errormsg8 = "";
    var errormsg9 = "";
    var errormsg10 = "";
  
    if (!username) {
      errormsg5 = "Please enter name";
    }
    else if (!/^[a-zA-Z]+$/.test(username)) {
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
    if(!bloodGroup){
        errormsg9 = "Please select the blood group";
    }
    if (!password) {
      errormsg10 = "Please enter password";
    } else if (password.length <= 8) {
      errormsg10 = "Password must be greater than 8 characters";
    }
   
  
    document.getElementById('error-msg-5').innerHTML = errormsg5;
    document.getElementById('error-msg-6').innerHTML = errormsg6;
    document.getElementById('error-msg-7').innerHTML = errormsg7;
    document.getElementById('error-msg-8').innerHTML = errormsg8;
    document.getElementById('error-msg-9').innerHTML = errormsg9;
    document.getElementById('error-msg-10').innerHTML = errormsg10;
    
  
    // If any error messages are present, return false to prevent form submission
    if (errormsg5 || errormsg6 || errormsg7 || errormsg8 || errormsg9 || errormsg10) {
      return false;
    }
    return true;
  }