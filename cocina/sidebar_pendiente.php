
<?php
    
    function getApprovedOrdersCount(){
        include 'conexion/cone.php';
        $stmt = $cone->query("Select count(*) from pedido where Estado = 2");

        $count = $stmt ->fetchColumn();

        return $count;
    }

        $approvedOrdersCount = getApprovedOrdersCount();
?>
<head>
 <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 
 
</head>

<!--sidebar-->


<div>
    <div class="navegacion">
            <div class="">
                <ul class="">

                    <li class="list " >
                        <a href="index.php">
                            
                            <span class="texto"> INICIO</span>
                            <span class="icon">
                                
                                <ion-icon name="home"></ion-icon>
                            </span>
                            
                        </a>
                    </li>

                    <li class="list active">
                        <a href="pendiente.php">
                            
                            <span class="texto"> Pendiente</span>
                            <span class="icon">
                                <ion-icon name="folder"></ion-icon>
                            </span>
                            <span class="notificacion" id="notif-counter"></span>
                        </a>
                    </li>
        
                    <li class="list">
                        <a href="Cocinando.php">
                            <span class="texto"> Cocinando</span>
                            <span class="icon">
                                <ion-icon name="restaurant"></ion-icon>
                            </span>    
                        </a>
                    </li>
        
                    <li class="list">
                        <a href="Terminados.php">
                            <span class="texto"> Terminado</span>
                            <span class="icon">
                                <ion-icon name="thumbs-up"></ion-icon>
                            </span>   
                        </a>
                    </li>
        
                    <li class="list"> 
                        <a href="#">
                            <span class="texto"> Ajustes</span>
                            <span class="icon">
                                <ion-icon name="settings"></ion-icon>
                            </span>   
                        </a>
                    </li>
        
                    <li class="list">
                        <a href="#">
                            <span class="texto"> Salir</span>
                            <span class="icon">
                                <ion-icon name="log-out"></ion-icon>
                            </span>  
                        </a>
                    </li>
        
                    <div class="indicator"></div>
                </ul>
            </div>

        </div>


        <script>
        const list = document.querySelectorAll('.list');
        
        list.forEach((item) => {
            item.addEventListener('click', function(event) {
                event.preventDefault(); // Previene la redirección inmediata
                const targetUrl = this.querySelector('a').getAttribute('href');

                // Remover la clase 'active' de todos los elementos
                list.forEach((el) => el.classList.remove('active'));

                // Añadir la clase 'active' al elemento clicado
                this.classList.add('active');

                // Redirigir después de un breve retraso
                setTimeout(() => {
                    window.location.href = targetUrl;
                }, 500); // Ajusta el tiempo de acuerdo a la duración de tu animación
            });
        });
    </script>

        <script src="script.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script> 
</div>



