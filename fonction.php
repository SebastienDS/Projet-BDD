<?php


function get_infos() {
    return [
        "Administrateur" => [
            "onglets" => ["Gérer les comptes utilisateurs", "Gérer les résidences"],
            "links" => ["gestion_des_comptes.php", "gerer_les_residences.php"]
        ],
        "Jardinier" => [
            "onglets" => ["Mes résidences", "Mon salaire", "Mon syndic"],
            "links" => ["mes_residences.php", "mon_salaire.php", "mon_syndic.php"]
        ],
        "Chef Jardinier" => [
            "onglets" => ["Mes résidences", "Mon salaire", "Mon syndic"],
            "links" => ["mes_residences.php", "mon_salaire.php", "mon_syndic.php"]
        ],
        "Syndic" => [
            "onglets" => ["Mes résidences", "Mes Outils", "Mes contacts"],
            "links" => ["mes_residences.php", "mes_outils.php", "mes_contacts.php"]
        ]
    ];
}

function get_onglets($role) {
    return get_infos()[$role]["onglets"];
}

function get_links($role) {
    return get_infos()[$role]["links"];
}

function get_recherche_query($array) {
    $recherche = [];
    $var = [];
    foreach ($array as $key => $value) {
        $recherche[] = "$key = ?";
        $var[] = $value;
    }
    $query = "SELECT num_individu as 'Numéro', nom_individu as 'Nom', prenom_individu as 'Prénom', 
        adresse_individu as 'Adresse', telephone_individu as 'Numéro de téléphone', 
        date_de_naissance_jardinier as 'Date de naissance', sexe as 'Sexe', diplome as 'Diplome', 
        anciennete as 'Ancienneté', possibilite_responsable as 'Possibilite responsable', 
        num_individu_membre as 'Numéro du chef' from Individu natural join Jardinier ";
    if ($var) {
        $query.= "where ". implode(" and ", $recherche) . " order by num_individu";
    }
    return array($query, $var);
}

function get_insert_individu_query($array) {
    return array("INSERT into Individu (num_individu, nom_individu, prenom_individu, adresse_individu, 
        telephone_individu) values (?,?,?,?,?)", [
        $array["num_individu"] ?? NULL,
        $array["nom_individu"] ?? NULL, 
        $array["prenom_individu"] ?? NULL,
        $array["adresse_individu"] ?? NULL,
        $array["telephone_individu"] ?? NULL
    ]);
}

function get_insert_jardinier_query($array, $id) {
    return array("INSERT into Jardinier (num_individu, date_de_naissance_jardinier, sexe, diplome, 
        anciennete, possibilite_responsable) values (?,?,?,?,?,?)", [
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

function get_insert_residence_query($array) {
    return array("INSERT into Residence (num_residence, nom_residence, num_syndic, num_individu) values (?,?,?,?)", [
        $array['num_residence'] ?? NULL, 
        $array['nom_residence'] ?? NULL, 
        $array['num_syndic'] ?? NULL, 
        $array['num_individu'] ?? NULL 
    ]);
}

function get_insert_descriptif_query($array, $id) {
    return array("INSERT into Descriptif (num_residence, surface_de_pelouse, surface_de_baie, surface_espace_vert) values (?,?,?,?)", [
        $id, 
        $array['surface_de_pelouse'] ?? NULL, 
        $array['surface_de_baie'] ?? NULL, 
        $array['surface_espace_vert'] ?? NULL 
    ]);
}

function get_modification_individu_query($array, $id) {
    return array("UPDATE Individu set nom_individu = ?, prenom_individu = ?, adresse_individu = ?, 
        telephone_individu = ? where num_individu = ?", [
        $array["nom_individu"] ?? NULL, 
        $array["prenom_individu"] ?? NULL,
        $array["adresse_individu"] ?? NULL,
        $array["telephone_individu"] ?? NULL,
        $id
    ]);
}

function get_modification_jardinier_query($array, $id) {
    return array("UPDATE Jardinier set date_de_naissance_jardinier = ?, sexe = ?, diplome = ?, 
        anciennete = ?, possibilite_responsable = ? where num_individu = ?", [
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

function get_modification_residence_query($array, $id) {
    return array("UPDATE Residence set nom_residence = ?, num_syndic = ?, num_individu = ? where num_residence = ?", [
        $array['nom_residence'] ?? NULL, 
        $array['num_syndic'] ?? NULL, 
        $array['num_individu'] ?? NULL,
        $id
    ]);
}

function get_modification_descriptif_query($array, $id) {
    return array("UPDATE Descriptif set surface_de_pelouse = ?, surface_de_baie = ?, surface_espace_vert = ? where num_residence = ?", [ 
        $array['surface_de_pelouse'] ?? NULL, 
        $array['surface_de_baie'] ?? NULL, 
        $array['surface_espace_vert'] ?? NULL,
        $id
    ]);
}

function get_profil_query($type, $id) {
    switch ($type) {
        case "Administrateur":
            return array("SELECT * from Individu where num_individu = ?", [
                $id
            ]);
        case "Jardinier":
        case "Chef Jardinier":
            return array("SELECT * from Individu natural join Jardinier where num_individu = ?", [
                $id
            ]);
        case "Syndic": 
            return array("SELECT * from Syndic where num_syndic = ?", [
                $id
            ]);
    }   
}

?>