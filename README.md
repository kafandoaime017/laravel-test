# 🏡 Projet Laravel - Gestion des Réservations Immobilières  

## 📌 Introduction  

Ce projet a été développé dans le cadre de l'évaluation de mes compétences avec **Laravel**, **Livewire**, **Filament** et **TailwindCSS**.  
L'objectif est de créer une application de gestion des réservations immobilières permettant aux utilisateurs de :  
✔️ Consulter les propriétés disponibles  
✔️ Effectuer des réservations  
✔️ Gérer leur profil et leurs réservations  
✔️ Les administrateurs ont un accès complet pour gérer les utilisateurs, les réservations et les propriétés.  

---

## 🛠 Technologies utilisées  

- **Laravel** : Framework PHP pour le backend  
- **Livewire** : Pour des interactions dynamiques sans rechargement de page  
- **Filament** : Interface d’administration moderne et performante  
- **TailwindCSS** : Framework CSS pour un design responsive et personnalisé  
- **Laravel Breeze** : Système d'authentification simple et efficace  

---

## 🎯 Fonctionnalités du Système  

### 1️⃣ Gestion des Propriétés 🏠  

Les utilisateurs peuvent consulter les propriétés sous forme de cartes, contenant les informations principales :  
✔️ Nom  
✔️ Description  
✔️ Prix par nuit  
✔️ Bouton "Voir plus" pour afficher plus de détails  

📸 *Aperçu de la liste des propriétés :*  
![Carte Propriété](public/images/Acceuil.jpeg)  

---

### 2️⃣ Réservation des Propriétés 📅  

Un formulaire de réservation permet à l'utilisateur de sélectionner une période de séjour :  
✔️ Sélection des dates de début et de fin  
✔️ Vérification de la disponibilité  
✔️ Messages d'erreur en cas d'invalidité  

🛑 **Cas d'erreur :**  
- **Utilisateur non connecté** → Alerte lui demandant de se connecter  
- **Dates déjà réservées** → Message d'avertissement  

📸 *Exemple de message lorsque l'utilisateur doit se connecter :*  
![Formulaire de réservation](public/images/must_login.jpeg)  

---

### 3️⃣ Gestion des Profils Utilisateurs 👤  

Les utilisateurs ont accès à un espace personnel où ils peuvent :  
✔️ Consulter leurs informations personnelles  
✔️ Mettre à jour leurs données  
✔️ Modifier leur mot de passe  

📸 *Exemple d'affichage du profil utilisateur :*  
![Profil Utilisateur](public/images/MyProfile.jpeg)  

---

### 4️⃣ Interface d’Administration avec Filament 🛠  

Les administrateurs bénéficient d'un tableau de bord avec plusieurs options :  
✔️ **Gestion des utilisateurs** → Création, modification, suppression  
✔️ **Gestion des réservations** → Consultation, validation, annulation  
✔️ **Gestion des propriétés** → Ajout, modification, suppression  

📸 *Exemple de gestion des réservations dans l'interface administrateur :*  
![Tableau de bord Administrateur](public/images/bookings.jpeg)  

---

### 5️⃣ Authentification et Sécurité 🔒  

L'application implémente **Laravel Breeze** pour gérer l'authentification.  
Fonctionnalités incluses :  
✔️ Inscription / Connexion  
✔️ Réinitialisation du mot de passe  
✔️ Gestion des rôles (utilisateur & administrateur)  

---

## 🗄️ Structure du Projet  

### 🏗 1. Base de Données  

L'application repose sur deux tables principales :  

- **Propriétés** (`properties`) → Contient les informations sur les biens immobiliers.  
- **Réservations** (`bookings`) → Contient les détails des réservations effectuées.  

---

### 🔗 2. Routes Principales  

| URL                     | Description |
|-------------------------|------------|
| `/`                     | Page d'accueil affichant les propriétés |
| `/profile`              | Page de gestion du profil utilisateur |
| `/mes-reservations`     | Historique des réservations |
| `/admin`                | Panneau d’administration (accessible uniquement aux administrateurs) |

---

## 🚀 Instructions pour Exécuter le Projet Localement  

### 📂 Cas 1 : Utilisation d'un Fichier ZIP  

1️⃣ **Télécharger et Extraire le Fichier ZIP**  
   - Décompressez l'archive et ouvrez le dossier du projet.  

2️⃣ **Configurer l'Environnement Local**  
   - Ouvrez un terminal et naviguez dans le dossier du projet :  
     ```bash
     cd mon-projet-laravel
     ```
   - Copier le fichier `.env.example` et le renommer en `.env` :  
     ```bash
     cp .env.example .env
     ```

3️⃣ **Installer les Dépendances**  
   ```bash
   composer install
   npm install && npm run build
