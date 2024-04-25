# Guess-the-people

Installation du projet:

- Cloner le projet
- Dans le dossier back lancer : composer install
- Lancer la commande suivante pour mettre en place la base de données (Il faut bien avoir créer la base guess-the-people avant)

```sh
symfony console doctrine:migration:migrate 
```

- Mettre en place un jeu de données:

```sh
symfony console doctrine:fixtures:load
```
- Mettre en place le tailwind pour le projet

```sh
symfony console tailwind:build
```
