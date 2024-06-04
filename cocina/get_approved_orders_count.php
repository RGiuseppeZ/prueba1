<?php
    function getApprovedOrdersCount(){
        include 'conexion/cone.php';
        $stmt = $cone->query("Select count(*) from pedido where Estado = 2");

        $count = $stmt ->fetchColumn();

        return $count;
    }

    // Establecer el encabezado para devolver texto plano
header('Content-Type: text/plain');

// Imprimir el número de pedidos aprobados
echo getApprovedOrdersCount();
                                
?>