function changePasswordVisibilitySignup() {
    var passwordFieldSignup = document.getElementById("signupPassword");
    if (passwordFieldSignup.type === "password") {
      passwordFieldSignup.type = "text";
    } else {
      passwordFieldSignup.type = "password";
    }
  }

function changePasswordVisibilityLogin() {

    var passwordFieldLogin = document.getElementById("loginPassword");
    if (passwordFieldLogin.type === "password") {
      passwordFieldLogin.type = "text";
    } else {
      passwordFieldLogin.type = "password";
    }
  }

function changePasswordVisibilityAccountsettingNewPassword() {
    var passwordFieldAccountsettingNewPassword = document.getElementById("accountsettingNewPassword");
    if (passwordFieldAccountsettingNewPassword.type === "password") {
      passwordFieldAccountsettingNewPassword.type = "text";
    } else {
      passwordFieldAccountsettingNewPassword.type = "password";
    }
  }

  function changePasswordVisibilityAccountsettingOldPassword() {
    var passwordFieldAccountsettingOldPassword = document.getElementById("accountsettingOldPassword");
    if (passwordFieldAccountsettingOldPassword.type === "password") {
      passwordFieldAccountsettingOldPassword.type = "text";
    } else {
      passwordFieldAccountsettingOldPassword.type = "password";
    }
  }