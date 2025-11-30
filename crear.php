<?php
include("conexion.php");
require __DIR__ . '/vendor/autoload.php'; // Twilio

use Twilio\Rest\Client;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Datos del usuario
    $nombre = $_POST["nombre"] . " " . $_POST["apellido"];
    $email = $_POST["mail"];
    $contra = $_POST["contra"];
    $contracon = $_POST["contracon"];
    $telefono = $_POST["telefono"];  // <-- AGREGA este campo en tu formulario

    // Validar contraseñas
    if ($contra === $contracon) {

        // Encriptar contraseña
        $contrasena_hash = password_hash($contra, PASSWORD_DEFAULT);

        // Procesar imagen
        $foto = $_FILES["foto"]["name"];
        $temp = $_FILES["foto"]["tmp_name"];
        $rutaDestino = "uploads/" . basename($foto);

        // Crear carpeta si no existe
        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        // Subir la imagen
        if (move_uploaded_file($temp, $rutaDestino)) {

            // Guardar datos en la BD
            $sql = "INSERT INTO usuarios (nombre_usuario, correo, contraseña, foto, telefono) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("sssss", $nombre, $email, $contrasena_hash, $rutaDestino, $telefono);

               

                    // Todo correcto
                    echo "<script>
                            alert('Cuenta creada con éxito.');
                            window.location.href = 'secion.html';
                          </script>";

                } else {
                    echo "<script>
                            alert('Error al guardar en la base de datos: " . addslashes($stmt->error) . "');
                            window.history.back();
                          </script>";
                }

                $stmt->close();
            } else {
                echo "<script>
                        alert('Error al preparar la consulta: " . addslashes($conn->error) . "');
                        window.history.back();
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Error al subir la imagen.');
                    window.history.back();
                  </script>";
        }

        $conn->close();

    } else {
        echo "<script>
                alert('Verificar contraseñas: no coinciden.');
                window.history.back();
              </script>";
    }
?>
