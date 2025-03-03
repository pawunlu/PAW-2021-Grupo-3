<!DOCTYPE html>
<html lang="es-AR">

<head>
    <?php
    require 'parts/head_view.php'
    ?>
</head>

<body>
    <?php
    require 'parts/header_view.php';
    ?>
    <main>
        <section>
            <h2>NUESTROS SERVICIOS</h2>
            <article>
                <a href="servicios/audiologia.html" target="_self">
                    <h3>Audiología</h3>
                    <img src="/assets/img/NuestrosServicios_Audiologia.jpg" alt="Imagen de Audiología" />
                </a>
            </article>

            <article>
                <a href="servicios/cardiologia.html" target="_self">
                    <h3>Cardiología</h3>
                    <img src="/assets/img/NuestrosServicios_Cardiologia.jpg" alt="Imagen de Cardiología" />
                </a>
            </article>

            <article>
                <a href="servicios/densitometria.html" target="_self">
                    <h3>Densitometría</h3>
                    <img src="/assets/img/NuestrosServicios_Densitometria.jpg" alt="Imagen de Densitometría" />
                </a>
            </article>

            <article>
                <a href="servicios/ecografia_doppler.html" target="_self">
                    <h3>Ecografía Doppler</h3>
                    <img src="/assets/img/NuestrosServicios_Ecografia_doppler.jpg" alt="Imagen de Ecografía Doppler" />
                </a>
            </article>
        </section>
    </main>

    <?php
    require 'parts/footer_view.php';
    ?>
</body>

</html>