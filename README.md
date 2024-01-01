# About

This is a crypto investment platform built with Javascript, AJAX and PHP where users can invest by depositing and subscribing to plans/packages to get returns at intervals on their capital over a period of time.

# Color scheme

Old - #392C70

# Technical details

* Was implemented while imitating MVC structure where Controllers is separated from Views/Templates

* How investment process/function works is that it starts to drop profits at intervals from the approval date and finally drops RIO(Returns On Investment) which is capital + total calculated profits, on or after end date of investment

* Reinvestment feature was added. Now users choose whether to cashout their ROIs or re-invest it manually. Admin can also perform these functionalities on their panel.

* Investment functions was implemented without use of background task running services such as celery, redis, crontab or any scheduler etc

* Function to delete user notifications longer than 3 days was implemented using similar method to the investment function.

* Diverse pages were made to run either of the above functions rather than both to reduce load time(increase speed)

* A single function handles account credit and debit, saves the transaction record and sends appropriate notification

* Referral as implemented using javascript local storage. referrer was saved to local storage and fetched when user navigates to register/sign up page and deleted after successful registeration  

* Gets users location and timezone on sign up while converting investments/deposit/withdrawal dates in UTC to dates in user's saved timezone

* Set language and Google translator functionality implemented in similar way to dark mode functionality. Authenticated user default language is always English ('en')

* Qr code are generated from wallet address

* Email uses html templates for nice and professional formatting

* Ajax and animations


# Features

* Emailing functionality
* Authentication and authorization
* User blocking functionality
* User referral and commission program
* Function to update investments without background tasks libraries like celery, redis or any schedulers etc
* Ajax functionalities to communicate to backend without page reload
* Notification features and auto delete functionality
* Error 404 and 500 pages implemented to handle error pages
* Password reset functionality
* Set language and Google translator functionality


# Technologies

* Vanilla Javascript
* Ajax
* PHP
* PHPMailer v6.8.1


# Pages

Project contains 25+ pages which includes home, contact, faq, register, login, dashboard, profile, update password, create investment, invoice, investment history, withdraw, withdraw history, notifications, affiliates, success, 404, password reset pages, email templates and admin pages.