$(document).ready(function() {
  $("#row_codigo").hide();
  $("#row_pass").hide();
  $("#row_success").hide();

  $("#btn-email").on("click", function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "recovery/sendCode",
      data: "email=" + $("#password-form-input-user").val(),
      success: function(data) {
        //console.table(data);
        if (data.error) {
          console.error(data.message);
          M.toast({
            html: `<span class='red-text'>${data.message}</span>`
          });
        } else {
          console.log(data.msg);
          M.toast({
            html: `<span class='white-text'>${data.message}</span>`
          });
          $("#row_email").hide();
          $("#row_codigo").show();
        }
      },
      error: function(e) {
        console.error(`ERROR JS: e`);
        M.toast({
          html:
            "⚠ Ocurrio un error al enviar sus datos, por favor recargue la pagina e intente de nuevo ⚠"
        });
      },
      beforeSend: function() {
        console.log("Inicio de envio de datos");
        console.group();
      },
      complete: function() {
        console.groupEnd();
        console.log("Fin de envio de datos");
      }
    });
  });

  $("#btn-codigo").on("click", function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "recovery/verifyCode",
      data:
        "email=" +
        $("#password-form-input-user").val() +
        "&code=" +
        $("#password-form-input-code").val(),
      success: function(data) {
        //console.table(data);
        if (data.error) {
          console.error(data.message);
          M.toast({
            html: `<span class='red-text'>${data.message}</span>`
          });
        } else {
          console.log(data.msg);
          M.toast({
            html: `<span class='white-text'>${data.message}</span>`
          });
          $("#row_codigo").hide();
          $("#row_pass").show();
        }
      },
      error: function(e) {
        console.error(`ERROR JS: ${e}`);
        M.toast({
          html:
            "⚠ Ocurrio un error al enviar sus datos, por favor recargue la pagina e intente de nuevo ⚠"
        });
      },
      beforeSend: function() {
        console.log("Inicio de envio de datos");
        console.group();
      },
      complete: function() {
        console.groupEnd();
        console.log("Fin de envio de datos");
      }
    });
  });

  $("#btn-submit").on("click", function(e) {
    e.preventDefault();

    let pass = $("#password-form-input-pass").val();
    let pass2 = $("#password-form-input-pass2").val();

    if (pass === pass2) {
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "recovery/changePass",
        data:
          "email=" +
          $("#password-form-input-user").val() +
          "&code=" +
          $("#password-form-input-code").val() +
          "&newpass=" +
          pass,
        success: function(data) {
          //console.table(data);
          if (data.error) {
            console.error(data.message);
            M.toast({
              html: `<span class='red-text'>${data.message}</span>`
            });
          } else {
            console.log(data.msg);
            M.toast({
              html: `<span class='white-text'>${data.message}</span>`
            });
            $("#row_pass").hide();
            $("#row_success").show();
          }
        },
        error: function(e) {
          console.error(`ERROR JS: ${e}`);
          M.toast({
            html:
              "⚠ Ocurrio un error al enviar sus datos, por favor recargue la pagina e intente de nuevo ⚠"
          });
        },
        beforeSend: function() {
          console.log("Inicio de envio de datos");
          console.group();
        },
        complete: function() {
          console.groupEnd();
          console.log("Fin de envio de datos");
        }
      });
    } else {
      M.toast({
        html: `Las contraseñas deben de coincidir.`
      });
    }
  });
});
