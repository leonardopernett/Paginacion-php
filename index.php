<?php
require_once('./conexion.php');

$sql = "SELECT * FROM articulos ";
$resultado = $pdo->prepare($sql);
$resultado->execute();
$rows = $resultado->fetchAll();


$articuloPagina = 4;

//contar el numero de filas de nuestra base de datos
$totalPagina = $resultado->rowCount();

$paginas = $totalPagina / $articuloPagina;

//redondeamos el resultado
$paginas = ceil($paginas);

?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Paginacion</title>
</head>

<body>

    <div class="container mt-3">
        <h1>Paginacion</h1>


        <?php if (!$_GET) {
            header('location:index.php?pagina=1');
        }

         
        if($_GET['pagina']>$articuloPagina || $_GET['pagina'] ==null || $_GET['pagina']<=0 || $_GET['pagina']==''){
            header('location:index.php?pagina=1');

        }

          //navegar entre paginas
         $iniciar = ($_GET['pagina']-1)*$articuloPagina;

        $sql_articulo = "SELECT * FROM articulos LIMIT $iniciar,$articuloPagina";
        $sentencia = $pdo->prepare($sql_articulo);
        $sentencia->execute();
        $resultado_articulo = $sentencia->fetchAll();
        ?>

        <?php foreach ($resultado_articulo as $articulo) {     ?>
            <div class="alert alert-primary mt-3" role="alert">
                <?php echo $articulo['title']; ?>
            </div>
        <?php } ?>


        <nav aria-label="...">
            <ul class="pagination mt-5">

                <li class="page-item <?php echo $_GET['pagina'] == 1 ? 'disabled' : '' ?> ">
                    <a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina'] - 1 ?>" tabindex="-1" aria-disabled="true">Anterior</a>
                </li>

                <?php for ($i = 1; $i <= $paginas; $i++) : ?>
                    <li class="page-item  <?php echo $_GET['pagina'] == $i ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?pagina=<?php echo $i ?>">
                            <?php echo $i ?>
                        </a>
                    </li>
                <?php endfor ?>


                <li class="page-item <?php echo $_GET['pagina'] == $paginas ? 'disabled' : '' ?>">
                    <a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguientes</a>
                </li>
            </ul>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>