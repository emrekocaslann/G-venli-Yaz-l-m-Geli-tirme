<?php
session_start();

// GET ile gelen kullanıcı adı ve şifre parametrelerini kontrol et
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['username']) && isset($_GET['password'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];

    // Güvensiz bağlantı ve sorgu (SQL Injection'a açık)
    $conn = mysqli_connect("localhost", "root", "abc123", "user_management");

    // SQL Injection açığı için hazır bir hale getirilmiş sorgu
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['login_time'] = time();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        header("Location: anasayfa.php");
        exit();
    } else {
        echo "Kullanıcı adı veya şifre hatalı.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <style>
        body {
            background: #000;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png'),
                              linear-gradient(to right, #333333, #555555);
            background-repeat: repeat, no-repeat;
            background-position: center, center;
            background-size: auto, cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Arial', sans-serif;
            color: #dddddd;
            margin: 0;
        }

        .container {
            background-color: rgba(50, 50, 50, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            margin-bottom: 20px;
            color: #ff6f61;
        }

        label {
            display: block;
            margin: 15px 0 5px;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ff6f61;
            border-radius: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
            background-color: #555;
            color: #ffffff;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 15px;
        }

        button.login {
            background-color: #ff4d4d;
        }

        button.login:hover {
            background-color: #ff0000;
        }

        button.signup {
            background-color: #ffdd00;
            color: #333;
        }

        button.signup:hover {
            background-color: #ffc300;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
        }

        nav ul li {
            display: inline;
            margin: 0 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: #ff6f61;
            border-bottom: 2px solid transparent;
            transition: border-bottom 0.3s;
        }

        nav ul li a:hover {
            border-bottom: 2px solid #ff6f61;
        }

        .error {
            color: #ff4d4d;
            margin-top: 10px;
        }

    </style>
</head>
<body>

    <div class="container">
        <h2>Siteye Giriş Ekranı</h2>
        <form action="giris.php" method="get"> 
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit" class="login">Giriş Yap</button>
        </form>
        
        <button type="button" class="signup" onclick="location.href='kayit.php'">Kayıt Ol</button>      
    </div>
    

</body>
</html>
