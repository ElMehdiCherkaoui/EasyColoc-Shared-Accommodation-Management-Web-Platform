# EasyColoc - Shared Accommodation Management Platform

Application web Laravel pour gérer des colocations, les dépenses communes, les remboursements et la réputation des membres.

## Contexte du projet
La version actuelle permet :
- Création de colocations et gestion des membres.
- Invitations via lien/token avec envoi email.
- Ajout des dépenses avec catégories.
- Calcul automatique des soldes et vue simplifiée des remboursements.
- Enregistrement des paiements via action "Marquer payé".
- Système de réputation basé sur le comportement financier.
- Administration globale (statistiques, bannissement/débannissement).
- Filtrage des dépenses par mois dans une colocation.

## Objectifs
### Objectifs fonctionnels
- Gérer des colocations (création, annulation, départ/retrait de membres).
- Suivre les dépenses partagées.
- Calculer automatiquement les soldes individuels.
- Afficher une vue simplifiée "qui doit à qui".

### Objectifs techniques
- Architecture monolithique MVC avec Laravel.
- Base de données via migrations (MySQL/PostgreSQL).
- ORM Eloquent avec relations (`hasMany`, `belongsTo`).
- Authentification Laravel Breeze.
- Gestion des rôles :
- `Global Admin` : statistiques globales + modération utilisateurs.
- `User` : peut créer une colocation (owner) ou rejoindre (member).

## Perimetre realise
### Inclus
- Authentification et profil utilisateur.
- Premier utilisateur promu admin global automatiquement.
- Gestion des colocations (`create`, `show`, `cancel`, `leave`, `remove member`).
- Invitations par token (acceptation/refus).
- Restriction : une seule colocation active par utilisateur.
- Gestion des dépenses (titre, montant, date, catégorie, payeur).
- Gestion des catégories.
- Calcul des balances et vue "qui doit à qui".
- Paiements simples ("Marquer payé").
- Système de réputation.
- Dashboard admin global.
- Filtre des dépenses par mois.

### Hors perimetre (bonus non inclus)
- Paiement Stripe.
- Notifications en temps réel.
- Calendrier.
- Export de données.

## Acteurs et roles
- `Member` : membre d'une colocation.
- `Owner` : administrateur de sa colocation (créateur initial).
- `Global Admin` : administrateur plateforme (statistiques + modération).

## Fonctionnalites cles
### Utilisateurs
- Inscription, connexion, profil.
- Promotion automatique du premier inscrit en admin global.
- Bannissement/débannissement par admin.

### Colocations
- Création d'une colocation avec owner automatique.
- Invitation par email/token.
- Une seule colocation active par utilisateur.
- Départ d'un membre (`left_at`).
- Annulation d'une colocation (`status = cancelled`).

### Depenses et remboursements
- Ajout d'une dépense.
- Historique des dépenses.
- Filtre par mois.
- Calcul des dettes et vue "qui doit à qui".
- Action "Marquer payé".

### Reputation
- Logique de réputation selon les dettes lors des départs/retraits.

## User stories
### Member
- S'inscrire et se connecter.
- Rejoindre une colocation via invitation.
- Voir membres, rôles et réputation.
- Ajouter une dépense.
- Voir la vue "qui doit à qui".
- Marquer un paiement.
- Quitter une colocation (sauf owner).

### Owner
- Créer une colocation.
- Inviter des membres.
- Retirer un membre (sauf owner).
- Gérer les catégories.
- Annuler la colocation.

### Global Admin
- Voir les statistiques globales.
- Bannir/débannir des utilisateurs.

## Scenarios d'implementation
### Scenario 1 - Invitation
- Owner envoie une invitation (token unique + email).
- Utilisateur invité accepte ou refuse.
- Vérification de l'email et des règles d'accès.
- Blocage si utilisateur déjà en colocation active.

### Scenario 2 - Depense commune
- Ajout d'une dépense (payeur, montant, date, catégorie).
- Recalcul des soldes des membres actifs.
- Mise à jour de la vue de remboursements.

### Scenario 3 - Depart/retrait avec dette
- Départ membre avec dette : pénalité de réputation + redistribution.
- Retrait membre par owner avec dette : dette imputée à l'owner.

### Scenario 4 - Blocage multi-colocation active
- Création ou acceptation invitation bloquée si membership actif existant.

## Stack technique
- PHP 8.2
- Laravel 12
- Blade + Tailwind CSS
- Eloquent ORM
- MySQL / PostgreSQL (selon configuration `.env`)
