
# Acme Widget Co Lab Code Test



## Intro


This PHP project serves as a proof of concept for Acme Widget Co’s new sales system. Acme Widget Co is a leading provider of fictional widgets.


## Assumptions


1. I assumed that when the user adds more than one red widget (R01) to the cart, and the offer 'buy one red widget, get the second half price' is applied, the discount will be applied as follows:

- For every pair of red widgets (R01) in the cart, the first red widget is charged at full price, and the second red widget is charged at half price.

## Requirements

This project requires the following:

- **PHP**: >= 8.0  
  (Some dependencies such as `monolog/monolog` require PHP 8 or higher.)
- **Composer**: For dependency management


## Steps to install the project



- Clone the Project from the command "git clone https://github.com/devbik069/acme-widget"

inside the folder in the terminal run below commands


- cd acme-widget

- composer install

- php -S localhost:8800



> php server is started on this url http://localhost:8800/


## index.php
The index.php file serves as the primary page for testing in the browser. I have used the examples provided in the PDF to demonstrate the various functionalities in action.

    Products: ["B01","G01"]  
    Basket Total: 37.85  
      
    Products: ["R01","R01"]  
    Basket Total: 54.37  
      
    Products: ["R01","G01"]  
    Basket Total: 60.85  
      
    Products: ["B01","B01","R01","R01","R01"]  
    Basket Total: 98.27


## Unit Tests
Unit tests have also been added to ensure the functionality works as expected. To run them, please execute the following command in the command line:




Command:  `./vendor/bin/phpunit --bootstrap src/Basket.php tests/BasketTest.php`


## PHP-CS-Fixer
Use the following PHP-CS-Fixer command to automatically fix any issues related to PSR code standards:



Command: `./vendor/bin/php-cs-fixer fix src`

Command: `./vendor/bin/php-cs-fixer fix tests`

## PHPStan

Use the following PHPStan command to detect potential bugs in your code:



Command: `./vendor/bin/phpstan analyse src tests`


## Monolog
Logging functionality is integrated, and the log file can be found at the path: /log/app.log.
