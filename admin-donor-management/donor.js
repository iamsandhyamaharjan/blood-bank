function createDonor() {
          // Add your create donor logic here
          alert("Create Donor");
      }
      
      function editDonor(id) {
          // Add your edit donor logic here
          alert("Edit Donor with ID: " + id);
      }
      
      function deleteDonor(id) {
          // Add your delete donor logic here
          alert("Delete Donor with ID: " + id);
      }

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