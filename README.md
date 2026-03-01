# EsyColoc - Plateforme de Colocation

EsyColoc est une application web conçue pour faciliter la gestion de la colocation, permettant aux utilisateurs de gérer leurs dépenses, de suivre la réputation des membres et aux administrateurs de superviser la plateforme.

## Fonctionnalités Principales

### Pour les Utilisateurs
- **Gestion de Colocation** : Création et participation à des groupes de colocation.
- **Dépenses** : Ajout et suivi des dépenses communes.
- **Réputation** : Système de notation des colocataires.
- **Invitations** : Gestion des invitations par email.

### Pour les Administrateurs (Dashboard)
- **Statistiques Globales** : Vue d'ensemble sur le nombre d'utilisateurs, colocations et flux financiers.
- **Gestion des Utilisateurs** : Visualisation, activation/désactivation (Ban/Déban) des comptes utilisateurs.
- **Audit des Dépenses** : Suivi des dernières transactions sur la plateforme.

## Installation et Configuration

### Prérequis
- PHP >= 8.2
- Laravel Framework 12.x 
- Composer 
- Node.js & NPM
- PostgreSQL 
- breeze pour l'authentification
- tailwindcss pour le design
  

### Étapes d'installation

1.  **Cloner le dépôt**
    ```bash
    git clone https://github.com/lakroune/EasyColoc.git
    cd EasyColoc
    ```

2.  **Installer les dépendances PHP**
    ```bash
    composer install
    ```

3.  **Installer les dépendances JS**
    ```bash
    npm install
    npm run build
    ```

4.  **Configurer l'environnement**
    Copiez le fichier `.env.example` en `.env` et configurez vos accès à la base de données :
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Migrer la base de données**
    ```bash
    php artisan migrate --seed
    ```

6.  **Lancer le serveur**
    ```bash
    php artisan serve
    ```

##  Sécurité

L'application utilise un système de **Middleware** pour protéger les routes :
- `auth` : Vérifie si l'utilisateur est connecté.
- `admin` : Vérifie si l'utilisateur connecté est un administrateur.
- `membre` : Vérifie si l'utilisateur n'est pas banni.

##  Interface Utilisateur

L'interface est construite avec **Tailwind CSS**, offrant une expérience moderne et réactive. La page d'erreur personnalisée (404) est intégrée pour une meilleure expérience utilisateur.



## 📝 Licence

Ce projet est la propriété de [lakroune].