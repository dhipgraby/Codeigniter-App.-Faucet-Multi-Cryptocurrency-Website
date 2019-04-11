# Codeigniter-App. Faucet Multi-Cryptocurrency Website
## This is a MVC (Model Viewer Controller) Architecture. 

Aplication build in codeigniter framework. Faucet, lottery and dice betting game. Also Advertising Network for promoters only.
It is build in php and Javascript.
Database is MySQL.

## What is a faucet site?

A faucet is a free coin sistem that give away a litte portion of crypto-currency, each certain amount of time, to users to incentivise the use of it across the website. 

## Features:

* Faucet supporting 4 crypto-currencies: Bitcoin, Dogecoin, Litecoin and Digibyte.
* Lottery: Weekly lottery for every friday. Buy lottery tickets using Bitcoin or Dogecoin for same lottery.
* Sit and go Lottery: 10 Players only 1 winner supporting Bitcoin and Dogecoin.
* Promoters Advertising Network. People can work directly promoting this website and get daily crypto payments.
* Deposit supporting : Bitcoin, Dogecoin, Litecoin and Digibyte. Automatically plus to user balance after 5 blockchain network confirmations.
* Withdraw available but not automatic in this repository.
* Account security: User can set extra security for loggin by using a Pincode or by Receiving a code to the Email.
* Security: User can set security for any kind of withdraw and security options access.
* Referral Marketing System: Referral system of 25% of all faucet claims, so users can earn by just referring people. 
* Blog/Articles sistem: Admin can post news and articles from Admin Panel.
* Tools: Bitcoin calculator. Calculate bitcoin amount in 6 Fiat currencies: USD,EUR,CNY,RUB,GBP,CAD.
* Admin Panel: To get statistics, modify users and change the site functionality.

## Website Structure.

The application structure is the following:

### Main Controllers and Models: 

In the "Core" folder is "My_Controller" where loads all the libraries that run all across the application.
Also is the main "Model" "My_model" that have all the basic functions that will run in the secondary models.  

### Secondary Controllers and Models:

There is Secondary controllers and models derive from the main ones, can be found in "Libraries" folder.
There is three main Secondary Controllers:

1. "Admin_Controller": (Only for admin functions) For control the Admin Panel.
2. "Buster_Controller" (For logged in user).
3. "Frontend_Controller" (For NOT logged in users).

### Other controllers and models

The rest of the application functionality can be found in the "controllers" and "models" folders.

### Views folder 

ALl the HTML and some Javascript files are in the "Views" folder and are divided by:

1. Admin: views for admin Panel.
2. Buster: views for user interface.
3. Templates: views for emails, news and articles.

### HELPERS 

Helper folder contain some files with functions to get prices, build menus, predefine buttons and HTML boxes.

This is a example base code only from the Application folder of Codeigniter, to understand this project and the usecase.
It is not able to run with this folder only. There is some extra libraries need in order to run this project as well.

If your interest in running this full website by your own, please contact me to Kenneth.zambrano4@gmail.com and i will be glad to help you setting up your own crypto-currency website with Codeigniter Framework.

Thanks for attention.

