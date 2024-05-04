var carritoVisible = false;
if (document.readyState == "loading") {
  document.addEventListener("DOMContentLoaded", ready);
} else {
  ready();
}

function ready() {
  var botonesEliminarItem = document.getElementsByClassName("btn-eliminar");
  for (var i = 0; i < botonesEliminarItem.length; i++) {
    var button = botonesEliminarItem[i];
    button.addEventListener("click", eliminarItemCarrito);
  }

  var botonesRestarCantidad =
    document.getElementsByClassName("restar-cantidad");
  for (var i = 0; i < botonesRestarCantidad.length; i++) {
    var button = botonesRestarCantidad[i];
    button.addEventListener("click", restarCantidad);
  }

  var botonesSumarCantidad = document.getElementsByClassName("sumar-cantidad");
  for (var i = 0; i < botonesSumarCantidad.length; i++) {
    var button = botonesSumarCantidad[i];
    button.addEventListener("click", sumarCantidad);
  }

  var botonesAgregarAlCarrito = document.getElementsByClassName("boton-item");
  for (var i = 0; i < botonesAgregarAlCarrito.length; i++) {
    var button = botonesAgregarAlCarrito[i];
    button.addEventListener("click", agregarAlCarritoClicked);
  }

  document
    .getElementsByClassName("btn-pagar")[0]
    .addEventListener("click", pagarClicked);
}

function mostrarCarrito() {
    var carrito = document.querySelector('.carrito');
    var contenedor = document.querySelector('.contenedor');
    carrito.classList.add('carrito-visible');
    contenedor.classList.add('carrito-activo');
  }

  // Función para ocultar el carrito y eliminar la clase del contenedor
  function ocultarCarrito() {
    var carrito = document.querySelector('.carrito');
    var contenedor = document.querySelector('.contenedor');
    carrito.classList.remove('carrito-visible');
    contenedor.classList.remove('carrito-activo');
  }

  // Evento click para el botón de mostrar/ocultar carrito
  document.querySelector('.boton-item').addEventListener('click', function() {
    if (carritoVisible) {
      ocultarCarrito();
    } else {
      mostrarCarrito();
    }
    carritoVisible = !carritoVisible; // Cambiar el estado del carritoVisible
  });

function eliminarItemCarrito(event) {
  var buttonClicked = event.target;
  buttonClicked.parentElement.parentElement.remove();
  actualizarTotalCarrito();

  ocultarCarrito();
}


function actualizarTotalCarrito() {
    var carritoContenedor = document.getElementsByClassName("carrito")[0];
    var carritoItems = carritoContenedor.getElementsByClassName("carrito-item");
    var total = 0;
  
    for (var i = 0; i < carritoItems.length; i++) {
      var item = carritoItems[i];
      var precioElemento = item.getElementsByClassName("carrito-item-precio")[0];
      var precio = parseFloat(
        precioElemento.innerText.replace("$", "").replace(".", "")
      );
      var cantidadItem = item.getElementsByClassName("carrito-item-cantidad")[0];
      var cantidad = cantidadItem.value;
      total = total + precio * cantidad;
    }
    total = Math.round(total * 100) / 100;
  
    // Actualizar el contenido del span con el total
    var totalSpan = document.getElementById("total-carrito");
    totalSpan.innerText = "$" + total.toFixed(2);
  }
  

function ocultarCarrito() {
  var carritoItems = document.getElementsByClassName("carrito-items")[0];
  if (carritoItems.childElementCount == 0) {
    var carrito = document.getElementsByClassName("carrito")[0];
    carrito.style.marginRight = "-100";
    carrito.style.opacity = "0";
    carritoVisible = false;
  }
}

function sumarCantidad(event) {
  var buttonClicked = event.target;
  var selector = buttonClicked.parentElement;
  var cantidadActual = parseInt(selector.getElementsByClassName("carrito-item-cantidad")[0].value);
  var stockDisponible = 10; // Obtén el stock disponible del producto de alguna manera

  if (cantidadActual < stockDisponible) {
      cantidadActual++;
      selector.getElementsByClassName("carrito-item-cantidad")[0].value = cantidadActual;
      actualizarTotalCarrito();
  } else {
      alert("Lo sentimos, no hay suficiente stock disponible para aumentar la cantidad.");
  }
}

