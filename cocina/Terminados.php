<?php
include 'conexion/cone.php';

    if(isset($_POST['accion_pedido'])){
        $pedido_id= $_POST['pedido_id'];
        $accion=$_POST['accion_pedido'];

        try{
            if($accion == 'modificar'){
                $stmt = $cone->prepare("UPDATE pedido SET Estado = 2 WHERE idPedido = :pedido_id");
                $stmt->bindParam(':pedido_id', $pedido_id);
                $stmt->execute();

                // Redirigir después de procesar el formulario
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    try{
            // Preparar la consulta SQL
        $stmt = $cone->prepare("
            SELECT 
                p.idPedido,
                DATE_FORMAT(p.Fecha, '%Y-%m-%d') AS Fecha_Pedido,
                m.NumMesa AS Numero_Mesa,
                tp.TipoPed AS Tipo_Pedido,
                GROUP_CONCAT(CONCAT(dp.Cantidad, ' ', pr.Nombre) SEPARATOR ', ') AS Productos,
                SUM(dp.Cantidad * pr.Precio) AS Total,
                e.nombre AS Estado_Pedido
            FROM 
                pedido p
            JOIN 
                mesa m ON p.Mesa_id = m.idMesa
            JOIN 
                detallepedido dp ON p.idPedido = dp.Pedido_id
            JOIN 
                producto pr ON dp.Producto_id = pr.idProducto
            JOIN 
                tipopedido tp ON p.TipoPedido_id = tp.idTipoPedido
            JOIN 
                estados e ON p.Estado = e.idStatus
            WHERE
                p.Estado = 4
            GROUP BY 
                p.idPedido
                order by p.fechaTerminado asc;
        ");
        // Ejecutar la consulta
         $stmt->execute();

    // Obtener los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar los resultados
    echo "<!DOCTYPE html>";
    echo "<html>";
    echo "<head>";
    echo "<title>Tabla de Pedidos Aprobados</title>";
    echo "<link rel='stylesheet' type='text/css' href='styles.css'>";
    echo "<link rel='stylesheet' type='text/css' href='styles2.css'>";
    echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>";
    echo "</head>";
    echo "<body>";
    echo '<div class="principal ">';
    echo '<div class="sidebar-container">';
     include 'sidebar_terminado.php';
    echo '</div>';
    echo "<div class='container'>";
    echo "<table id='table_pedidos'>";

    echo '<caption>Lista Pedidos Terminados</caption>';
    echo "<tr><th>Fecha Pedido</th><th>Numero Mesa</th><th>Tipo Pedido</th><th>Productos</th><th>Total</th><th>Estado Pedido</th><th>Acciones</th></tr>";
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['Fecha_Pedido'] . "</td>";
        echo "<td>" . $row['Numero_Mesa'] . "</td>";
        echo "<td>" . $row['Tipo_Pedido'] . "</td>";
        echo "<td>" . $row['Productos'] . "</td>";
        echo "<td>" . $row['Total'] . "</td>";
        echo "<td>" . $row['Estado_Pedido'] . "</td>";
        echo "<td class='actions'>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='pedido_id' value='" . $row['idPedido'] . "'>";
        echo "<input type='hidden' name='accion_pedido' value='modificar'>";
        echo "<button class='cancel-button' type='submit'>X MODIFICAR</button>";
        echo "</form>";

        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    echo "</body>";
    echo "</html>";

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $cone = null;
?>

