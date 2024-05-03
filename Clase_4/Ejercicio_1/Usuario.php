<?php

class Usuario{
    private $_nombre;
    private $_clave;
    private $_mail;
    private $_id;
    private $_fechaDeRegistro;

    public function __construct($nombre, $clave, $mail, $id = null, $fechaDeRegistro = null)
    {
        $this->_nombre =$nombre;
        $this->_clave =$clave;
        $this->_mail =$mail;
        $this->_id = $id ?? rand(1, 10000);
        $this->_fechaDeRegistro = $fechaDeRegistro ?? date("d/m/Y");
        
    }

    public static function MostrarUsuario($usuario)
    {
        echo "Nombre: " . $usuario->_nombre . "<br>",
        "Clave: " . $usuario->_clave . "<br>",
        "Mail: " . $usuario->_mail . "<br><br>";
    }

    public static function AltaUsuario($usuario)
    {
        $usuarios = [];
        
        if(file_exists('usuarios.json'))
        {
            $usuarios = json_decode(file_get_contents('usuarios.json'), true);
            echo "ola";
        }
        else
        {
            echo "chau";
            file_put_contents('usuarios.json', '[]');
        }   
        
        $nuevoUsuario = [
            
            'id' => $usuario->_id,
            'nombre' => $usuario->_nombre,
            'clave' => $usuario->_clave,
            'mail' => $usuario->_mail,
            'fechaDeRegistro' => $usuario->_fechaDeRegistro
            
        ];

        array_push($usuarios,$nuevoUsuario);

        $json = json_encode($usuarios);

        file_put_contents('usuarios.json', $json);
    }

    public function subirImagen($imagenTmpPath)
    {
        $carpetaDestino = __DIR__ . '/Usuario/Fotos/';
        $nombreImagen = $this->_id . '_' . $this->_nombre . '.png';

        if (move_uploaded_file($imagenTmpPath, $carpetaDestino . $nombreImagen)) {
            return true;
        } else {
            return false;
        }
    }

    public static function LeerUsuario()
    {
        
    }
}


?>