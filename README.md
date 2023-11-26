# LSDB (Le Site de Boule) - Readme

## Procédure d'Installation

1. Copier coller le fichier `.env.example` et le renommer en `.env`.

2. Installer les dépendances PHP avec Composer:
    ```bash
    composer install
    ```

3. Installer les dépendances JavaScript avec npm:
    ```bash
    npm install
    ```

4. Lancer Docker (Desktop).

5. Démarrer l'environnement Sail:
    ```bash
    sail up
    ```
   ou, si vous avez défini un alias :
    ```bash
    ./vendor/bin/sail up
    ```

6. Vérifier que la connexion à la base de données fonctionne :
    - Type de connexion : mysql
    - Host : localhost
    - Port : 3306
    - Utilisateur : sail
    - Mot de passe : password
    - Base de données : laravel

   En cas de problème de connexion :
    ```bash
    sail down --rmi all -v
    ```

7. Dans un autre terminal, effectuer les migrations et le seeding de la base de données :
    ```bash
    sail artisan migrate:fresh --seed
    ```
   
8. Dans un autre terminal, exécuter la compilation des assets avec npm :
    ```bash
    npm run dev
    ```


## Liens Utiles

- Documentation de l'API: [http://localhost/docs/api#/](http://localhost/docs/api#/)

- Back Office: [http://localhost/login](http://localhost/login)

- Pour les requêtes nécessitant l'upload d'image, le fichier Postman JSON est disponible à la racine du projet sous le nom de `LSDB.postman_collection.json`.

## Comptes de Connexion

Lors du seeding, les comptes suivants ont été créés :

- Administrateur:
    - Email: admin@admin
    - Mot de passe: password

- Utilisateur:
    - Email: user@user
    - Mot de passe: password

Vous pouvez également vous connecter avec n'importe quel autre compte, le mot de passe pour tous les comptes est `password`.
 
