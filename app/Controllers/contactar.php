<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends BaseController
{
    // ... otros métodos ...

    // Método para mostrar la página de contacto
    public function contacto()
    {
        $data['titulo'] = 'Contacto';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/contacto') .
            view('plantillas/footer');
    }

    // Método para procesar el formulario de contacto
    public function enviarConsulta()
    {
        // Verifica si se envió el formulario
        if ($this->request->getMethod() === 'post') {
            // Recoge los datos del formulario
            $nombre = trim($this->request->getPost('nombre'));
            $apellido = trim($this->request->getPost('apellido'));
            $email = trim($this->request->getPost('email'));
            $motivo = trim($this->request->getPost('motivo'));
            $consulta = trim($this->request->getPost('consulta'));
            $errors = [];

            // Validación de campos vacíos
            if (empty($nombre) || empty($apellido) || empty($email) || empty($motivo) || empty($consulta)) {
                $errors[] = "Todos los campos son obligatorios.";
            }

            // Validar correo electrónico
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "El correo electrónico no es válido.";
            }

            // Si no hay errores, muestra un mensaje de éxito
            if (empty($errors)) {
                // Aquí puedes agregar la lógica para guardar la consulta en la base de datos o enviarla por correo
                return redirect()->to('/contacto')->with('mensaje', '¡Consulta enviada exitosamente! Gracias, ' . $nombre . ' ' .
                    $apellido);
            } else {
                // Si hay errores, pasar los errores a la vista
                $data['errores'] = $errors;
            }
        }

        // Si se llega aquí, se mostrará el formulario nuevamente con errores
        $data['titulo'] = 'Contacto';
        return view('plantillas/header', $data) . view('plantillas/navbar') . view('front/contacto', $data) .
            view('plantillas/footer');
    }
}
