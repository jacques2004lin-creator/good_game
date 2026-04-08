# Good Game - Plateforme E-commerce de Jeux Vidéo

**Good Game** est un projet de site web dynamique permettant la consultation, la gestion et l'achat de jeux vidéo en ligne. Ce projet a été réalisé en utilisant PHP, MySQL et Docker.

## Fonctionnalités

### Côté Client :
- **Catalogue complet** : Consultation des jeux par catégories.
- **Recherche intelligente** : Barre de recherche prédictive (Tom Select).
- **Gestion du panier** : Ajout, suppression et calcul du total en temps réel.
- **Liste de souhaits** : Sauvegarde des jeux favoris (avec suppression automatique si le jeu est acheté).
- **Espace Compte** : Modification du prénom, de l'email et du mot de passe.
- **Historique d'achat** : Suivi détaillé de toutes les commandes passées.

### Côté Administrateur :
- **Gestion du catalogue** : Ajouter, modifier ou supprimer des jeux.
- **Gestion des stocks** : Mise à jour des prix et des descriptions techniques.
- **Suivi des ventes** : Vue d'ensemble sur les commandes clients.

## Installation

Le projet est conçu pour être installé très facilement sans passer par phpMyAdmin.

1. **Cloner le repository** :
   ```bash
   git clone https://github.com/jacques2004lin-creator/good_game.git

2. **Lancer l'environnement** :
Docker : Lancez vos containers `docker-compose up -d`.

3. **Initialiser la base de données** :
Ouvrez votre navigateur et accédez à :
`http://localhost:8080/good_game/ini.php`
(Le script créera automatiquement la base, les tables, et insérera les jeux ainsi que le compte administrateur).

## Compte Admin
Pour accéder à l'espace administrateur, utilisez les identifiants suivants :
- **Email** : `admin@test.com`
- **Mot de passe** : `123`

## Technologies utilisées

- **Backend** : PHP 8.1+
- **Base de données** : MySQL
- **Frontend** : HTML5, CSS3 (Flexbox & Grid), JavaScript (ES6)
- **Bibliothèques JavaScript** : 
  - **SwiperJS** : Pour le slider d'images des jeux.
  - **Tom Select** : Pour la barre de recherche prédictive.
- **Icônes** : Font Awesome 6
- **Environnement** : Docker