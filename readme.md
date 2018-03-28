## Instalacija Laravel Projekta
- Preuzeti laravel projekat sa ove stranice
- Kreirati lokalnu bazu podataka
- Preuzeti composer https://getcomposer.org/download/
- Otvoriti konzolu unutar root direktorijuma projekta (ili se prebaciti na root direktorijum komandom `cd`)
- Preimenovati fajl `.env.example` u `.env` unutar root foldera projekta i promeniti informacije o bazi podataka po potrebi (potrebno je u konzoli unutar direktorijuma izvršiti komandu `mv .env.example .env`)
- Izvršiti komandu `composer install` ili ```php composer.phar install```
- Izvršiti komandu `php artisan key:generate` 
- Izvršiti komandu `php artisan migrate`
- Izvršiti komandu `php artisan db:seed`
- Ako želite da resetujete bazu podataka izvršite sledeće komande: 
```
php artisan migrate:rollback
php artisan migrate
php artisan db:seed
```

##### Sada možete pristupiti projektu preko localhost-a

### Ako projekat iz nekog razloga prestane da radi:
```
composer install
php artisan migrate
php artisan db:seed
```

TEST FOR DELETE