php 
## Projet F1
-----------
- Récuperer le lien Git.
- Telecharger  le lien et installer dans le dossier desiré.
- Créer un fichier 
database.sqlite
dans le dossier data
- Coller votre fichier .env et placer dans 
DB_DATABASE=
 le lien absolu du fichier 
database.sqlite
- Dans le terminale à l'emplacement du dossier faire un 
composer install
 puis un 
php artisan migrate:refresh --seed
- terminer part un 
php artisan serve
`
------------
### Ouvrir Postman

- Ouvrir le lien  
[Postman](https://app.getpostman.com/join-team?invite_code=afcdf6d1522ea332f4b419ca22d4d1d2&ws=94f84c13-36da-4e3f-8447-0b93d7dc4672).

- Pour faire une recherche part nom d'un Pilote:  
> http://127.0.0.1:8000/api/drivers/search/nom du pilot


- Pour faire une recherche part nom de Circuit: 
> http://127.0.0.1:8000/api/circuits/search/nom du circuit