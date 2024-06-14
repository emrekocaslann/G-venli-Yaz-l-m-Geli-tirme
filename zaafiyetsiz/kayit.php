<?php
// Veritabanı bağlantısı
$conn = mysqli_connect("localhost", "root", "abc123", "user_management");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $email = $_POST['email'];
   

    // Aynı rolde başka kullanıcı olup olmadığını kontrol et
    $result = mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE role = '$role'");
    $count = mysqli_fetch_array($result)[0];

    // Eğer admin veya editor ise ve o rolde zaten bir kullanıcı varsa hata mesajı göster
    if (($role == 'admin' || $role == 'editor') && $count > 0) {
        echo "Sadece bir $role kullanıcısı olabilir.";
    } else {
        // Kullanıcıyı ekle
        $query = "INSERT INTO users (username, password, role, email) VALUES ('$username', '$password', '$role', '$email')";
        if (mysqli_query($conn, $query)) {
            echo "Kullanıcı başarıyla eklendi.";
        } else {
            echo "Kullanıcı ekleme hatası.";
        }
    }
}
?>

<!--php
 $conn = mysqli_connect("localhost", "root", "abc123", "user_management");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $yas = $_POST['yas'];
    $meslek = $_POST['meslek'];
    $hobiler = $_POST['hobiler'];
    // Veritabanında aynı rolde kaç kullanıcı olduğunu kontrol et
    $sql="SELECT COUNT(*) FROM users WHERE role = ?";
  

    // Eğer admin veya editor ise ve o rolde zaten bir kullanıcı varsa hata mesajı göster
    if (($role == 'admin' || $role == 'editor') && $count > 0) {
        echo "Sadece bir $role kullanıcısı olabilir.";
    } else {

        $sql = "INSERT INTO products (username, password, role, email, yas, meslek, hobiler) VALUES(?, ?, ?, ?, ?, ?, ?) ";
        if (mysqli_query($conn, $sql)) {
            echo "Ürün başarıyla eklendi!";
        } else {
            echo "Hata: " . mysqli_error($conn);
        }
        // Kullanıcıyı ekle
        //$conn="INSERT INTO users (username, password, role, email, yas, meslek, hobiler) VALUES (?, ?, ?, ?, ?, ?, ?)";
        //$stmt->bind_param("sssssss", $username, $password, $role, $email, $yas, $meslek, $hobiler);
        //if ($stmt->execute()) {
        //    echo "Kullanıcı başarıyla eklendi.";
        //} else {
         //   echo "Kullanıcı ekleme hatası.";
        //}
        //$stmt->close();
    }
 // Rol kontrolü yap
 //$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE role = ?");
 //$stmt->execute([$role]);
 //$count = $stmt->fetchColumn();
 //if (($role == 'admin' || $role == 'editor') && $count > 0) {
   // echo "Sadece bir $role kullanıcısı olabilir.";
//} else {
    // Kullanıcıyı ekle
  //  $stmt = $pdo->prepare("INSERT INTO users (username, password, role, email, yas, meslek, hobiler) VALUES (?, ?, ?, ?, ?, ?, ?)");
    //if ($stmt->execute([$username, $password, $role, $email, $yas, $meslek, $hobiler])) {
      //  echo "Kullanıcı başarıyla eklendi.";
    //} else {
      //  echo "Kullanıcı ekleme hatası.";
    //}
}

-->

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ekranı</title>
    <style>
        body {
            background-color: #222; /* Daha açık bir siyah */
            background-image: url('https://www.transparenttextures.com/patterns/asfalt-light.png'); /* Desen ekle */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff; /* Metin rengini beyaz yap */
            margin: 0;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.7); /* Arka plan rengini biraz daha koyulaştır */
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
            color: #ddd; /* Etiket rengini biraz daha açık gri yap */
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ff6f61;
            border-radius: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
            background-color: #444; /* Giriş alanlarının arka planını koyu gri yap */
            color: #fff; /* Metin rengini beyaz yap */
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #ff6f61;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #ff4d4d;
        }
        .register-btn {
            background-color: #ff0000; /* Kayıt ol buton rengi kırmızı */
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

<section id="content" class="container">
    <h2>Hesap Oluştur</h2>
    <form action="kayit.php" method="post">
        <div class="form-group">
            <input name='username' type="text" placeholder="Kullanıcı Adı" required class="form-control">
        </div>
        <div class="form-group">
            <input name='password' type="password" placeholder="Şifre" required class="form-control">
        </div>
        <div class="form-group">
            <input name='email' type="email" placeholder="E-posta" required class="form-control">
        </div>
       
        <div class="form-group">
            <label for="role">Yetkilendir:</label>
            <select name="role" id="role">
                <option value="admin">Admin</option>
                <option value="editor">Editor</option>
                <option value="viewer">Viewer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-lg btn-primary btn-block register-btn">Kayıt ol</button>
    </form>
    <div class="line line-dashed"></div>
    <p class="text-muted text-center"><small>Zaten hesabınız var mı?</small></p>
    <a href="giris.php" class="btn btn-lg btn-default btn-block">Giriş yap</a>
</section>


</body>
</html>

