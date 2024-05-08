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
  console.log(itemsCarrito)

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
  
  function generarFactura() {
    // Recopilar los datos del carrito
    var carritoItems = document.getElementsByClassName("carrito-item");
    var itemsFactura = [];
    for (var i = 0; i < carritoItems.length; i++) {
        var item = carritoItems[i];
        var titulo = item.getElementsByClassName("carrito-item-titulo")[0].innerText;
        var cantidad = item.getElementsByClassName("carrito-item-cantidad")[0].value;
        var precioUnitario = item.getElementsByClassName("carrito-item-precio")[0].innerText;
        var subtotal = parseFloat(precioUnitario.replace("$", "")) * parseInt(cantidad);
        itemsFactura.push({
            titulo: titulo,
            cantidad: cantidad,
            precioUnitario: precioUnitario,
            subtotal: subtotal.toFixed(2)
        });
    }
    
    // Enviar los datos al backend
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../FRESAS_ARTURO/controller/Detalleventa.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Redireccionar a la página de la factura
            window.location.href = "../../FRESAS_ARTURO/controller/Detalleventa.php";
        }
    };
    xhr.send(JSON.stringify(itemsFactura));
}

;