function request(button, requestId) {debugger
          console.log(button,requestId)
          // Assuming you're using AJAX to update the status in the database.
          $.ajax({
              url: 'request.php', // Replace with your server-side script to handle the update
              method: 'POST',
              data: {
                    donationId: requestId
              },
              success: function(response) {
                    console.log(response)
                  if (response === 'success') {
                      // Once the status is updated, change the button text to 'Donated'.
                      button.innerText = "Requested";
                  } else {
                      // Handle error if needed
                      console.error('Status update failed');
                  }
              },
              error: function(xhr, status, error) {
                  // Handle error if needed
                  console.error('AJAX error:', error);
              }
          });
      }
  
  
  
  
  
  