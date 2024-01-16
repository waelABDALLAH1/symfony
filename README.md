# Blog Symfony Project

Bienvenue dans le projet Symfony de création d'un blog. Ce projet utilise le framework Symfony pour développer un blog interactif avec des fonctionnalités telles que la gestion d'articles, l'authentification des utilisateurs, un formulaire de contact, et bien plus encore.

## Installation

Assurez-vous d'avoir PHP, Composer et Symfony CLI installés sur votre machine.

1. Clonez le projet :

    ```bash
    git clone https://github.com/votre-utilisateur/blog-symfony.git
    ```

2. Installez les dépendances :

    ```bash
    cd blog-symfony
    composer install
    ```

3. Configurez votre base de données en éditant le fichier `.env` :

    ```env
    # .env

    DATABASE_URL=mysql://user:password@127.0.0.1:3306/blog_symfony
    ```

4. Créez la base de données et exécutez les migrations :

    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

5. Lancez le serveur de développement :

    ```bash
    symfony server:start
    ```

Le projet sera accessible à l'adresse http://localhost:8000.

## Fonctionnalités Principales

1. **Gestion des Articles :** Ajoutez, éditez, supprimez et affichez des articles.
2. **Authentification des Utilisateurs :** Système d'authentification avec différents rôles (administrateur, éditeur, utilisateur).
3. **Formulaire de Contact :** Les visiteurs peuvent soumettre des formulaires de contact.
4. **Gestion des Messages :** Les administrateurs peuvent lire et gérer les messages soumis par les visiteurs.

