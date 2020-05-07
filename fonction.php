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
    
}

?>