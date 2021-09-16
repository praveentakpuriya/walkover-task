$(document).ready(function () {
  $("#signup").click(function () {
    const name = $("#name").val();
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

    if (
      name.length != "" &&
      email.length != "" &&
      password.length != "" &&
      cpassword.length != ""
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
      data:{},
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
