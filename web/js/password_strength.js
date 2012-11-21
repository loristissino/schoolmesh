$(function() {
$('.password').pstrength();
});

function passwordfocus()
{
  $('#userinfo_current_password').focus();
  loadCapsChecker();
}

window.onload = passwordfocus;
