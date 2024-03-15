# GameHaven

This is a project for my Individual Project Course at my University. It is a GameStore website that allows users to log in to their account, create their account, and also has e-mail verification with phpmailer. As for the games, I used the Steam API to get the most popular games at the moment, the user also can add the wanted games to the cart and order them. For the order process, I used again the PHP mailer to send the user an email for confirmation of the order. 
All of this data is stored in a phpMyAdmin database set up locally in which I have the tables for the users, for every user the cart, and the orders. So you can add to the cart and place an order only if logged in.
I also have other pages on the application such as About Us, Contact, the Cart page (which is available only when the user is logged in), and Games Page. 
The application is also responsive for phones and tablets, the menu will change when on mobile devices. 

# How to Run:
-you need to have XAMPP Running,  also the databases set up in phpMyAdmin. 
-you need to get your own API token from Steam.
-you need to have set-up phpMailer.

# Technologies Used:
-HTML/CSS/JavaScript
-Php
-MySQl
-API
