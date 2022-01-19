# ASIMOV
## Dancing with Death - Test
# Test API
- The system should not allow to book more than 1
appointment per hour.
- The schedule must be set for office hours (9 am to 6
pm Monday to Friday) all year long
- Death is very picky with its agenda, so every
appointment must contain date, start time and contact
information (like e-mail).
- You can only appointment of 1 hour long with Death,
more would be pointless. Less would be too
traumatic.

# Test Front
- The first layout will display a date selector showcasing the current month.
- If you click on any date, the available hour spaces will be displayed on screen to be selected.

## Made With

- Laravel 8
- Boostrap / JS Vanilla / CSS 
- So much love!! 

## Installation

First Step
```sh
clone project
```

Later...
```sh
config your .env file!
```

Install the dependencies 

```sh
composer install
```


Migrate
```sh
php artisan migrate
```

If you want, populate database (Bookings) 

```sh
php artisan db:seed BookingSeeder
```



