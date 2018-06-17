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
- U slučaju da ne funkcioniše upload slika, obrisati folder `public/storage` i zatim izvršiti komandu `php artisan storage:link`

##### Aplikaciju pokrenuti komandom `php artisan serve`, ili ako želite da aplikacija bude vidljiva na lokalnoj mreži komandom `php artisan serve --host=IP_ADDRESS --port=PORT` gde je IP_ADDRESS lokalna ipv4 adresa računara na kome se pokreće server, npr. 192.168.0.12 (može se videti izvršenjem komande ipconfig u CMD-u) a PORT željeni port, npr. 8000

### Ako projekat iz nekog razloga prestane da radi:
```
composer install
php artisan migrate:refresh --seed
```


### Test nalozi (nakon izvršenja seed komande)

| Tip naloga        | E-mail           | Lozinka  |
| ------------- |:-------------:| -----:|
| Super-Admin     | sadmin@test.com | admin |
| Admin      | admin@test.com      |   admin |
| Suspendovani korisnik | suspendovani@test.com      |    admin |