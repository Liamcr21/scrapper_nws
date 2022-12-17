<form method="POST" action="">
    <input type = "hidden" value="" name="produit">
    <input type ="submit" name ="btnproduit" value = "Envoyer les produits">
</form>


<?php

    if(isset($_POST['btnproduit'])) {
        // Connection variables
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'scrappernws';

        // Connect to the database
        try {
            $db = new PDO("mysql:host=$host;dbname=$database", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }

        if($_POST['produit']){
            // Read the contents of the JSON file
            $json = file_get_contents('pageacc.json');
            $data = json_decode($json);

            // Insert the data into the database
            foreach ($data as $row) {
                $sql = "INSERT INTO produit (titre, img, sale, lien) VALUES (:titre, :img, :sale, :lien)";
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    'titre' => $row->titre,
                    'img' => $row->img,
                    'sale' => $row->sale,
                    'lien' => $row->lien
                ]);
            }
        }
     }

        ?>