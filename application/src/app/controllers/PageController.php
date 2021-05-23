<?php

namespace Paw\app\controllers;

class PageController{

    public string $viewsDir;
    private array $contact;
    public array $userOptions;
    public array $menuOptions;
    public array $footerLinks;
    private $__MAXFSIZE;

    public function __construct(){

        # 10Mb = 10.000.000Kb
        define ("_MAXFILESIZE", 10000000, true);

        $this->viewsDir = __DIR__ . "/../views/";

        $this->contact = [
            'href' => 'tel:+549234642-4593',
            'name' => '+54 9 2346 42-4593'
        ];

        $this->userOptions = [
            [
                'href' => '/login',
                'name' => 'Ingresar'
            ],
            [
                'href' => '/register',
                'name' => 'Registrarse'
            ]
        ];

        $this->menuOptions = [
            [
                'href' => '/about',
                'name' => '¿Quienes Somos?'
            ],
            [
                'href' => '/services',
                'name' => 'Nuestros Servicios'
            ],
            [
                'href' => '/coverages',
                'name' => 'Coberturas'
            ],
            [
                'href' => '/turns',
                'name' => 'Turnos'
            ]
        ];

        $this->footerLinks = [
            [
                'href' => 'https://www.facebook.com/dentalmedicalgroup',
                'name' => 'facebook'
            ],
            [
                'href' => 'https://www.instagram.com/dentalmedicalgroup',
                'name' => 'instagram'
            ],
            [
                'href' => 'https://www.linkedin.com/dentalmedicalgroup',
                'name' => 'linkedin'
            ],
            [
                'href' => 'mailto:contacto@dentalmedicalgroup.com',
                'name' => 'mail'
            ]
        ];
    }

