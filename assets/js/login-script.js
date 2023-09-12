"use strict";

const btn_operaciones = $("#btn_operaciones");
const btn_login = $("#btn_login");

const input_user = $("#input_user");
const input_pass = $("#input_pass");

const iniciarSesion = () => {
  const user = input_user.val();
  const pass = input_pass.val();

  if (!user || !pass) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Ingrese credenciales!",
    });
    return;
  }

  $.post(
    "./app/login-ajax.php",
    {
      fnc: "iniciar_sesion",
      user,
      pass,
    },
    (response) => {
      const data = JSON.parse(response);

      if (data.status == "success") {
        window.location = "./dashboard.php";
        return;
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Credenciales incorrectas!",
        });
        return;
      }
    }
  );
};

btn_login.click(iniciarSesion);

input_user.keyup((event) => {
  if (event.keyCode == 13) {
    iniciarSesion();
  }
});

input_pass.keyup((event) => {
  if (event.keyCode == 13) {
    iniciarSesion();
  }
});

btn_operaciones.click(() => {
  window.location = "./index.php";
});
