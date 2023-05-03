
    // Selecciona todas las alertas con la clase "alert" y les agrega un listener para el evento "closed.bs.alert"
    document.querySelectorAll('.alert').forEach(function(alert) {
        alert.addEventListener('closed.bs.alert', function() {
            // Remueve la alerta del DOM después de que haya sido cerrada
            alert.remove();
        });

        // Cierra la alerta después de 5 segundos
        setTimeout(function() {
            alert.querySelector('button').click();
        }, 5000);
    });

