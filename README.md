# Guess-the-people

Installation du projet:

prérequis : Avoir installé php 8.3, MySQL et phpmyadmin
            Avoir installé Node versione 20.12.0, npm 10.8.1
            Avoir installé composer v2.7.2, SymfonyCLI 5.9.1

- Cloner le projet

## Pour le backoffice

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
- Lancer le serveur

```sh
symfony console tailwind:build
```

Le serveur devrait se lancer sur le localhost port 8000

## Pour le front office :

- Dans le dossier front lancer : 

```sh
npm install
```

- Lancer le serveur :

```sh
npm run dev
```

Le serveur devrait se lancer sur le serveur localhost port 5173.
