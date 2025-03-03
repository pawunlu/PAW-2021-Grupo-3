<!DOCTYPE html>
<html lang="es-AR">
    <head>
        <?php
            require 'parts/head_view.php'
        ?>
        <link rel="stylesheet" type='text/css' href="assets/css/form.css"/>
        <link rel="stylesheet" type='text/css' href="assets/css/turnos.css"/>
        <link rel='stylesheet' type='text/css' href='assets/css/notification.css'/>
        <link rel='stylesheet' type='text/css' href='assets/css/botones.css'/>
    </head>
    <body>
        <?php 
            require 'parts/header_view.php';
        ?>

        <main>
            <?php require 'parts/notification_view.php'; ?>
            <section>
                <h2>BÚSQUEDA DE TURNOS</h2>
                <form action="" method="POST" id="form-turnos" 
                      target="_self" enctype="multipart/form-data">
                    <fieldset>
                        <label for="especialidad">Especialidad</label>
                        <input list="especialidad-lista" id="especialidad" name="especialidad" 
                        placeholder="Kinesiología" 
                        autofocus tabindex="1"/>

                        <datalist id="especialidad-lista">
                            <option value="Audiometría">
                            <option value="Cardiología">
                            <option value="Densitometría">
                            <option value="Ecografía Doppler">
                        </datalist>

                        <label for="especialista">Especialista</label>
                        <input list="especialista-lista" id="especialista" name="especialista" 
                        placeholder="Fulano" 
                        tabindex="2"/>
                        <datalist id="especialista-lista">
                            <option value="Fulano">
                            <option value="Mengano">
                            <option value="Sultan">
                            <option value="Juan Doe">
                        </datalist>

                        <label for="dia">Dia</label>
                        <input type="date" id="dia" name="dia" 
                        required 
                        tabindex="3"/>
                        
                        <!-- Recomendado por php para evitar que archivos grandes fallen y el usuario no se entere-->
                        <input type="hidden" name="MAX_FILE_SIZE" value="<?= constant('_MAXFILESIZE') ?>"/>
                        
                        <label for='orden_medica'>Orden Médica (*)</label>
                        <input type="file" name='orden_medica' class="file"
                        required accept="application/pdf"
                        tabindex="4"/>
                    </fieldset>
                </form>
                <h2>TURNOS DISPONIBLES</h2>
                <table>
                    <colgroup>
                        <col>
                        <col>
                        <col>
                        <col>
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Especialidad</th><th>Especialista</th><th>Fecha</th><th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="especialidad">Resonancia</td>
                            <td class="especialista">Fulano</td>
                            <td class="fecha">16/04/2021</td>
                            <td class="hora">16:30</td>
                        </tr>
                    </tbody>
                </table>

                <input type="submit" form="form-turnos" name="reservar" value="Reservar" class="submit"/>
                <input type="reset" form="form-turnos" name="reset" value="Limpiar" class="limpiar"/>
            </section>
        </main>

        <?php 
            require 'parts/footer_view.php';
        ?>
    </body>
</html>
