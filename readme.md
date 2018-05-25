## Instalacija Laravel Projekta
- Preuzeti laravel projekat sa ove stranice
- Kreirati lokalnu bazu podataka
- Preuzeti composer https://getcomposer.org/download/
- Otvoriti konzolu unutar root direktorijuma projekta (ili se prebaciti na root direktorijum komandom `cd`)
- Preimenovati fajl `.env.example` u `.env` unutar root foldera projekta i promeniti informacije o bazi podataka po potrebi (potrebno je u konzoli unutar direktorijuma izvršiti komandu `mv .env.example .env`)
- Izvršiti komandu `composer install` ili ```php composer.phar install```
- Izvršiti komandu `php artisan key:generate` 
- Izvršiti komandu `php artisan migrate`
- Izvršiti komandu `php artisan db:seed` za automatsko ubacivanje podataka u bazu
- Ako želite da resetujete bazu podataka izvršite sledeću komandu `php artisan migrate:refresh` ili `php artisan migrate:refresh --seed`
- Ako se prilikom seedovanja javi izuzetak kao što je `ReflectionException  : Class CommentsTableSeeder does not exist` izvršiti komandu `composer dump-autoload` 

##### Sada možete pristupiti projektu preko localhost-a

### Ako projekat iz nekog razloga prestane da radi:
```
composer install
php artisan migrate
php artisan db:seed
```

### Test nalozi (nakon izvršenja seed komande)

| Tip naloga        | E-mail           | Lozinka  |
| ------------- |:-------------:| -----:|
| Super-Admin     | sadmin@test.com | admin |
| Admin      | admin@test.com      |   admin |
| Suspendovani korisnik | suspendovani@test.com      |    admin |