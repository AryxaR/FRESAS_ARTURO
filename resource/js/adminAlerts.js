document.addEventListener("DOMContentLoaded", function(){

            // ALERTA DE COPIA DE SEGURIDAD
            if (window.location.search.includes('msj_copia')) {
                Swal.fire({
                    title: "Good job!",
                    text: "Copia de seguridad generada exitosamente>",
                    icon: "success"
                });
            }
            // ALERTA ERROR COPIA
            if (window.location.search.includes('msj_error_copia')) {
                
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Error al generar la copia de seguridad",
                    footer: '<a href="#">Why do I have this issue?</a>'
                });
            }
            // ALERT DE RESTAURAR COPIA
            if (window.location.search.includes('msj_restaurar')) {
                
                Swal.fire({
                    title: "Good job!",
                    text: "Copia de seguridad restaurada exitosamente.",
                    icon: "success"
                });
            }
            // ALERT ERROR RESTAURAR COPIA
            if (window.location.search.includes('msj_error_restaurar')) {
                
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Error al restaurar la copia de seguridad",
                    // footer: '<a href="#">Why do I have this issue?</a>'
                });
            }
        });