    private function validateEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        return false;
    }

    private function validateDate($date) {
        $parsedDate = $this->parseDate($date); # llega con el formato aaaa-mm-dd
        if ((count($parsedDate) == 3) && checkdate($parsedDate[1], $parsedDate[2], $parsedDate[0])) return true;
        return false;
    }

    private function validatePassword($pass) {
        return strlen($pass) > 7;
    }

    private function formValidate($requiredValues) {
        $sanitized = [];
        foreach ($requiredValues as $key => $value){
            $sanitized[$key] = $this->sanityCheck($_POST[$key]); # guardo el sanitizado para las validaciones y su posterior devolucion como resultado
            if ($value['validate']) { # me fijo si tiene un metodo para validar especifico
                if (!$value['validate']($sanitized[$key])) # si lo tiene, lo ejecuto
                    return [$sanitized, false, "El campo \"{$value['label']}\" no tiene un formato valido"]; # si no es valido respondo con mensaje personalizado
            } else if (!$sanitized[$key]) # si no tiene personalizado, uso el general
                return [$sanitized, false, "El campo  \"{$value['label']}\" no puede estar vacío"];
        }
        return [$sanitized, true, ''];
    }

    public function sanityCheck($field) {
        $field = trim($field);
        $field = stripslashes($field);
        $field = htmlspecialchars($field);
        return $field;
    }

    public function index(){
        $titulo = 'Dental Medical Group';
        require $this->viewsDir . 'index_view.php';
    }

    public function login($notification = false, $isValid = false, $notification_text = 'Uno o mas campos no son validos'){
        $titulo = 'Iniciar Sesión';
        $notification_type = $isValid ? SUCCESS : ERROR;
        require $this->viewsDir . 'login_view.php';
    }

    public function loginProcess(){
        $email = $_POST['email'];
        $contrasenia = $_POST['contrasenia'];

        #$re = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

        $emailNotValid = $this->validateEmail($email);

        if (!$email || $emailNotValid || !$contrasenia) $this->login(true, false);
        else {
            # simulacion de consulta a la base de datos sobre si el usuario y contraseña esta bien
            if ($email == 'admin@admin.com' && $contrasenia == 'admin') $this->login(true, true, 'Sesión iniciada con éxito');
            else $this->login(true, false, 'Usuario y contraseña incorrectos');
        }
    }


    public function register($notification = false, $isValid = false, $notification_text = 'Uno o mas campos no son validos'){
        $titulo = 'Registrarse';
        $notification_type = $isValid? SUCCESS : ERROR;
        require $this->viewsDir . 'register_view.php';
    }

    public function registerProcess(){
        # array para saber si vienen los campos requeridos y validarlos segun sus requisitos
        $requiredValues = [
            'nombre' => ['label' => 'Nombre'],
            'apellido' => ['label' => 'Apellido'],
            'celular' => ['label' => 'Celular'],
            'email' => ['label' => 'Email', 'validate' => function ($email) {return $this->validateEmail($email);}],
            'conf_email' => ['label' => 'Email', 'validate' => function ($email) {return $this->validateEmail($email);}],
            'contrasenia' => ['label' => 'Contraseña', 'validate' => function ($pass) { return $this->validatePassword($pass);}],
            'conf_contrasenia' => ['label' => 'Contraseña', 'validate' => function ($pass) { return $this->validatePassword($pass);}],
            'fecha_nacimiento' => ['label' => 'Fecha de nacimiento', 'validate' => function ($date) {return $this->validateDate($date);}],
        ];
        # valido los campos
        list($validated, $isValid, $notification_text) = $this->formValidate($requiredValues); # validated viene sanitizado
        if (!$isValid) $this->register(true, false, $notification_text);
        # valido los campos que requieren confirmacion
        else if ($validated['email'] != $validated['conf_email']) $this->register(true, false, 'Los email no coinciden');
        else if ($validated['contrasenia'] != $validated['conf_contrasenia']) $this->register(true, false, 'Las contraseñas no coinciden');
        else $this->register(true, true, 'Registro completado con éxito');

        # en este punto los datos estan validados y se guardarian en la base de datos
        # try{
        #    guardar formulario
        #    if ok then $this->register(true, true, 'Registro completado con éxito');
        #    else error
        #} catch then error

    }

    public function resetPassword($procesado = false){
        require $this->viewsDir . 'reset_password_view.php';
    }

    public function resetPasswordProcess(){
        $this->titulo = 'Reestablecer Contraseña';
        $this->form = $_POST;

        # validation

        $this->resetPassword(true);
    }

    public function about(){
        $this->titulo = '¿Quiénes Somos?';
        require $this->viewsDir . 'about_view.php';
    }

    public function services(){
        $this->titulo = 'Nuestros Servicios';
        require $this->viewsDir . 'services_view.php';
    }

    public function coverages($busqueda = false, $isValid = false, $resultado = []){
        $this->titulo = 'Coberturas';
        require $this->viewsDir . 'coverages_view.php';
    }

    public function coveragesProcess(){
        $this->titulo = 'Coberturas';
        $busqueda = $_POST["busqueda"];
        $resultado = [];
        if (!$busqueda)  # Validacion del formulario
            $this->coverages(true, false, $resultado);
        else {
            if (strlen($busqueda) < 6) $resultado = ['opcion 1', 'opcion 2', 'opcion 3']; # Simulo obtener una respuesta de una base de datos
            $this->coverages(true, true, $resultado);
        }
    }

    public function turns($notification = false, $isValid = false, $notification_text = 'error'){
        $this->titulo = 'Turnos';
        $notification_type = $isValid ? SUCCESS : ERROR;
        require $this->viewsDir . 'turns_view.php';
    }
    
    public function turnsProcess(){
        $this->titulo = 'Turnos';
        
        $keys = [];
        $values = [];
        foreach ($_POST as $key => $value){
            array_push($keys, $this->sanityCheck($key));
            array_push($values, $this->sanityCheck($value));
        }
        $post = array_combine($keys, $values);

        $especialista = $post['especialista'];
        $especialidad = $post['especialidad'];
        $dia =          $post['dia'];

        if(empty($dia) or (empty($especialidad) and empty($especialista)) or empty($_FILES)){
            $this->turns(true, false);
        }
        else{
            if($_FILES['orden_medica']['error'] != 0){
                $this->turns(true, false);
            }
            else{
                    # Handling upload
                    $finfo =        finfo_open(FILEINFO_MIME_TYPE);
                    $timestamp =    time();
                    $targetDir =    "./files/";
                    $tempName =   $_FILES['orden_medica']['tmp_name'];
                    $fileSize =   $_FILES['orden_medica']['size'];
                    $newFileName = $targetDir . $_FILES['orden_medica']['name']; #. '--' . $timestamp; # el -- es para despues parsear el nombre y devolver el original
                    $mimeType =   finfo_file($finfo, $tempName);

                    finfo_close($finfo);

                if (file_exists($newFileName))
                    $this->turns(true, false, 'Archivo ya existe');
                else if ($fileSize > constant('_MAXFILESIZE'))
                    $this->turns(true, false, 'supero el tamaño');
                else if (! $mimeType == 'application/pdf'){
                    $this->turns(true, false, 'extension no valida');
                }
                else{
                    if(!is_dir($targetDir)) mkdir($targetDir);
                    if (move_uploaded_file($_FILES["orden_medica"]["tmp_name"], $newFileName)) {
                        $this->turns(true, true, "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.");
                    } else {
                        $this->turns(true, false, "Sorry, there was an error uploading your file.");
                    }
                    $dia = $this->parseDate($dia);
                    # Format dia
                    # Add db hit
                    # Mapping between timestamp and filename

                }
            }

        }
    }

    public function parseDate($field){
        return explode('-', $field);
    }

}
