## Projet F1
-----------
- Récuperer le lien Git.
- Télécharger le lien et installer dans le dossier desiré.
- Créer un fichier database/data/database.sqlite
- Coller votre fichier .env et placer dans 
DB_DATABASE=
le lien absolu du fichier 
database.sqlite
- Dans le terminal à l'emplacement du dossier faire un 
composer install
 puis un 
php artisan migrate:fresh --seed
- Terminer par un 
php artisan serve
`
### Postman
------------

Dans le postman il y a la documentation de l'API, pour y accéder : cliquer sur les °°° à droite de F1 (au niveau de l'arborescence) puis sélectionner "View documentation".

La création, supression ou mise à jour de ressources n'est accessible qu'aux utilisateurs connectés à l'aide d'un Token d'authentification (ainsi que l'accè!s à la liste d'utilisateurs).

Pour créer un nouvel utilisateur : Aller dans le dossier Users de Postman, Create User puis remplir les champs. Une fois créé, un token sera fourni. Copiez ce token (les caractères après le nombre et le |) et collez-le dans le champ Token, dans l'onglet F1. Si besoin, sélectionnez le type "Bearer Token".

En cas de déconnexion : Conectez vous dans le dossier Users, Connexion et en renseignant l'email et password précedemment créés.

### CRUD
---------

Les ressources son : Les drivers, circuits, constructors, races et results

Il est possible de :
- Créer une ressource
    ex: http://127.0.0.1:8000/api/drivers/1 en méthode POST

- Supprimer une ressource (avec l'id)
    ex: http://127.0.0.1:8000/api/drivers/1 en méthode DELETE

- Mettre à jour une ressource (avec l'id)
    ex: http://127.0.0.1:8000/api/drivers/1 en méthode PATCH

- Afficher toutes les ressources
    ex: http://127.0.0.1:8000/api/drivers en méthode GET

- Afficher une ressource particulière (avec l'id)
    ex: http://127.0.0.1:8000/api/drivers/1 en méthode GET

En plus de cela, il est possible de faire une recherche par surname pour les drivers :
```
    ex: http://127.0.0.1:8000/api/drivers/search/hamilton
```
Ce qui renverra tous les drivers avec "hamilton" dans le champs surname.

De la même manière, il est est possible de faire une recherche par country pour les circuits :
```
    ex: http://127.0.0.1:8000/api/circuits/search/Argentina
```
Ce qui renverra tous les circuits avec "Argentina" dans le champs country.

Lorsqu'on retourne toutes les ressources, on peut filtrer les résultats avec différents filtres, après le signe "?" :
- {colonne}={valeur} : Retourne toutes les ressources ayant "valeur" dans la colonne "colonne"
    ex: http://127.0.0.1:8000/api/drivers?forename=pedro

- sort={colonne} : Trie toutes les ressources par rapport à la valeur de la colonne "colonne", dans l'ordre ascendant
    ex: http://127.0.0.1:8000/api/drivers?sort=driverId

- desc={colonne} : Trie toutes les ressources par rapport à la valeur de la colonne "colonne", dans l'ordre descendant
    ex: http://127.0.0.1:8000/api/drivers?desc=number

- paginate={nombre} : Renvoie "nombre" ressources, à coupler avec page={num} pour voir les ressources suivantes
    ex: http://127.0.0.1:8000/api/drivers?paginate=50&page=2

Pour combiner plusoieurs filtres à la fois il suffit de les séparer par le signe &
```
    ex: http://127.0.0.1:8000/api/drivers?nationality=German&sort=number&paginate=10&page=2
```
