<?php
    $host = 'localhost';
    $dbName = 'db_inventary_xampp';
    $user = 'root';
    $passUser = '';

    $connection = mysqli_connect($host , $user , $passUser);

    //si ocurre un error al seleccionar la base de datos
    mysqli_select_db($connection , $dbName) or die ("<center><h2 style='color:red'>Error -> Data Base Not Found.</h2></center>");

    //si se produce un error al conectar que notifique y cierre la conexion
    if(mysqli_connect_errno()) {
        echo "<center><h2><strong>Error in Data Base No Connected.</strong></h2><enter>";
        exit();
    }

    mysqli_set_charset($connection,"UTF8");
?>