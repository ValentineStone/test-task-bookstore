# Bookstore
A sample bookstore app on `Laravel` & `preact`
## How to install

1. Clone the repo:
`git clone https://github.com/ValentineStone/test-task-bookstore`

2. Cd into the project folder
`cd test-task-bookstore`

3. Install composer packages
`composer install`

4. Install npm packages
`npm install`

5. Setup your `.env`, don't forget a database

6. Migrate the database
`php artisan migrate`

7. Seed the database
`php artisan db:seed`

## How to run

1. Build
`npm run dev`
or
`npm run prod`
or
`npm run watch` for automated rebuilding

2. Run the server
`php artisan serve`
or
`php artisan serve --host=192.168.0.111 --port=80`
for lan testing with any host and port