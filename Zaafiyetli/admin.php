
<?php
session_start();
$conn = mysqli_connect("localhost", "root", "abc123", "user_management");

if ($_SESSION['user_role'] == 'viewer' || $_SESSION['user_role'] == 'editor') {
    echo "<script>alert('Bu sayfaya erişim izniniz yok.'); window.location.href = 'anasayfa.php';</script>";
    exit;
}

// Oturum süresini hesaplama fonksiyonu
function calculateSessionDuration($login_time, $logout_time) {
    $session_duration = $logout_time - $login_time;
    $hours = floor($session_duration / 3600);
    $minutes = floor(($session_duration % 3600) / 60);
    $seconds = $session_duration % 60;

    return array($hours, $minutes, $seconds);
}


// Kullanıcıları listeleme işlemi
$userResult = mysqli_query($conn, "SELECT * FROM users");
$users = mysqli_fetch_all($userResult, MYSQLI_ASSOC);

// Ürünleri listeleme işlemi
$cihazlarResult = mysqli_query($conn, "SELECT * FROM cihazlar");
$cihazlar = mysqli_fetch_all($cihazlarResult, MYSQLI_ASSOC);

// Kullanıcı silme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    mysqli_query($conn, "DELETE FROM users WHERE id = $user_id");
    header("Location: admin.php");
    exit;
}

// Kullanıcı güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $role = $_POST['role'];
    mysqli_query($conn, "UPDATE users SET role = '$role' WHERE id = $user_id");
    header("Location: admin.php");
    exit;
}

// Ürün silme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_cihazlar'])) {
    $cihazlar_id = $_POST['cihazlar_id'];
    mysqli_query($conn, "DELETE FROM cihazlar WHERE id = $cihazlar_id");
    header("Location: admin.php");
    exit;
}

// Ürün güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cihazlar'])) {
    $cihazlar_id = $_POST['id'];
    $ad = $_POST['ad'];
    $fiyat = $_POST['fiyat'];
    $stok = $_POST['stok'];
    $aciklama = $_POST['aciklama'];
    
    mysqli_query($conn, "UPDATE cihazlar SET aciklama = '$aciklama', ad = '$ad', fiyat = '$fiyat', stok = '$stok' WHERE id = $cihazlar_id");
    header("Location: admin.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Yönetici Paneli</title>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #1a1a1a; /* Daha açık siyah arka plan rengi */
            background-image: radial-gradient(#fff 0.5px, transparent 0.5px), 
                              radial-gradient(#fff 0.5px, transparent 0.5px);
            background-size: 50px 50px;
            background-position: 0 0, 25px 25px;
            color: #fff; /* Metin rengini beyaz yap */
            margin: 0;
            font-family: Arial, sans-serif;
        }

        th, td {
            padding: 8px 10px;
            border-bottom: 1px solid #8a2be2; /* Çerçeve rengini mor olarak değiştirildi */
            border-radius: 10px; /* Oval köşeler eklendi */
        }

        th {
            background-color: #8a2be2; /* Başlık arka plan rengini mor olarak değiştirildi */
            color: #fff;
            border-radius: 10px 10px 0 0; /* Başlık hücreleri için oval köşeler */
        }

        td {
            background-color: #333; /* Hücre arka plan rengini koyu yaptı */
            border-radius: 0 0 10px 10px; /* İç hücreler için oval köşeler */
        }

        a.button {
            background-color: #8a2be2; /* Buton arka plan rengini mor olarak değiştirildi */
            color: #fff;
            text-decoration: none; /* Bağlantı alt çizgisini kaldır */
            padding: 8px 16px;
            border-radius: 10px; /* Oval köşeler eklendi */
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: inline-flex;
            align-items: center;
        }

        a.button:hover {
            background-color: #6b238e; /* Buton hover arka plan rengini mor olarak değiştirildi */
            transform: translateY(-3px);
        }

        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .button-icon {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <a href="anasayfa.php" class="button logout-button">
        <span class="button-icon">🔓</span> Çıkış Yap
    </a>
</body>
</html>

</head>
<body>
    <a href="anasayfa.php" class="button logout-button">
        <span class="button-icon">🔓</span> Çıkış Yap
    </a>
</body>
</html>

</head>
<body>
    <a href="anasayfa.php" class="button logout-button">
        <span class="button-icon">🔓</span> Çıkış Yap
    </a>
</body>
</html>

</head>
<body>
    <a href="anasayfa.php" class="button logout-button">
        <span class="button-icon">🔓</span> Çıkış Yap
    </a>
</body>
</html>

</head>

</html>



</head>
<body>
    <h1>ADMİN PANELİ</h1>
   
    <a href="anasayfa.php" class="button logout-button">
        <span class="button-icon">🔓</span> Çıkış Yap
    </a>

    <h2>Kullanıcılar</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Kullanıcı Adı</th>
            <th>Şifre</th>
            
            <th>E-posta</th>
            
            
            <th>Yetki Rolü</th>
            <th>Oturum Süresi</th>
            <th>İşlem</th>
            </tr>
       
       
        <?php foreach ($users as $user): ?>
            <tr>
           
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['password']; ?></td>
                
                <td><?php echo $user['email']; ?></td>
               
                
              
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <select name="role">
                            <option value="admin" <?php if ($user['role'] === 'admin') echo 'selected'; ?>>Admin</option>
                            <option value="editor" <?php if ($user['role'] === 'editor') echo 'selected'; ?>>Editor</option>
                        </select>
                        <button type="submit" name="update_user">Güncelle</button>
                    </form>
                </td>
                <td>
                <?php
                   // Oturumu kapalı olan kullanıcıların oturum süresini hesapla ve yazdır
if ($user['logout_time'] != null) {
    $login_time = strtotime($user['login_time']);
    $logout_time = strtotime($user['logout_time']);
    $session_duration = calculateSessionDuration($login_time, $logout_time);
    printf("%02d:%02d:%02d", $session_duration[0], $session_duration[1], $session_duration[2]);
} else {
    echo "Oturum süresi dolmuş.";
}

                    ?>


                </td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <button type="submit" name="delete_user">Sil</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Ürünler</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Ürün Adı</th>
            <th>Fiyat</th>
             <th>Stok</th>
             <th>Kategori</th>
            <th>Açıklama</th>
   
            <th>İşlem</th>
        </tr>
        <?php foreach ($cihazlar as $cihazlar): ?>
            <tr>
                <td><?php echo $cihazlar['id']; ?></td>
                <td><?php echo $cihazlar['ad']; ?></td>
                <td><?php echo $cihazlar['fiyat']; ?></td>
                <td><?php echo $cihazlar['stok']; ?></td>
                <td><?php echo $cihazlar['kategori']; ?></td>
               
                <td><?php echo $cihazlar['aciklama']; ?></td>

                <td>
                    <form action="" method="post">
                        <input type="hidden" name="cihazlar_id" value="<?php echo $cihazlar['id']; ?>">
                        <button type="submit" name="delete_cihazlar">Sil</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <script>
        setInterval(function() {
            window.location.reload();
        }, 6000); // Sayfayı her saniyede bir yenile
    </script>
</body>
</html>



  
       