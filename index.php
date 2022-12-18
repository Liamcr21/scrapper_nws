
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">    <link rel="stylesheet" href="style.css">
    <title>Boutique de Liamcr</title>
  </head>
  <body>
    <h1 class= "display-4">Boutique de Liamcr</h1>
    <div class="container">
      <h2 class= "display-4">Produits disponible :</h2>
      <div class="row">
        <?php
          // ID bdd
        $host = 'localhost';
        $user = 'root';
        $password = '';
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