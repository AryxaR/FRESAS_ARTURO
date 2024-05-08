// Manejar clics en el botón de eliminar
document.querySelectorAll('.eliminar-btn').forEach(btn => {
  btn.addEventListener('click', function() {
      const id_producto = this.getAttribute('data-id');
      eliminarProducto(id_producto);
  });
});

// Función para eliminar un producto del carrito
function eliminarProducto(id_producto) {
  // Petición AJAX para eliminar el producto
  const xhr = new XMLHttpRequest();
  xhr.open('POST', '../FRESAS_ARTURO/controller/eliminar_producto.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
      if (xhr.status === 200) {
          // Actualizar el contenido del modal
          mostrarModalCarrito();
      } else {
          console.error('Error al eliminar el producto');
      }
  };
  xhr.send('id_producto=' + id_producto);
}
