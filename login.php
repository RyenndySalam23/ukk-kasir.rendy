<?php
include "koneksi.php";
if(isset($_POST{'username'})) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $cek = mysqli_query($koneksi, "SELECT*FROM user WHERE username='$username' AND password='$password'");

    if(mysqli_num_rows($cek) > 0) {
        $data = mysqli_fetch_array($cek);
        $_SESSION['user'] = [
            'id_user' => $data['id_user'],
            'nama' => $data['nama'],
            'username' => $data['username'],
            'level' => $data['level']
        ];

        switch ($data['level']) {
            case 'manajer':
                header("Location: index.php");
                break;
            case 'admin':
                header("Location: adminpage.php");
                break;
            case 'kasir':
                header("Location: kasirpage.php");
                break;
            default:
                echo '<script>alert("Level user tidak dikenal.");</script>';
                break;

        }


        echo '<script>alert("Selamat datang, jangan lupa logout setelah menggunakan halaman ini"); location.href="index.php"</script>';
    }
    else{

        echo '<script>alert("Username dan Password salah.");</script>';
    }
    
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background-color: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        .login-box h3 {
            margin-bottom: 1.5rem;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h3 class="text-center">Login Aplikasi Kasir</h3>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger text-center"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Masuk</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>