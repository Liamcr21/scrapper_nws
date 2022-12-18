
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Boutique </title>
  </head>
  <body>

    <h1 class= "display-4">Boutique du rat</h1>
    <div class="container">
      <h2 class= "display-4">Produit</h2>
      <div class="row">
        <?php

$host = 'localhost';
$user = 'root';
$password = 'liamcrbdd';
$database = 'scrappernws';

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
          $items = $stmt->fetchAll();


        foreach ($items as $item) : ?>
          <div class='grid-item'>
            <div><img src="<?=$item['img']?>" ></div>
            <diV><h5 class="card-title"><?= $item['titre'] ?></h5></div>
            <diV><span class="badge bg-success"><?= $item['sale'] ?><span></div>
            <form method="POST" action="article.php">
              <input type="hidden" name="productId" value="<?= $item['lien'] ?>">
              <button type = "submit" class="btn btn-primary">Go to Page!</button>
            </form>
          </div>
          <?php endforeach; ?>
        
      </div>
    </div>
<ul class= "pagination">
    <?php
      // Generate the pagination links
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