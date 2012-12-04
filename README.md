Travaux dirigés sur les tests unitaires
=======================================

Le but est de calculer le score d'un match de tennis

Installer
---------

Dans une console entrez

    $ ./bin/bootstrap.sh

et tout est prêt

User stories
------------

### Vie d'un jeu

Dans un nouveau jeu, le score est 0-0.

Dans un nouveau jeu, quand un joueur marque quatre fois de suite, ce joueur gagne le jeu.

Dans un jeu avec un joueur à 0, quand ce joueur marque, ce joueur a un score de 15.

Dans un jeu avec un joueur à 15, quand ce joueur marque, ce joueur a un score de 30.

Dans un jeu avec un joueur à 30, quand ce joueur marque, ce joueur a un score de 40.

Dans un jeu avec un joueur ayant l'avantage, quand l'autre joueur marque, il y a egalité.

Dans un jeu avec un joueur ayant l'avantage, quand ce joueur marque, ce joueur gagne le jeu.

Dans un jeu avec deux joueur à égalité, quandun joueur marque, ce joueur a l'avantage.

### Vie d'un set

Dans un nouveau set, le score est 0 jeu à 0 et un nouveau jeu commence.

Dans un nouveau set, quand un joueur gagne 7 jeux de suite, ce joueur gagne le set.

Dans un set dont aucun joueur n'est en position de gagner, quand un joueur gagne un jeu,
le score de ce joueur augmente de 1 et un nouveau jeu commence.

Dans un set avec deux joueurs ayant 6 jeux, quand un joueur gagne le jeu,
le score de ce joueur augmente de 1 et un nouveau jeu commence.

Dans un set avec le premier joueurs ayant 6 jeux et le second joueur ayant 7 jeux,
quand le second joueur gagne le jeu, le second joueur gagne le set.


### Vie d'un match

A vous !
