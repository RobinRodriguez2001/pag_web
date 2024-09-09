<?php 
session_start();

// Configuración de la base de datos
$servername = "localhost";
$username_db = "root";
$password_db = "danigero";
$dbname = "transportes";

// Crear la conexión
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $action = $_POST['action']; // Identificar si es login o registro

    if ($action == 'login') {
        // Verificar usuario para inicio de sesión
        $sql = "SELECT contra FROM credenciales WHERE correo = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['contra'])) {
                $_SESSION['usuario'] = 'ok';
                $_SESSION['nombreUsuario'] = $username;
                header("Location: /med/productos.php");
                exit();
            } else {
                $mensaje = "Error: El usuario o contraseña son incorrectos";
            }
        } else {
            $mensaje = "Error: El usuario no existe";
        }
    } elseif ($action == 'register') {
        // Registrar nuevo usuario
        $sql_check = "SELECT * FROM credenciales WHERE correo = '$username'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows == 0) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hashear la contraseña
            $sql = "INSERT INTO credenciales (correo, contra) VALUES ('$username', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['usuario'] = 'ok';
                $_SESSION['nombreUsuario'] = $username;
                header("Location: /med/productos.php");
                exit();
            } else {
                $mensaje = "Error: No se pudo registrar el usuario. Inténtalo de nuevo.";
            }
        } else {
            $mensaje = "Error: El usuario ya está registrado.";
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Administrador</title>
</head>
<body>
    <div class="wrapper">
        <h2 id="form-title">Welcome</h2>
        <?php if (isset($mensaje)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $mensaje; ?>
        </div>
        <?php } ?>
        <form action="" method="post" id="auth-form">
            <div class="input-field">
                <input type="email" id="email" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <input type="hidden" name="action" id="action" value="login"> <!-- Acción predeterminada: Login -->
            <a href="#" class="forgot" id="forgot-link"><p>Forgot password?</p></a>
            <button type="submit" class="login" id="submit-button">Login</button>
            <p id="toggle-text">Don't have an account? <a href="#" class="sign-up" onclick="toggleForm()">Sign up</a></p>
        </form>
    </div>

    <script>
        function toggleForm() {
            const formTitle = document.getElementById('form-title');
            const actionInput = document.getElementById('action');
            const submitButton = document.getElementById('submit-button');
            const toggleText = document.getElementById('toggle-text');
            const forgotLink = document.getElementById('forgot-link');

            if (actionInput.value === 'login') {
                actionInput.value = 'register';
                formTitle.innerText = 'Create Account';
                submitButton.innerText = 'Register';
                toggleText.innerHTML = 'Already have an account? <a href="#" class="sign-up" onclick="toggleForm()">Login</a>';
                forgotLink.style.display = 'none';
            } else {
                actionInput.value = 'login';
                formTitle.innerText = 'Welcome';
                submitButton.innerText = 'Login';
                toggleText.innerHTML = 'Don\'t have an account? <a href="#" class="sign-up" onclick="toggleForm()">Sign up</a>';
                forgotLink.style.display = 'block';
            }
        }
    </script>
</body>
</html>