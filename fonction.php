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

?>