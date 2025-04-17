<?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validación simple
            if (empty($email) || empty($password)) {
                echo '<div class="error-message">Todos los campos son obligatorios.</div>';
            } else {
                // Procesar el inicio de sesión
                $usuario_valido = 'usuario@example.com';
                $contraseña_valida = '123456';

                if ($email === $usuario_valido && $password === $contraseña_valida) {
                    echo '<div style="color: green;">Inicio de sesión exitoso.</div>';
                } else {
                    echo '<div class="error-message">Correo electrónico o contraseña incorrectos.</div>';
                }
            }
        }