<?php
include("./php/cn.php");

$id = $_GET["id"];
$imgMenu = $_GET["img"];
$nombreMenu = $_GET["nombreMenu"];
$menuID = $_GET["menuID"];

$queryAlimentos = "SELECT * FROM alimentos WHERE menu_id = $menuID";

$telefono = mysqli_query($con, "SELECT telefono from vendedores Where id = $id")->fetch_object()->telefono;
$nickname = mysqli_query($con, "SELECT nickname from vendedores Where id = $id")->fetch_object()->nickname;

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="icon" type="image/png" href="./assets/img/logo1.png" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/food.css" />
    <title>Kobi</title>
</head>

<body>
    <header>
        <div class="header-container">
            <a href="./index.php" class="header--logo">
                <img src="./assets/img/logo1.png" alt="" />
            </a>
            <h2>¿Qué vamos a comer hoy?</h2>
        </div>
    </header>

    <main>
        <section class="main-menu">

            <div class="menu-header">
                <!-- PHP -->
                <figure>
                    <!-- Imagen del menu -->
                    <img src="<?php echo $imgMenu; ?>" alt="">
                </figure>

                <div class="menu-info">
                    <h2><?php echo $nombreMenu; ?></h2>
                    <p>Info: <strong><?php echo $telefono;?></strong> </p>
                </div>
            </div>

            <div class="menu-cards--container">

                <!-- PHP -->
                <?php
                $resultadoQuery = mysqli_query($con, $queryAlimentos);
                while ($row = mysqli_fetch_assoc($resultadoQuery)) {
                    $etiqueta = mysqli_query($con, "SELECT nombre_etiqueta from etiquetas Where id = (SELECT etiqueta_id from alimentos_etiquetas where alimento_id =" . $row['id'] .")")->fetch_object()->nombre_etiqueta;
                ?>

                    

                    <article class="card">
                        <figure class="card-image">
                            <img src="<?php echo $row["imagen"]; ?>" alt="Pizza" />
                        </figure>
                        <div class="card-info">
                            <div class="card-info--title">
                                <h3><?php echo $row["nombre"]; ?></h3>
                                <p class="etiqueta"><?php echo $etiqueta; ?></p>
                                <p><?php echo $row["descripcion"]; ?></p>
                            </div>
                            <div class="card-info--price">
                                <p>$ <?php echo $row["precio"]; ?></p>
                            </div>
                        </div>
                    </article>

                <?php
                }
                mysqli_free_result($resultadoQuery);
                ?>
                <!-- /PHP -->
            </div>

            <div class="menu-footer">
                <!-- PHP -->
                <div class="menu-footer-info">
                    <h3>Información de contacto</h3>
                    <p>Dueño: <strong><?php echo $nickname;?></strong></p>
                    <p>Teléfono: <strong><?php echo $telefono;?></strong> </p>
                </div>
            </div>

        </section>
    </main>

    <footer>
        <div class="footer-container">
            <a href="#" class="footer--logo">
                <img src="./assets/img/logo1.png" alt="" />
            </a>
            <h2>Kobi</h2>
        </div>
    </footer>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>