function restarCantidad(event) {
  var buttonClicked = event.target;
  var selector = buttonClicked.parentElement;
  var cantidadActual = parseInt(selector.getElementsByClassName("carrito-item-cantidad")[0].value);
  
  if (cantidadActual > 1) {
      cantidadActual--;
      selector.getElementsByClassName("carrito-item-cantidad")[0].value = cantidadActual;
      actualizarTotalCarrito();
  }
}

function agregarAlCarritoClicked(event) {
    var button = event.target;
    var item = button.parentElement;
    var titulo = item.getElementsByClassName("titulo-item")[0].innerText;
    var precio = item.getElementsByClassName("precio-item")[0].innerText;
    var imagenSrc = item.getElementsByClassName("img-item")[0].src;
    agregarItemAlCarrito(titulo, precio, imagenSrc);
  
    // Hacer visible el carrito después de agregar un artículo
    hacerVisibleCarrito();
  
    // Actualizar el total del carrito
    actualizarTotalCarrito();
  }
  

function agregarItemAlCarrito(titulo, precio, imagenSrc) {
  var item = document.createElement("div");
  item.classList.add = "item";
  var itemsCarrito = document.getElementsByClassName("carrito-items")[0];

  var nombresItemsCarrito = itemsCarrito.getElementsByClassName(
    "carrito-item-titulo"
  );
  for (var i = 0; i < nombresItemsCarrito.length; i++) {
    if (nombresItemsCarrito[i].innerText == titulo) {
      alert("El item ya se encuentra en el carrito");
      return;
    }
  }

  var itemCarritoContenido = `
    <div class="carrito-item"> 
        <img src="${imagenSrc}" alt="" width="80px">
        <div class="carrito-item-detalles">
            <span class="carrito-item-titulo">${titulo}</span>
            <div class="selector-cantidad">
                <i class="fa-solid fa-minus restar-cantidad"></i>
                <input type="number" value="1" class="carrito-item-cantidad">
                <i class="fa-solid fa-plus sumar-cantidad"></i>
            </div>
             <span class="carrito-item-precio">${precio}</span>
        </div>
        <span class="btn-eliminar">
           <i class="fa-solid fa-trash"></i>
        </span>
    </div>
    `;
  item.innerHTML = itemCarritoContenido;
  itemsCarrito.append(item);

  item
    .getElementsByClassName("btn-eliminar")[0]
    .addEventListener("click", eliminarItemCarrito);

  var botonSumarCantidad = item.getElementsByClassName("sumar-cantidad")[0];
  botonSumarCantidad.addEventListener("click", sumarCantidad);

  var botonRestarCantidad = item.getElementsByClassName("restar-cantidad")[0];
  botonRestarCantidad.addEventListener("click", restarCantidad);
}

function pagarClicked(event) {
  alert("Gracias por su compraaaa");
  window.location.href =
    "../../FRESAS_ARTURO/model/Detalleventa.php?total=" + total;

  var carritoItems = document.getElementsByClassName("carrito-items")[0];
  while (carritoItems.hasChildNodes) {
    carritoItems.removeChild(carritoItems.firstChild);
  }
  actualizarTotalCarrito();
  ocultarCarrito();
}

function hacerVisibleCarrito() {
    carritoVisible = true;
    var carrito = document.getElementsByClassName("carrito")[0];
    carrito.style.marginRight = "0";
    carrito.style.opacity = "1";
    carrito.classList.add("carrito-visible"); // Agregar la clase carrito-visible
  
    var items = document.getElementsByClassName("contenedor-items")[0];
    items.style.width = "60";
  }
  

