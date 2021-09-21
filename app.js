$(document).ready(function () {
  $("#signup").click(function () {
    // Firstly hide all inputs tag with id and using jquery hide() function
    const name=$("#name").val();
    const email = $("#email").val();
    const password = $("#password").val();
    const cpassword = $("#cpassword").val();
    const description = $("#desc").val();

    if (name.length == "") {
      $(".name").addClass("is-invalid");
    } else {
      $(".name").removeClass("is-invalid");
    }

    if (email.length == "") {
      $(".email").addClass("is-invalid");
    } else {
      $(".email").removeClass("is-invalid");
    }

    if (password.length == "") {
      $(".password").addClass("is-invalid");
    } else {
      $(".password").removeClass("is-invalid");
    }

    if (cpassword.length == "") {
      $(".cpassword").addClass("is-invalid");
    } else {
      $(".cpassword").removeClass("is-invalid");
    }

    var name_error = true;
    var email_error = true;
    var password_error = true;
    var cpassword_error = true;

    //For Name;
    $("#name").keyup(function () {
      namecheck();
    });
    function namecheck() {
      var name = $("#name").val();
      if (name.length == "") {
        $(".name").addClass("is-invalid");
        $(".nameerror").show();
        $(".nameerror").html("**Please fill name");
        $(".nameerror").focus();
        $(".nameerror").css("color", "red");
        name_error = false;
        return false;
      } else {
        $(".name").removeClass("is-invalid");
        $(".nameerror").hide();
      }

      if (name.length < 3 || name.length > 20) {
        $(".name").addClass("is-invalid");
        $(".nameerror").show();
        $(".nameerror").html("**User Name must be between 3 to 20");
        $(".nameerror").focus();
        $(".nameerror").css("color", "red");
        name_error = false;
        return false;
      } else {
        $(".name").removeClass("is-invalid");
        $(".nameerror").hide();
      }
    }

    //For  Mail
    $("#email").keyup(function () {
      mailcheck();
    });
    function mailcheck() {
      var email = $("#email").val();
      if (email.length == "") {
        $(".email").addClass("is-invalid");
        $(".emailError").show();
        $(".emailError").html("**Please fill email");
        $(".emailError").focus();
        $(".emailError").css("color", "red");
        email_error = false;
        return false;
      } else {
        $(".email").removeClass("is-invalid");
        $(".emailError").hide();
      }

      if (email.length < 3 || name.length > 20) {
        $(".email").addClass("is-invalid");
        $(".emailError").show();
        $(".emailError").html("**Email must be contain @ and .com");
        $(".emailError").focus();
        $(".emailError").css("color", "red");
        email_error = false;
        return false;
      } else {
        $(".email").removeClass("is-invalid");
        $(".emailError").hide();
      }
    }

  // For password
    $("#password").keyup(function () {
      passcheck();
    });
    function passcheck() {
      var password = $("#password").val();
      if (password.length == "") {
       
        $(".passerror").show();
        $(".passerror").html("**Please fill Password");
        $(".passerror").focus();
        $(".passerror").css("color", "red");
        password_error = false;
        return false;
      } else {
        
        $(".passerror").hide();
      }

      if (password.length < 8) {
        
        $(".passerror").show();
        $(".passerror").html(
          "**Password must be strong minimum 8 char inlcuding special symbols"
        );
        $(".passerror").focus();
        $(".passerror").css("color", "red");
        password_error = false;
        return false;
      } else {
        $(".password").removeClass("is-invalid");
        $(".passerror").hide();
      }
  
    }

    // For CPassword
    $("#cpassword").keyup(function () {
      cpasscheck();
    });
    function cpasscheck() {
      var cpassword = $("#cpassword").val();
      var password = $("#password").val();
      if (password != cpassword) {       
        $(".cpaserror").show();
        $(".cpaserror").html("**Password are not matching");
        $(".cpaserror").focus();
        $(".cpaserror").css("color", "red");
        cpassword_error = false;
        return false;
      } else {
        
        $(".cpaserror").hide();
      }
    }

    

    if (
      name_error == true &&
      email_error == true &&
      password_error == true &&
      cpassword_error == true
    ) {
      $.ajax({
        type: "POST",
        url: "action.php?action=1",
        data: {
          name: name,
          email: email,
          password: password,
          cpassword: cpassword,
          description: description,
        },
        dataType: "JSON",
        success: function (feedback) {
          if (feedback.status === "error") {
            $(".email").addClass("is-invalid");
            $(".emailError").html(feedback.message);
          } else if (feedback.status === "passerror") {
            $(".password").addClass("is-invalid");
            $(".passerror").html(feedback.message);
          } else if (feedback.status === "success") {
            window.location = "login.php";
          }
        },
      });
    }
  });

  // User login

  $("#login").click(function () {
    const email = $("#email").val();
    const password = $("#password").val();
    if (email.length == "") {
      $(".email").addClass("is-invalid");
    } else {
      $(".email").removeClass("is-invalid");
    }

    if (password.length == "") {
      $(".password").addClass("is-invalid");
    } else {
      $(".password").removeClass("is-invalid");
    }

    // console.log(email);

    if (email.length != "" && password.length != "") {
      $.ajax({
        type: "POST",
        url: "action.php?action=2",
        data: { email: email, password: password },
        dataType: "JSON",
        success: function (feedback) {
          //    console.log(feedback);
          if (feedback.status === "success") {
            window.location = "home.php";
          } else if (feedback.status === "passwordError") {
            $(".password").addClass("is-invalid");
            $(".passwordError").html(feedback.message);
            $(".email").removeClass("is-invalid");
            $(".emailError").html("");
          } else if (feedback.status === "emailError") {
            $(".password").removeClass("is-invalid");
            $(".passwordError").html("");
            $(".email").addClass("is-invalid");
            $(".emailError").html(feedback.message);
          }
        },
      });
    }
  });

  // Admin Update
  // For Admin Data display
  $("#displaydata").click(function () {
    $.ajax({
      url: "action.php?action=3",
      type: "GET",
      data: {},
      success: function (data) {
        console.log("data print successfully to edit");
      },
    });
  });

  $(document).on("click", "a[data-role=update]", function () {
    // alert($(this).data('id'));
    var id = $(this).data("id");
    var name = $("#" + id)
      .children("td[data-target=name]")
      .text();
    var email = $("#" + id)
      .children("td[data-target=email]")
      .text();
    var description = $("#" + id)
      .children("td[data-target=description]")
      .text();
    // var temp=id;
    $("#name").val(name);
    $("#email").val(email);
    $("#description").val(description);
    // $("#userID").val(id);
    $("input[name=userID]").val(id);
    $("#myModal").modal("toggle");
  });

  $("#save").click(function () {
    const id = $("input[name=userID]").val();
    const name = $("#name").val();
    const email = $("#email").val();
    const description = $("#description").val();
    // alert(id);

    $.ajax({
      url: "action.php?action=4",
      method: "POST",
      data: {
        id: id,
        name: name,
        email: email,
        description: description,
      },
      success: function (data) {
        // console.log(data);
        $("#" + id)
          .children("td[data-target=name]")
          .text(name);
        $("#" + id)
          .children("td[data-target=email]")
          .text(email);
        $("#" + id)
          .children("td[data-target=description]")
          .text(description);
        $("#myModal").modal("toggle");
      },
    });
  });
});
