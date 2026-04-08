document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.support-card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            console.log("L'utilisateur survole une section de support");
        });
    });

    // Exemple : Alerte si on clique sur une section encore vide
    const searchInput = document.querySelector('.search-bar');
    if(searchInput) {
        searchInput.addEventListener('focus', () => {
            searchInput.style.borderColor = '#fffdfd';
        });
    }
});