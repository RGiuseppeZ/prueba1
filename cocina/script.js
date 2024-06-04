document.addEventListener("DOMContentLoaded", function() {
    function updateNotificationCounter() {
        fetch('get_approved_orders_count.php')
            .then(response => response.text())
            .then(data => {
                
                const counterElement = document.getElementById('notif-counter');
                const count = parseInt(data , 10);  

                if (count > 0){
                    counterElement.textContent = count;
                    counterElement.style.display = 'inline';
                }else{
                    counterElement.style.display = 'none';
                }


            })
            .catch(error => console.error('Error al actualizar el contador de notificaciones:', error));
    }

    // Actualizar cada 60 segundos
    setInterval(updateNotificationCounter, 10000);

    // Actualizar al cargar la página
    updateNotificationCounter();
});