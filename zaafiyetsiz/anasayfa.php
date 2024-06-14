<?php
session_start();
require __DIR__ . '/session_functions.php';

$conn = mysqli_connect("localhost", "root", "abc123", "user_management");
include 'auth.php';
requireAuth();

// Kullanıcının oturum açıp açmadığını kontrol et
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION["email"];

// Oturum süresinin dolup dolmadığını kontrol et
if (!checkSessionTimeout()) {
    header('Location: giris.php');
    exit();
}

// Oturum süresini hesapla
$login_time = $_SESSION['login_time'];
$current_time = time();
$session_duration = $current_time - $login_time;

$hours = floor($session_duration / 3600);
$minutes = floor(($session_duration % 3600) / 60);
$seconds = $session_duration % 60;

// Form gönderimini işle
$welcomeMessage = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_name']) && isset($_POST['user_surname'])) {
    $user_name = $_POST['user_name'];
    $user_surname = $_POST['user_surname'];

    // Kullanıcı girişini XSS saldırılarına karşı korumak için temizle
    // < ve > karakterlerini kontrol et ve reddet
    if (strpos($user_name, '<') !== false || strpos($user_name, '>') !== false || strpos($user_surname, '<') !== false || strpos($user_surname, '>') !== false) {
        $welcomeMessage = "İsim ve Soyisim alanlarında < ve > karakterleri kullanılamaz.";
    } else {
        $user_name = htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8');
        $user_surname = htmlspecialchars($user_surname, ENT_QUOTES, 'UTF-8');
        $welcomeMessage = "Hoşgeldiniz, " . $user_name . " " . $user_surname . "!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ana Sayfa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0a122a; /* Koyu bir arka plan rengi */
            margin: 0;
            color: #fff; /* Yazı rengi */
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png'); /* Yıldız desenli arka plan */
        }
        header {
            background-color: #222;
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav ul {
            background-color: #222;
            list-style-type: none;
            padding: 10px;
            text-align: center;
            margin: 0;
        }
        nav ul li {
            display: inline;
            margin: 0 15px;
        }
        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        main {
            padding: 20px;
        }
        main section {
            margin-bottom: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Saydamlık ekleyerek arka planı görünür kılma */
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        footer {
            background-color: #222;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .profile-image {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .profile-info, .contact-info {
            text-align: left;
        }
        .content-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .profile-info p, .contact-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="anasayfa.php">Ana Sayfa</a></li>
            <li><a href="editor.php">Editor</a></li> 
            <li><a href="admin.php">Admin</a></li> 
            <li><a href="urunler.php">Bilgisayar Ekle Sil</a></li>
            <li><a href="cihazlar.php">Bilgisayarlar</a></li>
            <li><a href="ajax_search.php">Ürün Ara</a></li>
            <li><a href="redirect.php">İletisim</a></li>
            <li><a href="cikis.php">Çıkış Yap</a></li>
        </ul>
    </nav>
    <main>
        <div class="content-wrapper">
            <section>
                <h2>Profilim</h2>
                <img src="profil_resmi.jpg" alt="Profil Resmi" class="profile-image">
                <div class="profile-info">
                    <!-- Kullanıcı adını XSS saldırılarına karşı korumak için temizle ve göster -->
                    <p><strong>Ad:</strong> <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
                <div class="contact-info">
                    <!-- Email'i XSS saldırılarına karşı korumak için temizle ve göster -->
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </section>
            <section>
                <h2>Hoşgeldiniz Mesajı</h2>
                <form method="post" action="">
                    <label for="user_name">İsminiz:</label>
                    <input type="text" id="user_name" name="user_name" required>
                    <label for="user_surname">Soyadınız:</label>
                    <input type="text" id="user_surname" name="user_surname" required>
                    <button type="submit">Gönder</button>
                </form>
                <?php if ($welcomeMessage) : ?>
                    <p><?php echo $welcomeMessage; ?></p>
                <?php endif; ?>
            </section>
            <p>Oturum süresi: <?php echo sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds); ?></p>
        </div>
    </main>
    <footer>
        &copy; 2024 My Website
    </footer>
</body>
</html>
