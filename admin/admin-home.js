document.addEventListener("DOMContentLoaded", function() {
          // Retrieve donor list from server
          fetchDonorList();
      
          // Handle form submission
          var form = document.getElementById("add-donor-form");
          form.addEventListener("submit", function(event) {
              event.preventDefault();
      
              // Collect form data
              var name = document.getElementById("name").value;
              var bloodGroup = document.getElementById("blood-group").value;
              var contactNumber = document.getElementById("contact-number").value;
      
              // Send data to server for processing
              addDonor(name, bloodGroup, contactNumber);
      
              // Clear form inputs
              form.reset();
          });
      
          // Handle donor removal
          var donorList = document.getElementById("donor-list");
          donorList.addEventListener("click", function(event) {
              var target = event.target;
              if (target.classList.contains("remove-donor")) {
                  var donorId = target.getAttribute("data-donor-id");
                  removeDonor(donorId);
              }
          });
      });
      
      function fetchDonorList() {
          // Make an AJAX request to retrieve donor list from the server
          // Replace this code with your actual server-side implementation
          var donors = [
              { id: 1, name: "John Doe", bloodGroup: "A+", contactNumber: "1234567890" },
              { id: 2, name: "Jane Smith", bloodGroup: "B-", contactNumber: "9876543210" },
              { id: 3, name: "Alice Johnson", bloodGroup: "O+", contactNumber: "5555555555" }
          ];
      
          var donorList = document.getElementById("donor-list");
          donorList.innerHTML = "";
      
          donors.forEach(function(donor) {
              var row = document.createElement("tr");
              row.innerHTML = `
                  <td>${donor.id}</td>
                  <td>${donor.name}</td>
                  <td>${donor.bloodGroup}</td>
                  <td>${donor.contactNumber}</td>
                  <td><button class="remove-donor" data-donor-id="${donor.id}">Remove</button></td>
              `;
              donorList.appendChild(row);
          });
      }
      
      function addDonor(name, bloodGroup, contactNumber) {
          // Make an AJAX request to add the donor to the server
          // Replace this code with your actual server-side implementation
          var donorId = Math.floor(Math.random() * 1000) + 1;
      
          // Update the UI to display the added donor
          var donorList = document.getElementById("donor-list");
          var row = document.createElement("tr");
          row.innerHTML = `
              <td>${donorId}</td>
              <td>${name}</td>
              <td>${bloodGroup}</td>
              <td>${contactNumber}</td>
              <td><button class="remove-donor" data-donor-id="${donorId}">Remove</button></td>
          `;
          donorList.appendChild(row);
      
          showMessage("Donor added successfully.");
      }
      
      function removeDonor(donorId) {
          // Make an AJAX request to remove the donor from the server
          // Replace this code with your actual server-side implementation
      
          // Update the UI to remove the donor from the list
          var donorRow = document.querySelector(`[data-donor-id="${donorId}"]`).parentNode.parentNode;
          donorRow.parentNode.removeChild(donorRow);
      
          showMessage("Donor removed successfully.");
      }
      
      function showMessage(message) {
          var messageElement = document.getElementById("message");
          messageElement.textContent = message;
          messageElement.classList.remove("hidden");
          setTimeout(function() {
              messageElement.classList.add("hidden");
          }, 3000);
      }
     // check