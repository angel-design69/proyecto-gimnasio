<?php
include("conexion.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['email'];
    $contraseña = $_POST['password'];

    // Primero verificamos si es ADMIN (contraseña normal sin hash)
    $sql_admin = "SELECT * FROM admin WHERE correo = ?";
    $stmt_admin = $conn->prepare($sql_admin);
    $stmt_admin->bind_param("s", $correo);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin->num_rows > 0) {
        $admin = $result_admin->fetch_assoc();

        // Comparar directamente (texto plano)
        if ($contraseña === $admin['contraseña']) {
            $_SESSION['rol'] = 'admin';
            $_SESSION['correo'] = $correo;
            header("Location: admin.php");
            exit();
        }
    }

    // Si no es admin, probamos con usuarios (contraseña hasheada)
    $sql_usuario = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt_user = $conn->prepare($sql_usuario);
    $stmt_user->bind_param("s", $correo);
    $stmt_user->execute();
    $result_usuario = $stmt_user->get_result();

    if ($result_usuario->num_rows > 0) {
        $usuario = $result_usuario->fetch_assoc();

        // Usamos password_verify para comparar hash
        if (password_verify($contraseña, $usuario['contraseña'])) {
            $_SESSION['rol'] = 'usuario';
            $_SESSION['correo'] = $correo;
            header("Location: usuario.php");
            exit();
        }
    }

    // Si no pasó ninguno de los dos
    echo "<script>alert('Correo o contraseña inválido'); window.location='secion.html';</script>";
}
?>
