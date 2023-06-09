
          
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

