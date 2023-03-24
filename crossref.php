<?php
// URL de base de l'API Crossref
$base_url = "https://api.crossref.org/";

// DOI de l'article que vous souhaitez récupérer les "cited-by"
$doi = "10.1234/56789";

// URL de l'API pour récupérer les "cited-by"
$url = $base_url . "works/" . $doi . "/citations";

// Appel de l'API avec la fonction file_get_contents() et décodage du résultat JSON en tableau PHP
$result = json_decode(file_get_contents($url), true);

// Vérification si le résultat a été correctement récupéré
if ($result["status"] == "ok") {
  // Affichage des "cited-by"
  foreach ($result["message"]["items"] as $item) {
    echo $item["DOI"] . "<br>";
  }
} else {
  echo "Erreur lors de la récupération des données.";
}

?>