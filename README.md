# Parcour-Symfo-Kain
Parcours de la spé symfony, by Kain  => https://github.com/O-clock-Sirius/symfo-faq-oclock-kainmeeri


## Jour 1

Création d'un Trello pour "essayer" de m'organiser => https://trello.com/b/YJD6zNnP

Création d'un mocodo dispo dans 'doc'

Création d'un wireframe page d'accueil dans 'doc' ou => https://urlz.fr/alV0 + https://urlz.fr/alVX

Création de ma bdd + mes entity's via make:entity

**Note perso** : Pour le moment ça va ! préparation du trello, mcd, wireframe, bdd, entity, controlleur et préparation à l'intégration + favicon, en espérent que mon mcd sois bon.


## Jour 2

Update du Trello + Wireframes

Création de mes relations

Création de mes fixtures

Affichage de mes questions + user lié à la question sur ma page d'accueil

Commencer l'intégration histoire d'y voir plus clair

**Note perso** : Beaucoup d'appréhension au niveau des relations mais je m'en suis pas si mal sortie, pas mal avancer mais peu mieux faire (beaucoup de fatigue..)


## Jour 3

Update du Trello 

Update d'intégration

Menue déroulant contenant mes tags, rendu ça dynamique si je clique sur le tag "PHP" ça me renvoie sur /question/tag/id avec toute les questions concerner.

Création request Custom pour afficher mes questions dans le bonne ordre.

Ajout d'un formulaire qui add une question

**Note perso** : Grosse journée avec pas mal de bug, mais grace au docs (et aussi quelque camarades) j'ai pu m'en sortir ! (encore plus fatiguer qu'hier..)


## Jour 4

Gros update d'intégration (qui prend du temps)

Reglage de quelque bug concernant l'affichage de mes tags dans certaine pages

Ajout d'un système de login (fonctionnel)

**Note perso** : Gros bug avec ma bdd, mais merci Claire, sinon ça avance doucement, à prévoir pour demain un fomulaire d'inscription fonctionnel  + fioriture.




### Problème à regler

Dans la liste des question d'un tag (question/tag/id) trié par ordre DESC

Pour afficher mon menue déroulant des tags qui ce situe sur ma navbar (header) j'ai du copier ce code =>  **$tagsNav = $repository->findAll()**,
sur tout mes controller et leurs méthodes





