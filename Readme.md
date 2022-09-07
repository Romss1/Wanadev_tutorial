# Projet - Backoffice VueJS / API Symfony 5
## Contexte
Notre client fictif étant un très grand amateur de jeux-vidéos, il en dispose un grand nombre sur différentes plateformes et supports.
Il a donc du mal à suivre ceux qu' il possède, ceux qu’il a terminés et ceux qu’il attend.

Il aimerait donc pouvoir avoir un outil simple pour administrer sa bibliothèque de jeux au même endroit. Il fait appel à nos services !

## Besoins
Voici la liste des use cases qui sont attendus par son application.
Notre client étant flexible et nous faisant confiance, nous avons libre choix du design, de la disposition des formulaires et de la présentation des éléments. Son seul mot d’ordre : rester simple et ne pas réinventer la roue.
Bibliothèque de jeux - Administration
Pouvoir ajouter/éditer/supprimer un jeu avec ces informations :
- Titre
- Plateforme (PC/PS5/ect…)
- Support (Physique/Steam/PS Store/ect…)
- Genre (Action/Sport/RPG/etc…)
- Date de sortie
- Site internet officiel
- Note personnelle (sur 10)
- Terminé ?

Petite subtilité ici, notre client étant un peu feignant, il aimerait que si la date de sortie du jeu est dans le futur, il soit considéré comme un jeu qu’il attend.

De plus, il nous laisse libre carte blanche pour le formulaire, à nous de voir quel est le plus simple pour lui en termes de contribution et pour nous d’un point de vue cohérence des données.

Enfin, il aimerait beaucoup que chaque fois que l’on ajoute un jeu dans la bibliothèque, notre système récupère automatiquement la jaquette du jeu ainsi que les notes Metascore. Si les informations ne sont pas trouvées, il faudrait avoir une petite alerte lui signifiant que le jeu qu’il a renseigné n’est pas valide. Heureusement pour nous, https://api.rawg.io existe et c’est gratuit !
Bibliothèque de jeux - Vues
Avoir une page permettant de lister tous les jeux de la bibliothèque montrant la jaquette du jeu et avoir des filtres sur Plateforme/Support/Terminé/Attendu (AND) et de pouvoir ordonner les éléments par A-Z,

Un gros plus (bonus), mais non obligatoire serait de pouvoir rechercher en full texte par titre ! A voir en fonction du temps restant après avoir développé tout le reste.

## Gestion des droits
Notre client étant un gamer sociable, il aimerait que ces données soient complètement accessibles niveau lecture mais protégé à l’écriture par un compte d’administration dont seuls nous et lui auront accès.

## Technique
Voici ce qui est attendu dans le développement de ce projet.
Backoffice Backend - stack
Symfony 5 / PHP 7.4 : API REST avec gestion des droits (Symfony Guard / Voters / Serializer component)
DBAL : Doctrine ORM + Migrations
DB : Postgresql
Quality : PHPStan level max, php-cs-fixer
Tests : Tests unitaires et fonctionnels avec PHPUnit + Bridge symfony pour chargement des fixtures + pouvoir sortir le coverage.
Fixtures : Foundry avec Faker
Environnement de développement : Docker fonctionnel avec Makefile pour faciliter l’installation.
Backoffice Frontend - stack
VueJS / Typescript
Store : Vuex - Utiliser le plus possible les annotations (ex: props, commits, etc...)
Quality : Je ne connais pas assez l’env JS mais je suis sur que des linters de qualité typescript existent, rapproche toi de Damien pour ça.
Tests : Jest
## Principes de développement
Respecter le plus possible les principes de clean-code / architecture (SOLID, KISS, Adapter patterns).
Le code doit être testé un maximum, en TDD si tu te sens chaud ;D
La quality et les tests doivent être au vert sur le repo
Typage strict, en entrée et en sortie. Pas de mixed/any.
## Organisation du répo
Tu peux avoir les deux projets dans le même repository, ça sera plus simple pour la relecture et le lancement du projet avec Docker. Attention néanmoins à ne pas faire src1, src2 :D Choisi quelque chose de cohérent pour l’organisation du projet.
Features par branche et par PR sur master. Tu es libre sur le merge de tes PR, cela permettra au lecteur de les commenter même si elles sont fermées.
Dès qu’une PR est ouverte à la relecture, envoie la dans le slack et on ira la relire ASAP :D.
Github ou Gitlab as you wish.
