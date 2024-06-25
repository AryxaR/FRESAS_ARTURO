document.addEventListener("DOMContentLoaded", function(){
            // ALERT ERROR RESTAURAR COPIA
            if (window.location.search.includes('msj_file')) {
                
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "No ha seleccionado un archivo aun",
                    // footer: '<a href="#">Why do I have this issue?</a>'
                });
            }
            // ALERT ERROR RESTAURAR COPIA
            if (window.location.search.includes('msj_restaurar')) {
                
                Swal.fire({
                    title: "Realizado",
                    text: "Restauracion exitosa",
                    icon: "success"
                });
            }
        });
