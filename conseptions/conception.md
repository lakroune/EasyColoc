#  Conception de l'Application EsyColoc

Ce document décrit l'architecture technique, la modélisation des données et la logique métier de l'application **EsyColoc**.

## 1.  Architecture Générale

EsyColoc est une application web développée avec le framework **Laravel (PHP)**. Elle suit l'architecture **MVC (Modèle-Vue-Contrôleur)** pour séparer la logique métier, la présentation et la gestion des données.



### Composants principaux :
- **Models** : Représentent les tables de la base de données (User, Colocation, Depense, etc.).
- **Controllers** : Gèrent la logique métier (DashboardController, ColocationController).
- **Views** : Interfaces utilisateur construites avec **Blade** et stylisées avec **Tailwind CSS**.
- **Middleware** : Assurent la sécurité et la gestion des accès (Admin, Membre).

## 2. 📊 Modélisation de la Base de Données (ERD)

La base de données relationnelle (MySQL) est structurée comme suit :



### Entités principales :
- **Users** : Stocke les informations des utilisateurs (nom, email, solde, réputation, statut banni).
- **Colocations** : Stocke les détails du logement partagé.
- **ColocationUser** : Table pivot gérant la relation (Many-to-Many) entre utilisateurs et colocations (propriétaire, membre actif, ayant quitté).
- **Depenses** : Enregistre les dépenses communes de la colocation.
- **Categories** : Catégories de dépenses (loyer, électricité, internet, etc.).
- **Dettes** : Gère la répartition des dettes entre les membres d'une dépense.

 
 