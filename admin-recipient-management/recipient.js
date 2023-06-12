function deleteRecipient(id) {
          if (confirm('Are you sure you want to delete this recipient?')) {
              var form = document.createElement('form');
              form.method = 'POST';
              form.action = '';

              var input = document.createElement('input');
              input.type = 'hidden';
              input.name = 'delete_recipient';
              input.value = 'true';
              form.appendChild(input);

              var inputId = document.createElement('input');
              inputId.type = 'hidden';
              inputId.name = 'recipient_id';
              inputId.value = id;
              form.appendChild(inputId);

              document.body.appendChild(form);
              form.submit();
          }
      }