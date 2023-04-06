function formatDate(date) {
    const options = {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        hour: '2-digit',
        minute: '2-digit'
    };
    return date.toLocaleString('fr-FR', options);
}

function afficherDateHeure() {
    const dateHeureElement = document.getElementById('dateHeure');
    const date = new Date();
    dateHeureElement.textContent = formatDate(date);
}

// Mettre à jour la date et l'heure toutes les minutes
setInterval(afficherDateHeure, 60000);
afficherDateHeure();