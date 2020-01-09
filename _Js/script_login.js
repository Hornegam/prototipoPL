
function showpasswd(){
    var x = document.getElementById("login-input-password")
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}