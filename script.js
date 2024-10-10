$(document).ready(function () {
  function checkFirstName() {
    let firstNameValue = $("#firstName").val();
    if (firstNameValue.length > 15) {
      if ($("#fnError").text("FirstName should be less than 15 characters")) {
        return false;
      }
    } else {
      $("#fnError").text("");
    }
  }

  $("#firstName").keyup(function () {
    checkFirstName();
  });





  function checkLastName() {
    let lastNameValue = $("#lastName").val();
    if (lastNameValue.length > 15) {
      if ($("#InError").text("FirstName should be less than 15 characters")) {
        return false;
      }
    } else {
      $("#InError").text("");
    }
  }

  $("#lastName").keyup(function () {
    checkLastName();
  });





  function checkEmailAddress() {
    let emailAddressValue = $("#emailAddress").val();
    if (emailAddressValue.length >= 0) {
      if ($("#eaError").text("Email address should not be empty.")) {
        return false;
      }
    } else {
      $("#eaError").text("");
    }
  }

  $("#emailAddress").blur(function () {
    checkEmailAddress();
  });





  function checkPassword() {
    let passwordValue = $("#password").val();
    if (passwordValue.length <= 6 || passwordValue.length > 15) {
      if ($("#paError").text("Password must be between 6 to 15 characters")) {
        return false;
      }
    } else {
      $("#paError").text("");
    }
  }

  $("#password").keyup(function () {
    checkPassword();
  });





  function checkConfirmPassword() {
    let passwordValue = $("#password").val();
    let confirmPasswordValue = $("#confirmPassword").val();
    if (passwordValue == confirmPasswordValue) {
      if ($("#cpError").text("")) {
        return false;
      }
    } else {
      $("#cpError").text("Password and Confirm Password are not same.");
    }
  }

  $("#confirmPassword").keyup(function () {
    checkConfirmPassword();
  });





  function checkGenderStatus() {
    let radioBtn = $("input[type = 'radio']:checked");
    if (radioBtn.val()) {
      $("#geError").text("");
    } else {
      if ($("#geError").text("You must select one of them.")) {
        return false;
      }
    }
  }




  
  function checkSkillStatus() {
    let checkboxBtn = $("input[type = 'checkbox']:checked");

    if (checkboxBtn.val()) {
      $("#skError").text("");
    } else {
      if ($("#skError").text("You must select one of them.")) {
        return false;
      }
    }
  }

  $("#registrationForm").submit(function () {
    checkFirstName();
    checkLastName();
    checkEmailAddress();
    checkPassword();
    checkConfirmPassword();
    checkGenderStatus();
    checkSkillStatus();

    if (
      checkFirstName() == false ||
      checkLastName() == false ||
      checkEmailAddress() == false ||
      checkPassword() == false ||
      checkConfirmPassword() == false ||
      checkGenderStatus() == false ||
      checkSkillStatus() == false) {
        return false;
    } else {
      return true;
    }
  });
});
