<?php
function formater_date($date) {
    $maintenant = new DateTime();
    $dateObj = new DateTime($date);
    $difference = $maintenant->diff($dateObj);

    $jours = $difference->days;
    $heures = $difference->h;
    $minutes = $difference->i;
    $secondes = $difference->s;
    $annees = $difference->y;

    if ($annees >= 1) {
        $prefixe = "Il y a " . $annees . "a";
    } elseif ($jours > 1) {
        $prefixe = "Il y a " . $jours . "j";
    } elseif ($jours == 1) {
        $prefixe = "Hier";
    } elseif ($heures >= 1 || $minutes >= 1) {
        $prefixe = "Aujourd'hui";
    } else {
        $prefixe = "Il y a " . $secondes . "s";
    }

    $heureFormat = $dateObj->format('H:i');

    return $prefixe . " · " . $heureFormat;
}