"use strict";

const btn_buscar = $("#btn_buscar");
const btn_blog = $("#btn_blog");
const btn_login = $("#btn_login");
const btn_articulos = $("#btn_articulos");

const input_termino = $("#input_termino");

const content_user = $("#content_user");

const input_nombre = $("#input_nombre");
const input_apellido = $("#input_apellido");
const input_email = $("#input_email");
const input_usuario = $("#input_usuario");
const input_password = $("#input_password");

const btn_guardar = $("#btn_guardar");
const btn_cerrar = $("#btn_cerrar");

const modal_agregar_usuario = $("#modal_agregar_usuario");

const mostrarUsuarios = () => {
  const terminos = input_termino.val() || null;

  $.post(
    "./app/user-ajax.php",
    {
      fnc: "mostrar_usuarios",
      terminos,
    },
    (response) => {
      const data = JSON.parse(response);

      if (data.status == "success") {
        let html = "";

        data.message.forEach((i) => {
          html += `
                <tr>
                    <td>${i.id}</td>
                    <td>${i.nombre}</td>
                    <td>${i.apellidos || ""}</td>
                    <td>${i.email || ""}</td>
                    <td>${i.usuario || ""}</td>
                    <td><button class="btn btn-danger" onclick="eliminarUsuario(${
                      i.id
                    })"><i class="bi bi-trash"></i></button></td>
                </tr>
            `;
        });

        content_user.html(html);
        return;
      } else if (data.status == "notfound") {
        content_user.html(`
            <tr>
                <td colspan="6">No hay usuarios.</td>
            </tr>
          `);
        return;
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Ha ocurrido un error!",
        });
        return;
      }
    }
  );
};

const agregarUsuario = () => {
  const nombre = input_nombre.val();
  const apellidos = input_apellido.val();
  const email = input_email.val();
  const usuario = input_usuario.val();
  const password = input_password.val();

  if (!nombre || !usuario || !password) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Nombre, usuario y contraseña son obligatorios!",
    });
    return;
  }

  $.post(
    "./app/user-ajax.php",
    {
      fnc: "agregar_usuario",
      nombre,
      apellidos,
      email,
      usuario,
      password,
    },
    (response) => {
      const data = JSON.parse(response);

      if (data.status == "success") {
        mostrarUsuarios();
        limpiarFormulario();
        modal_agregar_usuario.modal("hide");
        Swal.fire("Buen trabajo!", "Se ha añadido el usuario!", "success");
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: data.message,
        });
      }
    }
  );
};

const eliminarUsuario = (id) => {
  if (id > 0) {
    Swal.fire({
      title: "Estas seguro?",
      text: "Este cambio es irreversible!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(
          "./app/user-ajax.php",
          {
            fnc: "eliminar_usuario",
            id,
          },
          (response) => {
            const data = JSON.parse(response);

            if (data.status == "success") {
              mostrarUsuarios();
              Swal.fire("Buen trabajo!", "Se ha eliminado el usuario!", "success");
            } else {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ha ocurrido un error!",
              });
            }
          }
        );
      }
    });
  }
};

const limpiarFormulario = () => {
  input_nombre.val("");
  input_apellido.val("");
  input_email.val("");
  input_usuario.val("");
  input_password.val("");
};

input_termino.keyup((event) => {
  if (event.keyCode == 13) {
    mostrarUsuarios();
  }
});

btn_blog.click(() => {
  window.open("./index.php", "_blank");
});

btn_login.click(() => {
  window.location = "./login.php";
});

btn_articulos.click(() => {
  window.location = "./dashboard.php";
});

btn_guardar.click(agregarUsuario);

btn_cerrar.click(limpiarFormulario);

$(document).ready(() => {
  mostrarUsuarios();
});
