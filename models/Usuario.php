<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $password_actual;
    public $password_nuevo;
    public $token;
    public $confirmado;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    //Validar el Login de Usuarios

    public function validarLogin() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email del usuario es obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'El Email no es valido';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password no puede ir vacio';
        }
        
        return self::$alertas;
    }
    
    //Validacion para cuentas nuevas
    public function validarNuevaCuenta(){
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre del usuario es obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email del usuario es obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password no puede ir vacio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres';
        }
        if ($this->password !== $this->password2) {
            self::$alertas['error'][] = 'Los Passwords son diferentes';
        }
        return self::$alertas;
    }

    //Valida un email

    public function validarEmail() {
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'El Email no es valido';
        }

        return self::$alertas;
    }

    //Valida el password
    public function validarPassword() {
        if (!$this->password) {
            self::$alertas['error'][] = 'El Password no puede ir vacio';
        }
        if (strlen($this->password) < 6) {
            self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    public function validar_perfil(){
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es obligatorio';
        }
        return self::$alertas;
    }

    public function nuevo_password() :array {
        if (!$this->password_actual) {
            self::$alertas['error'][] = 'El Password Actual No Puede ir Vacio';
        }
        if (!$this->password_nuevo) {
            self::$alertas['error'][] = 'El Password Nuevo No Puede ir Vacio';
        }
        if (strlen($this->password_nuevo) < 6) {
            self::$alertas['error'][] = 'El Password debe contener almenos 6 caracteres ';
        }
        return self::$alertas;
    }
    //Comprobar al password
    public function comprobar_password(): bool{
        return password_verify($this->password_actual, $this->password);
    }

    public function hashPassword() : void{
        $this -> password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //Ganerar un Token
    public function crearToken() : void{
        $this->token = uniqid();
    }
}