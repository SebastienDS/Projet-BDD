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
    $query = "SELECT num_individu as 'Numéro', nom_individu as 'Nom', prenom_individu as 'Prénom', adresse_individu as 'Adresse', telephone_individu as 'Numéro de téléphone', date_de_naissance_jardinier as 'Date de naissance', sexe as 'Sexe', diplome as 'Diplome', anciennete as 'Ancienneté', possibilite_responsable as 'Possibilite responsable', num_individu_membre as 'Numéro du chef' from Individu natural join Jardinier ";
    if ($var) {
        $query.= "where ". implode(" and ", $recherche) . " order by num_individu";
    }
    return array($query, $var);
}

function get_insert_individu_query($array) {
    return array("INSERT into Individu (num_individu, nom_individu, prenom_individu, adresse_individu, telephone_individu) values (?,?,?,?,?)", [
        $array["num_individu"] ?? NULL,
        $array["nom_individu"] ?? NULL, 
        $array["prenom_individu"] ?? NULL,
        $array["adresse_individu"] ?? NULL,
        $array["telephone_individu"] ?? NULL
    ]);
}

function get_insert_jardinier_query($array, $id) {
    return array("INSERT into Jardinier (num_individu, date_de_naissance_jardinier, sexe, diplome, anciennete, possibilite_responsable) values (?,?,?,?,?,?)", [
        $id,
        $array["date_de_naissance_jardinier"] ?? NULL,
        $array["sexe"] ?? NULL,
        $array["diplome"] ?? NULL,
        $array["anciennete"] ?? NULL,
        $array["possibilite_responsable"] ?? NULL
    ]);
}

function get_insert_authentification_query($array, $id) {
    return array("INSERT into authentification (id, login, password, type) values (?,?,sha1(?),?)", [
        $id, $array["login"], $array["password"], $array["type"] 
    ]);
}

function get_modification_individu_query($array, $id) {
    return array("UPDATE Individu set nom_individu = ?, prenom_individu = ?, adresse_individu = ?, telephone_individu = ? where num_individu = ?", [
        $array["nom_individu"] ?? NULL, 
        $array["prenom_individu"] ?? NULL,
        $array["adresse_individu"] ?? NULL,
        $array["telephone_individu"] ?? NULL,
        $id
    ]);
}

function get_modification_jardinier_query($array, $id) {
    return array("UPDATE Jardinier set date_de_naissance_jardinier = ?, sexe = ?, diplome = ?, anciennete = ?, possibilite_responsable = ? where num_individu = ?", [
        $array["date_de_naissance_jardinier"] ?? NULL,
        $array["sexe"] ?? NULL,
        $array["diplome"] ?? NULL,
        $array["anciennete"] ?? NULL,
        $array["possibilite_responsable"] ?? NULL,
        $id
    ]);
}

function get_modification_authentification_query($array, $id) {
    if (isset($array["password"])) {
        return array("UPDATE authentification set login = ?, password = sha1(?), type = ? where id = ?", [
            $array["login"], $array["password"], $array["type"], $id
        ]);
    }
    else {
        return array("UPDATE authentification set login = ?, type = ? where id = ?", [
            $array["login"], $array["type"], $id
        ]);
    }
    
}

?>