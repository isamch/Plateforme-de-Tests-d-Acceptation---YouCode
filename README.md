**Projet de Gestion des Candidatures**

## Contexte du Projet
Dans le cadre de l'optimisation du processus de recrutement et d'évaluation des candidats, ce projet vise à digitaliser et automatiser plusieurs étapes clés, depuis l'inscription jusqu'à l'organisation des tests présentiels.

## Objectifs du Projet
- Offrir aux candidats une plateforme intuitive pour créer un compte et soumettre leurs informations.
- Automatiser l'évaluation initiale via un quiz interactif.
- Planifier efficacement un test présentiel en fonction des disponibilités du staff.

## Fonctionnalités
### 1. Inscription et Connexion
- Création de compte avec email et mot de passe.
- Vérification de l'email pour activer le compte.
- Connexion sécurisée avec gestion de sessions.

### 2. Soumission des Documents
- Upload de la carte d'identité (formats acceptés : JPEG, PNG, PDF).
- Saisie des informations personnelles : nom, prénom, date de naissance, téléphone, adresse.

### 3. Passage du Quiz
- Accès au quiz une fois les documents validés.
- Minuteur intégré pour la réalisation du quiz.
- Calcul automatique du score.
- Validation pour l'étape du test présentiel si le score requis est atteint.

### 4. Planification du Test Présentiel (Technique + Administratif + CME)
- Attribution automatique d'une date et d'un examinateur en fonction des disponibilités.
- Envoi d'une convocation par email avec date et lieu.

## Contraintes Techniques
### **Technologie Backend**
- **Framework** : Laravel 7/8/9 en mode monolithique avec Blade pour l'interface utilisateur.
- **Gestion des Accès** : Système de rôles et permissions avec Auth Gates et Middlewares.
- **Validation des Entrées** : Utilisation de Custom Requests pour la validation.
- **Base de Données** : MySQL ou PostgreSQL.

### **Authentification et Stockage**
- **Authentification** : Laravel Auth avec gestion des sessions.
- **Stockage des fichiers** : Système de fichiers sécurisé (stockage local ou cloud).

### **Déploiement**
- Hébergement sur un serveur cloud (ex: DigitalOcean, AWS, Heroku).

