<!DOCTYPE html>
<html lang="es-AR">
    <head>
        <meta lang="es" charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap">
        <link rel="stylesheet" href="styles/reset.css"/>
        <link rel="stylesheet" href="styles/icono.min.css">  
        <link rel="stylesheet" href="styles/header_footer.css"/>
        <link rel="stylesheet" href="styles/main.css"/>

        <title>Dental Medical Group</title>
    </head>
    <body>
    
        <?php 
            require 'parts/header_view.php';
        ?>


        <main>
            <section style="text-align: left;">
                <h2>VISIÓN</h2>
                <p>Convertirnos en una institución modelo para el cuidado de la salud, manteniendo una excelente calidad de atención y respeto por la dignidad humana.</p>

                <h2>MISIÓN</h2>
                <p>Aportar a la comunidad la mejor asistencia médica posible, basándonos en: evidencia científica, pensamiento crítico y valores éticos. Asegurarnos de revisar y actualizar: conocimientos, procesos y tecnologías; además de administrar nuestros recursos de manera transparente y honesta; serán nuestra principal misión.</p>

                <h2>VALORES</h2>
                <p><b>Responsabilidad:</b> Asumimos un rol activo en nuestra labor diaria y comprendemos la trascendencia de nuestras acciones individuales y colectivas</p>
                <p><b>Compromiso:</b> Asumimos nuestras tareas comprometidos con la institución, enfocando nuestro esfuerzo en brindar atención de calidad a nuestros pacientes y su familia.</p>
                <p><b>Eficiencia:</b> Logramos nuestros objetivos utilizando procesos y métodos de trabajo que optimizan nuestro desempeño.</p>
                <p><b>Ética:</b> Sostenemos una conducta transparente, honesta y preocupada por la dignidad de todos nuestros pacientes.</p>
                <p><b>Trabajo en equipo:</b> Trabajamos valorando nuestras diferencias, fortaleciendo las relaciones interpersonales y priorizando el éxito del equipo por encima del éxito individual.</p>
            </section>        
        </main>

        <?php 
            require 'parts/footer_view.php';
        ?>
    </body>
</html>
