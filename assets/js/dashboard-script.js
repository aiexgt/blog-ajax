"use strict";

const btn_buscar = $("#btn_buscar");
const btn_blog = $("#btn_blog");
const btn_login = $("#btn_login");
const btn_user = $("#btn_user");

const input_termino = $("#input_termino");

const content_blog = $("#content_blog");

const input_titulo = $("#input_titulo");
const input_descripcion = $("#input_descripcion");
const input_imagen = $("#input_imagen");
const input_pdf = $("#input_pdf");

const btn_guardar = $("#btn_guardar");
const btn_cerrar = $("#btn_cerrar");

const modal_agregar_articulo = $("#modal_agregar_articulo");

const mostrarArchivo = (file) => {
  window.open("./uploads/" + file, "_blank");
};

const mostrarArticulos = () => {
  const terminos = input_termino.val() || null;

  $.post(
    "./app/dashboard-ajax.php",
    {
      fnc: "mostrar_articulos",
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
                    <td>${i.titulo}</td>
                    <td>${i.descripcion || ""}</td>
                    <td>${moment(i.fecha_creacion).format("DD/MM/YYYY HH:mm A")}</td>
                    <td onclick="mostrarArchivo('${i.archivo}')" class="text-primary pointer">${i.archivo || ""}</td>
                    <td onclick="mostrarArchivo('${i.imagen}')" class="text-primary pointer">${i.imagen || ""}</td>
                    <td><button class="btn btn-danger" onclick="eliminarArticulo(${
                      i.id
                    })"><i class="bi bi-trash"></i></button></td>
                </tr>
            `;
        });

        content_blog.html(html);
        return;
      } else if (data.status == "notfound") {
        content_blog.html(`
            <tr>
                <td colspan="7">No hay artículos.</td>
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

const agregarArticulo = () => {
  const titulo = input_titulo.val();
  const descripcion = input_descripcion.val();
  const imagen = input_imagen.val();
  const pdf = input_pdf.val();

  if (!titulo || !pdf) {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Título y archivo PDF son obligatorios!",
    });
    return;
  }

  let formData = new FormData();
  formData.append("fnc", "agregar_articulo");
  formData.append("titulo", titulo);
  formData.append("descripcion", descripcion);

  if (imagen) {
    const ImagenFile = input_imagen[0].files[0];
    formData.append("imagen", ImagenFile);
  }

  const PDFFile = input_pdf[0].files[0];
  formData.append("pdf", PDFFile);

  $.ajax({
    url: "./app/dashboard-ajax.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      const data = JSON.parse(response);

      if (data.status == "success") {
        mostrarArticulos();
        limpiarFormulario();
        modal_agregar_articulo.modal("hide");
        Swal.fire("Buen trabajo!", "Se ha añadido el artículo!", "success");
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: data.message,
        });
      }
    },
  });
};

const eliminarArticulo = (id) => {
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
          "./app/dashboard-ajax.php",
          {
            fnc: "eliminar_articulo",
            id,
          },
          (response) => {
            const data = JSON.parse(response);

            if (data.status == "success") {
              mostrarArticulos();
              Swal.fire("Buen trabajo!", "Se ha eliminado el artículo!", "success");
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
  input_titulo.val("");
  input_descripcion.val("");
  input_imagen.val("");
  input_pdf.val("");
};

input_termino.keyup((event) => {
  if (event.keyCode == 13) {
    mostrarArticulos();
  }
});

btn_blog.click(()=>{
  window.open("./index.php", "_blank");
})

btn_login.click(()=>{
  window.location = "./login.php";
})

btn_user.click(()=>{
  window.location = "./user.php";
})



btn_guardar.click(agregarArticulo);

btn_cerrar.click(limpiarFormulario);

$(document).ready(() => {
  mostrarArticulos();
});
