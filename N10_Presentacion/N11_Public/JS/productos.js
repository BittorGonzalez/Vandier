$(document).ready(function() {
    // Datos que deseas enviar en el cuerpo de la solicitud (puedes personalizar esto según tus necesidades)
    var requestData = {
        "tipo": "obtenerProductosAdmin"
    };

    // Realizar una solicitud AJAX al servidor para obtener los datos
    $.ajax({
        url: '../N20_Negocio/N21_Controladores/productosControlador.php',
        method: 'POST', // Cambiar a 'POST' si es necesario
        contentType: 'application/json', // Especificar el tipo de contenido JSON
        data: JSON.stringify(requestData), // Convertir los datos a formato JSON
        dataType: 'json',
        success: function(data) {
            // Inicializar la tabla con los datos del backend
            if (data.status === "success") {
                window.location.reload();
            
                // Puedes realizar acciones adicionales aquí si es necesario
            } else {
                console.error("Error del servidor: " + data.message);
            }
            
            var editor = new $.fn.dataTable.Editor({
                ajax: {
                    create: {
                        type: 'POST',
                        url: '../N20_Negocio/N21_Controladores/productosControlador.php?action=create'
                    },
                    edit: {
                        type: 'POST',
                        url: '../N20_Negocio/N21_Controladores/productosControlador.php?action=edit'
                    },
                    remove: {
                        type: 'DELETE',
                        url: '../N20_Negocio/N21_Controladores/productosControlador.php?action=remove'
                    }
                },
                table: '#tablaProductos',
                idSrc: 'idProducto',
                fields: [
                    { label: 'imagen', name: 'imagen' },
                    { label: 'nombre', name: 'nombre' },
                    { label: 'descripcion', name: 'descripcion' },
                    { label: 'precio', name: 'precio' },
                    { label: 'stock', name: 'stock' },
                    { label: 'categoria', name: 'categoria' },
                    { label: 'codReferencia', name: 'codReferencia' }
                ]
            });

            $('#tablaProductos').DataTable({
                dom: 'Bfrtip',
                data: data, 
                columns: [
                    { data: 'imagen' },
                    { data: 'nombre' },
                    { data: 'descripcion' },
                    { data: 'precio' },
                    { data: 'stock' },
                    { data: 'categoria' },
                    { data: 'codReferencia' }
                ],
                select: true,
                buttons: [
                    { extend: 'create', editor: editor },
                    { extend: 'edit', editor: editor },
                    { extend: 'remove', editor: editor }
                ]
            });
        },
        error: function(error) {
            console.error('Error al obtener datos del servidor:', error);
        }
    });
});
