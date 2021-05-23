<?php

namespace Paw\app\controllers;

class PageController{

    public string $viewsDir;
    private array $contact;
    public array $userOptions;
    public array $menuOptions;
    public array $footerLinks;

    public function __construct(){
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

    public function index(){
        $titulo = 'Dental Medical Group';
        require $this->viewsDir . 'index_view.php';
    }

    public function login($notification = false, $is_valid = false){
        $titulo = 'Iniciar Sesión';
        $notification_type = $is_valid ? SUCCESS : ERROR;
        $notification_text = $is_valid ? 'Sesión iniciada con éxito' : 'Usuario o contraseña incorrecto';
        require $this->viewsDir . 'login_view.php';
    }

    public function loginProcess(){
        $email = $_POST['email'];
        $contrasenia = $_POST['contrasenia'];

        #$re = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailNotValid = true;
        }

        if (!$email || $emailNotValid || !$contrasenia) $this->login(false, false);
        else {
            # simulacion de consulta a la base de datos sobre si el usuario y contraseña esta bien
            if ($email == 'admin@admin.com' && $contrasenia == 'admin') $this->login(true, true);
            else $this->login(true, false);
        }
    }

    public function register($notification = false, $is_valid = false){
        $titulo = 'Registrarse';
        $notification_type = $is_valid? SUCCESS : ERROR;
        $notification_text = $is_valid? 'Registro completado con éxito' : 'Uno o mas campos no son validos';
        require $this->viewsDir . 'register_view.php';
    }

    public function registerProcess(){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $celular = $_POST['celular'];
        $email = $_POST['email'];
        $conf_email = $_POST['conf_email'];
        $contrasenia = $_POST['contrasenia'];
        $conf_contrasenia = $_POST['conf_contrasenia'];

        $parsed_date = explode('-', $_POST['fecha_nacimiento']); # llega con el formato aaaa-mm-dd
        $is_date_valid = false;
        if((count($parsed_date) == 3) && checkdate($parsed_date[1], $parsed_date[2], $parsed_date[0])) $is_date_valid = true;

        $is_email_valid = $email == $conf_email;
        if ($is_email_valid && filter_var($email, FILTER_VALIDATE_EMAIL)) $is_email_valid = true;

        $is_pass_valid = ($contrasenia == $conf_contrasenia) && (strlen($contrasenia) > 7);

        if ($nombre && $apellido && $celular && $is_date_valid && $celular && $is_email_valid  && $is_pass_valid) $this->register(true, true);
        else $this->register(true, false);
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

    public function coverages($busqueda = false, $is_valid = false, $resultado = []){
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

    public function turns($notification = false, $procesado = false){
        $this->titulo = 'Turnos';
        require $this->viewsDir . 'turns_view.php';
    }
    
    public function turnsProcess(){
        $this->titulo = 'Turnos';
        $especialista = $_POST['especialista'];
        $especialidad = $_POST['especialidad'];
        $dia = $_POST['dia'];
        
        var_dump($this->form);

        die;
        

        $this->turns(true);
    }
}
?>
