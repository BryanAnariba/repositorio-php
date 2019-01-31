<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paginacion</title>
</head>
<body>
    <?php
        try{
            $base = new PDO("mysql:host=localhost; dbname=prueba","root","");
            $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $base->exec("SET CHARACTER SET UTF8");


            //PAGINA PAGINACION
            $tamanio_pag = 3; //para la paginacion
            $pagina = 1; //para la paginacion .... NADA MAS CARGAR LA PAGINA DEBE MOVER LA PAGINA A LA 1
            $empezar_desde = ($pagina-1)*$tamanio_pag;


            $sql_total = "SELECT NOMBREARTÍCULO , SECCIÓN , PRECIO , PAÍSDEORIGEN FROM PRODUCTOS WHERE SECCIÓN = 'DEPORTES'";//LIMIT(CUANTOS_REGISTROS_QUIERES_VER, CUANTOS_A_PARTIR_DE_ESE); LIMIT 0,3
            $resultado = $base->prepare($sql_total);
            $resultado->execute(array());

            $numero_filas = $resultado->rowCount();//Cuenta las filas del array y las almacena en numero de filas
            $total_paginas = ceil($numero_filas / $tamanio_pag) . "<br>";//redondea como int
            echo "El total de paginas son " . $total_paginas;
            echo "Se Mostrara la Pagina " . $pagina . " de " . $total_paginas . "<br>";

            /*while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){//ARREGLO ASOCIATIVO
                echo "Nombre Articulo: " . $registro["NOMBREARTÍCULO"] . " Seccion: " . $registro["SECCIÓN"] . " Precio: " . $registro["PRECIO"] . " Pais de Origen: " . $registro["PAÍSDEORIGEN"] . "<br>";
            }*/
            $resultado->closeCursor();

            $sql_limite = "SELECT NOMBREARTÍCULO , SECCIÓN , PRECIO , PAÍSDEORIGEN FROM PRODUCTOS WHERE SECCIÓN = 'DEPORTES' LIMIT $empezar_desde,$tamanio_pag";
            $resultado = $base->prepare($sql_limite);
            $resultado->execute(array());
            while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){//ARREGLO ASOCIATIVO
                echo "Nombre Articulo: " . $registro["NOMBREARTÍCULO"] . " Seccion: " . $registro["SECCIÓN"] . " Precio: " . $registro["PRECIO"] . " Pais de Origen: " . $registro["PAÍSDEORIGEN"] . "<br>";
            }

        }catch(Exception $e){
            echo "Error en la Linea" . $e->getLine();
        }
    ?>
</body>
</html>