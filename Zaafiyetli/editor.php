
<?php
session_start();
$conn = mysqli_connect("localhost", "root", "abc123", "user_management");

if ($_SESSION['user_role'] == 'viewer' || $_SESSION['user_role'] == 'admin') {
    echo "<script>alert('Bu sayfaya erişim izniniz yok.'); window.location.href = 'anasayfa.php';</script>";
    exit;
}

// Kullanıcıları listeleme işlemi
$userResult = mysqli_query($conn, "SELECT * FROM users");
$users = mysqli_fetch_all($userResult, MYSQLI_ASSOC);

// Ürünleri listeleme işlemi
$productResult = mysqli_query($conn, "SELECT * FROM products");
$products = mysqli_fetch_all($productResult, MYSQLI_ASSOC);

// Kullanıcı silme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    mysqli_query($conn, "DELETE FROM users WHERE id = $user_id");
    header("Location: editor.php");
    exit;
}

// Kullanıcı güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $role = $_POST['role'];
    mysqli_query($conn, "UPDATE users SET role = '$role' WHERE id = $user_id");
    header("Location: editor.php");
    exit;
}

// Ürün silme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $product_id");
    header("Location: editor.php");
    exit;
}

// Ürün güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $product_id = $_POST['id'];
    $urun_adi = $_POST['urun_adi'];
    $fiyat = $_POST['fiyat'];
    $stok = $_POST['stok'];
    mysqli_query($conn, "UPDATE products SET urun_adi = '$urun_adi', fiyat = '$fiyat', stok = '$stok' WHERE id = $product_id");
    header("Location: editor.php");
    exit;
}
?>
<!--php
session_start();
require 'config.php';

if ($_SESSION['user_role'] == 'viewer') {
    echo "<script>alert('Bu sayfaya erişim izniniz yok.'); window.location.href = 'anasayfa.php';</script>";
    exit;
  
}
if ($_SESSION['user_role'] == 'admin') {
    echo "<script>alert('Bu sayfaya erişim izniniz yok.'); window.location.href = 'anasayfa.php';</script>";
    exit;
}  

// Kullanıcıları listeleme işlemi
$stmt = $pdo->query('SELECT * FROM users');
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ürünleri listeleme işlemi
$stmt = $pdo->query('SELECT * FROM products');
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);



// Kullanıcı silme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    header("Location: editor.php");
    exit;
}

// Kullanıcı güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $role = $_POST['role'];
    $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->execute([$role, $user_id]);
    header("Location: editor.php");
    exit;
}


// Ürün silme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    header("Location: editor.php");
    exit;
}

// Ürün güncelleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $stmt = $pdo->prepare("UPDATE products SET urun_adi = ?, fiyat = ?, stok = ? WHERE id = ?");
    $stmt->execute([$product_name, $price, $stock, $product_id]);
    header("Location: editor.php");
    exit;
}
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editör Paneli</title>
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
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Genel stil */
        body {
            background-color: #f2f2f2; /* Gri arka plan rengi */
            background-image: url('https://www.transparenttextures.com/patterns/45-degree-fabric-light.png'); /* Desen */
            color: #333; /* Metin rengini koyu gri yap */
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        th, td {
            padding: 12px 16px; /* Daha geniş hücre içi boşluk */
            border-bottom: 1px solid #ddd;
            border-radius: 8px; /* Çerçeveleri yumuşat */
        }

        th {
            background-color: #8e44ad; /* Başlık arka plan rengini mor yap */
            color: #fff; /* Başlık metin rengini beyaz yap */
        }

        td {
            background-color: #fff; /* Hücre arka plan rengini beyaz yap */
        }

        button, .logout-button {
            background-color: #9b59b6; /* Buton arka plan rengini mor yap */
            color: #fff; /* Buton metin rengini beyaz yap */
            border: none;
            padding: 10px 20px; /* Daha geniş butonlar */
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            text-decoration: none;
            font-size: 16px;
        }

        button:hover, .logout-button:hover {
            background-color: #8e44ad; /* Buton hover arka plan rengini koyu mor yap */
            transform: translateY(-3px);
        }

        input[type="submit"],
        button[type="submit"] {
            background-color: #9b59b6;
            color: #fff;
            border: none;
            padding: 12px 24px; /* Daha geniş butonlar */
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-size: 16px;
        }

        input[type="submit"]:hover,
        button[type="submit"]:hover {
            background-color: #8e44ad;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <!-- İçerik buraya gelecek -->
</body>
</html>

</head>
<body>
    <!-- İçerik buraya gelecek -->
</body>
</html>

</head>
<body>
    <!-- İçerik buraya gelecek -->
</body>
</html>

</head>
<body>
    <!-- İçerik buraya gelecek -->
</body>
</html>

</head>
<body>
    <!-- İçerik buraya gelecek -->
</body>
</html>

</head>
<body>
    <!-- İçerik buraya gelecek -->
</body>
</html>

</head>
<body>
    <h1>Editör Paneli</h1>
    <p>Hoş geldiniz, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    <body>
    <a href="anasayfa.php" class="button logout-button">
        <span class="button-icon">🔓</span> Çıkış Yap
    </a>
</body>

    <h2>Kullanıcılar</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Kullanıcı Adı</th>
            <th>Yetki Rolü</th>
            <th>İşlem</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <select name="role">
                            <option value="viewer" <?php if ($user['role'] === 'viewer') echo 'selected'; ?>>Viewer</option>
                            <option value="editor" <?php if ($user['role'] === 'editor') echo 'selected'; ?>>Editor</option>
                        </select>
                        <button type="submit" name="update_user">Güncelle</button>
                    </form>
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
            <th>İşlem</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['urun_adi']; ?></td>
                <td><?php echo $product['fiyat']; ?></td>
                <td><?php echo $product['stok']; ?></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="update_product">Güncelle</button>
                    </form>
                </td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="delete_product">Sil</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
