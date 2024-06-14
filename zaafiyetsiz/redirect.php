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
  // Kullanıcı bilgilerini tanımla veya varsayılan değerlerle doldur
  $ad = 'Emre';
  $soyad = 'Koçaslan';
  $eposta = 'emrekocaslan00@gmail.com';
  $adres = 'Sincan/Ankara';

  // Güvenli bir şekilde yönlendirilecek URL'yi belirle
  $allowed_urls = array(
    "https://www.facebook.com/",
    
  );

  // Eğer URL'de redirect parametresi varsa ve izin verilen URL'lerden biriyle eşleşiyorsa, yönlendirme yap
  if (isset($_GET['redirect']) && in_array($_GET['redirect'], $allowed_urls)) {
      $redirect_url = $_GET['redirect'];
      header("Location: $redirect_url");
      exit; // Yönlendirme yapıldıktan sonra işlemi sonlandır
  }
  ?>
  <!-- İletişim bilgilerini ekrana yazdır -->
  <p>Ad: <?php echo htmlspecialchars($ad); ?></p>
  <p>Soyad: <?php echo htmlspecialchars($soyad); ?></p>
  <p>Eposta: <?php echo htmlspecialchars($eposta); ?></p>
  <p>Adres: <?php echo htmlspecialchars($adres); ?></p>

  <!-- Güvenli şekilde yönlendirme yapılabilmesi için kullanıcıya belirli URL'ler sun -->
  <a href="?redirect=https://www.facebook.com/" class="button">Facebook</a>
  
</div>
</body>
</html>
