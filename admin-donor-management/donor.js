

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