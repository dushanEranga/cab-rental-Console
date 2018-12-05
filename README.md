#  Smart Cab Rental Console

## Introduction

Since the cab rental procedure is conducting completely manually here in Sri Lanka, I decided to introduce a smart way to make it automate. Hence I implemented a working prototype for one of my project assessment in university.  Basically I wanted to have a system which supports both “taxi service” and “rent a car” options .But here I have focused only on “rent a car” option due to the given limited time duration to complete the  project.

The system contains two parts. 
1)	A physical device that is placed in the vehicle which tracks the mileage and position while uploading the real time data to a central database.  
2)	Web console for business owners to manages vehicles and payments.  

## Technologies

### Physical device 
    Arduino based development (not described in this repository)
### Web console 
    HTML 5 
    Bootstrap 3
    PHP 5
    JavaScript
    SQL
    Google map API
## Features
A few of the things you can do with the console

Admin features
* Add user accounts
* Manage user accounts
* Update vehicles details such as per day charge, repair history and relavent photo.

All user features
* Register new customers.
* Rent out vehicles for customers.
* Generate, print and pay the bil.
* View current loacations and completed milages of vehicles using google map(The red mark arround Badulla is the only vehicle that linked with the microcontroller.Other markers are for the demonstration purpose)
* Receipt reprints.

## Preview
For live web app - 
Use Below credintials 
  ###### Admin login
    * username - admin@gmail.com
    * password - 123456
  ###### Normal login
    * username - dush@gmail.com
    * password - 123456
    
[Login From Here](http://mytestings.dushaneranga.tech)

[Demo Video Here](http://mytestings.dushaneranga.tech)

## To-Do List

This project is currently being inactive for nearly 2 years. But for learning purposes, I will built the missing modules such as Taxi management, adding new vehicles, Renting out for saved customers, refining trickey user interfaces etc...
