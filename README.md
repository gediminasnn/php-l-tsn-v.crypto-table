
# Crypto Table

Crypto Table is a web application built using Laravel and Vue.js that allows users to search and view information about various cryptocurrencies.

## Installation

To install Crypto Table, follow these steps:

1.  Clone the repository: `git clone git@github.com:gediminasnn/crypto-table.git`
2.  Install dependencies: `composer install` and `npm install` both in back and front directory accordingly
3.  Set up a database and configure the `.env` file with your database credentials
4.  Run database migrations: `php artisan migrate`
5.  Seed the database with cryptocurrency data: `php artisan db:seed`
6.  Start the application: `php artisan serve`
7.  Compile frontend assets: `npm run dev`

## Usage

Once the application is running, you can access it at `http://localhost:8000` in your web browser.

NOTE : Run `php artisan fetch-coin-market-cap-currencies-usd` to fetch cryptocurrencies from the api
