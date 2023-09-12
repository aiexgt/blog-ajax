"use strict";

const btnLogin = $("#btn_login");
const btnBuscar = $("#btn_buscar");

const input_termino = $("#input_termino");
const input_fecha_inicio = $("#input_fecha_inicio");
const input_fecha_fin = $("#input_fecha_fin");

const content_blog = $("#content_blog");

const mostrarArticulos = () => {
  const terminos = input_termino.val() || null;
  const fecha_inicio = input_fecha_inicio.val() || null;
  const fecha_fin = input_fecha_fin.val() || null;

  $.post(
    "./app/index-ajax.php",
    {
      fnc: "mostrar_articulos",
      terminos,
      fecha_inicio,
      fecha_fin,
    },
    (response) => {
      const data = JSON.parse(response);

      if (data.status == "success") {
        let html = "";

        data.message.forEach((i) => {
          html += `
            <div class="container mt-4 mb-4 p-4 rounded shadow bg-white">
                <div class="row mt-2">
                    <div class="col-10">
                        <h2>${i.titulo}</h2>
                        <small>${moment(i.fecha_creacion).format("DD/MM/YYYY HH:mm A")} - ${i.nombre} ${i.apellidos || ""}</small>
                    </div>
                    <div class="col-2 text-end">
                        <button class="btn btn-danger bg-bac" onclick="abrirPDF('${
                          i.archivo
                        }')"><i class="bi bi-filetype-pdf"></i> Descargar</button>
                    </div>
                </div>
          `;

          if (i.imagen) {
            html += `
                  <div class="row mt-2">
                  <div class="col-8">
                      <p class="text-justify  ">${i.descripcion}</p>
                  </div>
                  <div class="col-4">
                      <img src="./uploads/${i.imagen}" style="width:100%; height:auto; max-height:400px;" alt="">
                  </div>
              </div>
    
            `;
          } else {
            html += `
                  <div class="row mt-2">
                  <div class="col-12">
                      <p class="text-justify  ">${i.descripcion}</p>
                  </div>
              </div>
    
            `;
          }

          html += `</div>`;
        });

        content_blog.html(html);
        return;
      } else if (data.status == "notfound") {
        content_blog.html(`
          <div class="container mt-4 mb-4 p-4 rounded shadow bg-white">
            <h2>No se encontraron resultados</h2>
          </div>
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

const abrirPDF = (file) => {
  window.open("./uploads/" + file, "_blank");
};

btnBuscar.click(mostrarArticulos);

btnLogin.click(() => {
  window.location = "./login.php";
});

input_termino.keyup((event) => {
  if (event.keyCode == 13) {
    mostrarArticulos();
  }
});

input_fecha_inicio.keyup((event) => {
  if (event.keyCode == 13) {
    mostrarArticulos();
  }
});

input_fecha_fin.keyup((event) => {
  if (event.keyCode == 13) {
    mostrarArticulos();
  }
});

$(document).ready(() => {
  mostrarArticulos();
});
