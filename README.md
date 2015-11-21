# Présentation

Ceci est un projet exemple utilisant Symfony 2.7 full-stack edition pensé pour servir de support au cours de Supinfo 2WEB promotion 2014/2015.

![Page d'accueil](http://git.aubm.net/cours-supinfo-2web/suplink/raw/master/doc/home.png)

# Installation et démarrage

L'outil composer doit être installé : https://getcomposer.org

1. Télécharger les fichiers de ce repo (avec git `git clone http://git.aubm.net/cours-supinfo-2web/suplink.git`).
2. Installer les dépendances avec composer : `composer install`.
3. Créer la base de données : `php app/console doctrine:database:create`.
4. Créer le schéma : `php app/console doctrine:schema:create`.
5. Lancer le serveur : `php app/console server:run`.

# Utilisation

- Naviguer sur `localhost:8000`.

# Ressources

- https://symfony.com/doc/current/index.html
- http://doctrine-orm.readthedocs.org/en/latest/
- https://github.com/FriendsOfSymfony/FOSUserBundle

# License

http://www.apache.org/licenses/LICENSE-2.0
