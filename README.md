# studydrive-image-gallery-task

### Description ###

Use Laravel and Vue.js (whichever version you prefer) to develop a picture gallery web application with the following functionality: 
1. Registered users see all the pictures available. JSONPlaceholder Image API can be used to fetch fake data for this purpose. More detailed information about how to use this API can be found here. 
2. Use a simple pagination for the navigation through the pictures. 
4. Registered users can favorite/unfavorite pictures.
6. On Saturdays and Sundays, guest users see a list of the latest favorited photos picked by registered users. 
8. On the remaining days, guest users see a list of the users that have favorited the most so far during the week.


### Demo URL ###
http://salty-meadow-13832.herokuapp.com/

### Testing Credentials ###
  Email :  aliahmad@gmail.com
  
  password:  password


### Deployment ###
  1. Heroku
  2. Heroku CLI

### Run the test cases ###
1. vendor/bin/phpunit

### Server Requirments ###

1. PHP >= 7.3
2. BCMath PHP Extension
3. Ctype PHP Extension
4. Fileinfo PHP Extension
5. JSON PHP Extension
6. Mbstring PHP Extension
7. OpenSSL PHP Extension
8. PDO PHP Extension
9. Tokenizer PHP Extension
10. XML PHP Extension
11. Laravel 8.75

### Database ###
  1. MySQL
  
###  How to install ###
1. Clone the repository
2. move the project folder
3. Run **composer install** for laravel dependencies
4. **php artisan key:generate**
5. Setup the database with name **image_gallery** (Add database credentials in env file)
6. **php artisan migrate** to create the tables
7. **php artisan db:seed** to seed the user and photos data
8. Run **npm install** for frontend dependencies
9. Run **npm run dev** to compiled the view
10. **php artisan serve** to start the application

### Technologies ###
1. PHP
2. Laravel
3. VueJs
4. MySQL
5. Heroku


