# kMCLauncher-Server

Ce serveur web vous permet de faire le liens avec la librairie kMCLauncher.

## Prérequis
* PHP(>5.0)
* Serveur Web (Apache / Nginx)

## Installation

Pour installer ce serveur sur votre site web deux solutions

### Via git (Conseillé pour plus de facilité de mise à jour)
Rendez vous à l'emplacement d'accès et faite la commande :
``git clone https://github.com/K0bus/kMCLauncher.git nomdudossier``

### Via FTP
Téléchargez le fichier ZIP de ce repo et uploadez son contenus sur votre serveur web.

## Configuration
Une fois les fichiers mis en place sur votre machine faites attention à ce que le serveur web ai bien les droits d'écriture sur ce dossier.
Ensuite accédez à votre interface d'admin via votre URL

Il vous faudra ensuite créé votre compte sur le panel, votre mot de passe seras crypter et ne seras plus accessible par la suite.

## Gestion des fichiers
Vous trouverez dans les dossiers du serveur le dossier suivant : 
``/data/files``
Il vous faudra ensuite y placer les dossiers suivants : 
* config
* libs
* mods
* natives
* resources
* script

> Tous ces fichiers ne serons pas forcément obligatoire, cela dépendras de ce que vous souhaitez transmettre à vos joueurs. Seul les dossiers suivants sont obligatoire :
> * libs
> * natives

Si votre pack utilise forge vous devrez mettre le jar de forge dans le dossier ``libs``

## Rendre disponible votre update
Quand tous vos fichiers serons disponible sur le panel, vous pourrez dès à présent retourner sur votre panel sur la page "Mise à jour".
Vous y verrez affiché le détails des modifications ainsi que les informations à remplir concernant votre update. (Ces informations pourrons être récupéré sur votre Launcher si vous souhaitez afficher les Changelogs).
Ensuite vous pouvez envoyer votre update, le serveur s'occuperas de lire et traité les modifications les rendants donc accessible à vos joueurs sur votre Launcher.