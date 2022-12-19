<!doctype html>
<html lang="fr">
  <head>
  	<title>pageacc.json vers bdd</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style/style.css">
	</head>
	<body>
<section class="ftco-section">
<a href="index.php" class="btn btn-primary" role="button">revenir sur le site</a>

		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">pageacc.json vers bdd</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(logo.png);"></div>
						<div class="login-wrap p-4 p-md-5">
			      	
                      <form method="POST" action="">
    <input type = "hidden" value= "produitacc" name="produitacc">
    <input type ="submit" name ="btnproduit" class="form-control btn btn-primary rounded submit px-3" value = "Envoyer les produits">
    
</form> 
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

    </body>
</html>

<?php

    if(isset($_POST['btnproduit'])) {
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

        if($_POST['produitacc']){
            // Json decode
            $json = file_get_contents('pageacc.json');
            $data = json_decode($json);

            // Insertion donnée json dans bdd
            foreach ($data as $row) {
                $sql = "INSERT INTO produit (titre,img,sale,lien) VALUES (:value1, :value2, :value3, :value4)";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    'value1' => $row->titre,
                    'value2' => $row->img,
                    'value3' => $row->sale,
                    'value4' => $row->lien,
                ]);
            }
        }

    }

    ?>

