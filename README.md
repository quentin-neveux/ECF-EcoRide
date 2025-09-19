# EcoRide # par Quentin Neveux, STUDI, session examen JAN/FEV 2026.

### CONTEXTE
Ce repository n'est pas final. Il représente une étape dans la continuité de mon apprentissage.  
Les prochaines étapes prévues sont :  
- Intégrer le PHP côté serveur  
- Fournir une base de données fiable  
- Sécuriser l’ensemble de l’application  

Merci d’en prendre compte lors de l’évaluation. 
---

**EcoRide** est une application web de covoiturage écologique développée dans le cadre de l' **Évaluation en Cours de Formation (ECF)** pour le titre professionnel *Développeur Web & Web Mobile*.

## Fonctionnalités
- Inscription et connexion des utilisateurs (en cours de développement).
- Recherche de trajets disponibles (en cours de développement).
- Publication de trajets par les conducteurs (en cours de développement).
- Routing SPA (Single Page Application) en JavaScript.
- Charte graphique personnalisée et maquettes responsive.

## Technologies utilisées
- **HTML5 / CSS3** (avec [Bootstrap](https://getbootstrap.com/))
- **JavaScript** (routing SPA, injection dynamique)
- **PHP / PDO** (prévu pour la gestion des données)
- **MySQL** (base de données relationnelle)
- **Git / GitHub** (versionnement et partage du code)
- **Figma** (maquettes) & **Mermaid** (diagrammes UML)

## Structure du projet
ecf-ecoride/
│── index.html
│── css/
│── js/
│── Router/
│── pages/
│── images/

## Installation et utilisation locale

### Prérequis
- [XAMPP](https://www.apachefriends.org/download.html) (Apache + MySQL)
- [Git](https://git-scm.com/) (optionnel, pour cloner directement le repo)
- Un navigateur web moderne (Chrome, Firefox, Opera…)

### Étapes d’installation
1. **Cloner le projet** ou le télécharger en `.zip` :
      ```bash
      git clone https://github.com/quentin-neveux/ecf-ecoride.git

2. **Placer le projet dans le dossier htdocs de XAMPP :**
      C:\xampp\htdocs\ecf-ecoride

3. **Démarrer Apache et MySQL via le panneau de contrôle XAMPP.**

4. **Accéder au site depuis un navigateur :**
      http://localhost/ecf-ecoride

<!-- ## Base de données (à activer quand disponible) ### Étapes supplémentaires 
1. **Démarrer MySQL** via le panneau de contrôle XAMPP. 
2. **Créer une base de données** : 
- Aller sur [http://localhost/phpmyadmin](http://localhost/phpmyadmin) 
- Créer une base `ecoride` 
- Importer le fichier SQL fourni dans le dossier `/sql`. -->
