<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>İletişim Bilgileri</title>
<style>
.button {
  display: inline-block;
  padding: 10px 20px;
  background-color: #4CAF50;
  color: white;
  text-decoration: none;
  border-radius: 5px;
}

.container {
  text-align: center;
  margin-top: 50px;
}
</style>
</head>
<body>
<div class="container">
  <?php
  // kullanıcı bilgilerini tanımla veya varsayılan değerlerle doldur
  $ad = 'Emre';
  $soyad = 'Koçaslan';
  $eposta = 'emrekocaslan00@gmail.com';
  $adres = 'Sincan/Ankara';

  // Eğer URL'de redirect parametresi varsa, yönlendirme yap
  if (isset($_GET['redirect'])) {
      $redirect_url = $_GET['redirect'];
      header("Location: $redirect_url");
      exit;
  }
  ?>
  <!-- İletişim bilgilerini ekrana yazdır -->
  <p>Ad: <?php echo $ad; ?></p>
  <p>Soyad: <?php echo $soyad; ?></p>
  <p>Eposta: <?php echo $eposta; ?></p>
  <p>Adres: <?php echo $adres; ?></p>

  <a href="redirect.php?redirect=https://www.facebook.com/" class="button">facebook</a>
</div>
</body>
</html>