(function () {
  const listElements = document.querySelectorAll(".menu__item--show");
  const list = document.querySelector(".menu__links");
  const menu = document.querySelector(".menu__hamburguer");

  const addClick = () => {
    listElements.forEach((element) => {
      element.addEventListener("click", () => {
        let subMenu = element.children[1];
        let height = 0;
        element.classList.toggle("menu__item--active");

        if (subMenu.clientHeight === 0) {
          height = subMenu.scrollHeight;
        }

        subMenu.style.height = `${height}px`;
      });
    });
  };

  function generarFactura(nombreCliente) {
    var clienteTelefono = prompt(
      "Por favor ingrese su número de teléfono para contactarlo:"
    );

    // Verificar si el cliente ingresó un número de teléfono válido
    if (clienteTelefono !== null && clienteTelefono !== "") {
      var facturaHTML =
        "<html><head><title>Orden de pedido</title><style>table {margin: 0 auto; text-align: center; border-collapse: collapse; width: 80%;} th, td {padding: 10px; border: 1px solid #ddd;} th {background-color: #f2f2f2;} tr:nth-child(even) {background-color: #f2f2f2;} tr:hover {background-color: #ddd;} button {padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;} button:hover {background-color: #45a049;}</style></head><body>";

      facturaHTML += "<style>";
      facturaHTML += "body {";
      facturaHTML +=
        "  font-family: Arial, sans-serif;  /* Set a friendly font */";
      facturaHTML += "}";
      facturaHTML += 'h2 {';
      facturaHTML += '  text-align: center;  /* Center the title */';
      facturaHTML += '  background-color: #d22c5d;  /* Changed background color to #d22c5d */';
      facturaHTML += '  color: white;  /* White text for better contrast */';
      facturaHTML += '  padding: 15px;  /* Add some padding for aesthetics */';
      facturaHTML += '  margin-bottom: 20px;  /* Add some space below the title */';
      facturaHTML += '}';
      facturaHTML += 'hr{';
      facturaHTML += ' border: none; ';
      facturaHTML += ' border-top: 1px solid #ccc;';
      facturaHTML += ' margin: 10px 0;';
      facturaHTML += "table {";
      facturaHTML += "  margin: 0 auto;  /* Center the table horizontally */";
      facturaHTML += "  text-align: center;  /* Center table content */";
      facturaHTML +=
        "  border-collapse: collapse;  /* Remove gaps between table cells */";
      facturaHTML += "  width: 80%;  /* Set table width */";
      facturaHTML += "}";
      facturaHTML += "th, td {";
      facturaHTML += "  padding: 10px;  /* Add padding for readability */";
      facturaHTML +=
        "  border: 1px solid #ddd;  /* Light border for separation */";
      facturaHTML += "}";
      facturaHTML += "th {";
      facturaHTML += "   background-color: #d22c5d;";
      facturaHTML += "   color: white;  /* Light background for headers */";
      facturaHTML += "}";
      facturaHTML += "tr:nth-child(even) {"; /* Alternate row colors */
      facturaHTML +=
        "  background-color: #fbfbfb;  /* Slightly lighter background */";
      facturaHTML += "}";
      facturaHTML += "tr:hover {"; /* Highlight rows on hover */
      facturaHTML += "  background-color: #ddd;  /* Light yellow on hover */";
      facturaHTML += "}";
      facturaHTML += "button {";
      facturaHTML += "  padding: 10px 20px;  /* Adjust button size */";
      facturaHTML += "  background-color: #4CAF50;  /* Green button color */";
      facturaHTML += "  color: white;  /* White text */";
      facturaHTML += "  border: none;  /* Remove border */";
      facturaHTML += "  cursor: pointer;  /* Indicate clickable element */";
      facturaHTML += "}";
      facturaHTML += "button:hover {";
      facturaHTML +=
        "  background-color: #45a049;  /* Darken button on hover */";
      facturaHTML += "}";
      facturaHTML += ".total {"; /* Style the total section */
      facturaHTML += "  text-align: center;  /* Center the total */";
      facturaHTML += "  margin-top: 20px;  /* Add space above the total */";
      facturaHTML += "  font-weight: bold;  /* Make total text bold */";
      facturaHTML += "}";
      facturaHTML += "</style></head><body>";

      facturaHTML +=
        '<h2 style="text-align: center;">Factura</h2>';
      facturaHTML +=
        '<div style="text-align: center; margin-top: 20px;"><strong>Cliente: ' +
        nombreCliente +
        "</strong></div><br><br>";

      var carritoItems = document.getElementsByClassName("carrito-item");
      var totalFactura = 0;

      facturaHTML += "<table>";
      facturaHTML +=
        "<tr><th>Producto</th><th>Cantidad</th><th>Subtotal</th></tr>";

      for (var i = 0; i < carritoItems.length; i++) {
        var item = carritoItems[i];
        var titulo = item.getElementsByClassName("carrito-item-titulo")[0]
          .innerText;
        var cantidad = item.getElementsByClassName("carrito-item-cantidad")[0]
          .value;
        var precio = item
          .getElementsByClassName("carrito-item-precio")[0]
          .innerText.replace("$", "")
          .trim();
        var subtotal = parseFloat(precio) * parseInt(cantidad);

        facturaHTML +=
          "<tr><td>" +
          titulo +
          "</td><td>" +
          cantidad +
          "</td><td>$" +
          subtotal.toFixed(2) +
          "</td></tr>";

        totalFactura += subtotal;
      }

      facturaHTML += "</table>";
      facturaHTML +=
        '<div style="text-align: center; margin-top: 20px;"><strong>Total: $' +
        totalFactura.toFixed(2) +
        "</strong></div>";
      facturaHTML += '<hr></hr>';
      facturaHTML += '<div style= "text-align: center;"><h3> Punto de entrega: </h3></div>';
      facturaHTML += '<hr></hr>';
      facturaHTML +=
        '<div style="text-align: center; margin-top: 20px;"><strong> <iframe src="https://www.google.com/maps/embed?pb=!4v1712244664020!6m8!1m7!1sRDBJoDeE7t7tY7dNPKuKxg!2m2!1d5.604168509472387!2d-72.91032554650138!3f292.2!4f-3.1700000000000017!5f0.7820865974627469" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></strong></div>';
      facturaHTML +=
        '<div style="text-align: center; margin-top: 20px;"><button onclick="window.close();">Volver al catálogo</button></div>';
      facturaHTML += "</body></html>";

      // Mostrar la factura en una ventana emergente
      var facturaWindow = window.open("", "_blank", "width=600,height=800");
      facturaWindow.document.write(facturaHTML);
      facturaWindow.document.close();

      // Obtener cantidadProductos y precioTotal
      var cantidadProductos = carritoItems.length;
      var precioTotal = totalFactura.toFixed(2);

      // Guardar factura en la base de datos
      guardarFacturaEnBD(
        nombreCliente,
        clienteTelefono,
        cantidadProductos,
        precioTotal
      );
    } else {
      alert("Por favor ingrese un número de teléfono válido.");
    }
  }

  function guardarFacturaEnBD(
    nombreCliente,
    telefono,
    cantidadProductos,
    precioTotal
  ) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../FRESAS_ARTURO/controller/Detalleventa.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // La factura se guardó exitosamente
          alert("La factura se guardó correctamente en la base de datos.");
        } else {
          // Ocurrió un error al guardar la factura
          alert("Factura Generada.");
        }
      }
    };

    var facturaData = {
      nombreCliente: nombreCliente,
      telefono: telefono,
      cantidadProductos: cantidadProductos,
      precioTotal: precioTotal,
    };

    xhr.send(JSON.stringify(facturaData));
  }

  document.body.addEventListener("click", function (event) {
    if (event.target && event.target.id === "btn-generar-factura") {
        var nombreCliente = event.target.getAttribute("data-nombre-cliente");
        generarFactura(nombreCliente);
    }
});

  const deleteStyleHeight = () => {
    listElements.forEach((element) => {
      if (element.children[1].getAttribute("style")) {
        element.children[1].removeAttribute("style");
        element.classList.remove("menu__item--active");
      }
    });
  };

  window.addEventListener("resize", () => {
    if (window.innerWidth > 800) {
      deleteStyleHeight();
      if (list.classList.contains("menu__links--show"))
        list.classList.remove("menu__links--show");
    } else {
      addClick();
    }
  });

  if (window.innerWidth <= 800) {
    addClick();
  }

  menu.addEventListener("click", () =>
    list.classList.toggle("menu__links--show")
  );
})();