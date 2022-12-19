
<!doctype html>
<html lang="fr">
  <head>
  	<title>Boutique de Liamcr</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="style/styleindex.css">
	</head>
  <body>
    <h1 class= "display-4">Boutique de Liamcr</h1><br>
    <a href="bdd.php" class="btn btn-primary" role="button">json to bd</a>
    <div class="container">
      <h2 class= "display-4">Produits disponible :</h2>
      <div class="row">
        <?php
          // ID bdd
        $host = 'localhost';
        $user = 'root';
        $password = 'liamcrbdd';
        $database = 'scrappernws';

        // Connection bdd
        try {
            $db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
          $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
          $perPage = 16;
          $offset = $perPage * ($page - 1);
          $stmt = $db->query("SELECT * FROM produit LIMIT $offset, $perPage");
          $produits = $stmt->fetchAll();

// produit venant de la bdd
        foreach ($produits as $produit) : ?>
          <div class='produit-grid'>
            <div><img src="<?=$produit['img']?>" class="img" style="width: 18rem;"></div>
            <diV><h5 class="card-title"><?= $produit['titre'] ?></h5></div>
            <diV><span class="badge bg-success"><?= $produit['sale'] ?><span></div>
            <form method="POST" action="article.php">
              <input type="hidden" name="productId" value="<?= $produit['lien'] ?>">
              <button type = "submit" class="btn btn-primary">Voir le produit !</button>
            </form>
          </div>
          <?php endforeach; ?>
        
      </div>
    </div>
<ul class= "pagination">
    <?php
      // Lien de la pagination
      $total = $db->query("SELECT COUNT(*) FROM produit")->fetchColumn();
      $numPages = ceil($total / $perPage);
      for ($i = 1; $i <= $numPages; $i++) {
        if ($i == $page) {
          echo "<span>$i</span>";
        } else {
          echo "<a href='?page=$i'>$i</a>";
        }
      }
    ?>
  </ul>
  </body>
</html>