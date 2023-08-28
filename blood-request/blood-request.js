$(document).ready(function() {
          $("#searchButton").click(function() {
              var searchValue = $("#searchInput").val().trim();
              if (searchValue !== "") {
                  $("#content").empty(); // Clear previous search results
                  $.post("search.php", { search: searchValue }, function(data) {
                      $("#content").html(data);
                  });
              }
          });
      });
      