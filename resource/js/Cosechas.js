document.addEventListener("DOMContentLoaded", function() {
    // Aquí se simularían los datos de la base de datos
    const dataFromDatabase = [
        { id_lote: 1, fecha_recogida: "2024-05-07", id_producto: 123, cantidad_recogida_extra: 10, cantidad_recogida_primera: 20, cantidad_recogida_segunda: 15, cantidad_recogida_riche: 5 },
        { id_lote: 2, fecha_recogida: "2024-05-08", id_producto: 456, cantidad_recogida_extra: 12, cantidad_recogida_primera: 18, cantidad_recogida_segunda: 20, cantidad_recogida_riche: 8 },
        // Aquí irían más datos de la base de datos
    ];

    const datatableBody = document.getElementById("datatable-body");

    // Iterar sobre los datos y agregar filas a la tabla
    dataFromDatabase.forEach(data => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${data.id_lote}</td>
            <td>${data.fecha_recogida}</td>
            <td>${data.id_producto}</td>
            <td>${data.cantidad_recogida_extra}</td>
            <td>${data.cantidad_recogida_primera}</td>
            <td>${data.cantidad_recogida_segunda}</td>
            <td>${data.cantidad_recogida_riche}</td>
        `;
        datatableBody.appendChild(row);
    });
});
