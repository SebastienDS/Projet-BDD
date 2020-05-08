<?php

function get_onglets($role) {
    switch($role) {
        case "Administrateur":
            return ["Gérer les comptes utilisateurs", "Gérer les résidences"];
        case "Jardinier":
            return ["Mes résidences", "Mon salaire", "Mon syndic"];
        case "Chef Jardinier":
            return ["Mes résidences", "Mon salaire", "Mon syndic"];
        case "Syndic":
            return ["Mes résidences", "Mes Outils", "Mes contacts"];
    }
}

function get_links($role) {
    switch($role) {
        case "Administrateur":
            return ["gestion_des_comptes.php"];
        case "Jardinier":
            return [];
        case "Chef Jardinier":
            return [];
        case "Syndic":
            return [];
    }
}

function get_recherche_query($array) {
    $recherche = [];
    $var = [];
    foreach ($array as $key => $value) {
        $recherche[] = "$key = ?";
        $var[] = $value;
    }
    $query = "SELECT num_individu as 'Numéro', nom_individu as 'Nom', prenom_individu as 'Prénom', adresse_individu as 'Adresse', telephone_individu as 'Numéro de Téléphone', date_de_naissance_jardinier as 'Date de naissance', sexe as 'Sexe', diplome as 'Diplome', anciennete as 'Ancienneté', possibilite_responsable as 'Possibilite responsable', num_individu_membre as 'Numéro du chef' from Individu natural join Jardinier ";
    if ($var) {
        $query.= "where ". implode(" and ", $recherche);
    }
    return array($query, $var);
}

?>