$(document).ready(function() {
    // Datos que deseas enviar en el cuerpo de la solicitud (puedes personalizar esto según tus necesidades)
    var requestData = {
        "tipo": "obtenerUsuarios"
    };

    // Realizar una solicitud AJAX al servidor para obtener los datos
    $.ajax({
        url: '../N20_Negocio/N21_Controladores/usuariosControlador.php',
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
                        url: '../N20_Negocio/N21_Controladores/usuariosControlador.php?action=create'
                    },
                    edit: {
                        type: 'POST',
                        url: '../N20_Negocio/N21_Controladores/usuariosControlador.php?action=edit'
                    },
                    remove: {
                        type: 'DELETE',
                        url: '../N20_Negocio/N21_Controladores/usuariosControlador.php?action=remove'
                    }
                },
                table: '#tablaUsuarios',
                idSrc: 'id',
                fields: [
                    { label: 'Id', name: 'id' },
                    { label: 'Nombre', name: 'nombre' },
                    { label: 'Apellido', name: 'apellido' },
                    { label: 'Usuario', name: 'usuario' },
                    { label: 'Email', name: 'email' },
                    { label: 'Contraseña', name: 'passw' },
                    { label: 'FechaRegistro', name: 'fechaRegistro' },
                    { label: 'Rol', name: 'idRol' }
                ]
            });

            $('#tablaUsuarios').DataTable({
                dom: 'Bfrtip',
                data: data, 
                columns: [
                    { data: 'id' },
                    { data: 'nombre' },
                    { data: 'apellido' },
                    { data: 'usuario' },
                    { data: 'email' },
                    { data: 'passw' },
                    { data: 'fechaRegistro' },
                    { data: 'idRol' }
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
