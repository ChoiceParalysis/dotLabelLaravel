Developer Test for DotLabel Digital Creative Agency

username: admin@dotlabel.co.uk
password: 1234

App implements the following requirements:

Object Oriented PHP backend
Web based interface to CRUD operations
Laravel 4 framework
Eloquent 4 ORM
REST API
Single page Application UI (AngularJS)



PHP application for managing authorised hosts written using Laravel 4.3 MVC framework.

Application uses SQlite as a SQL engine. Since this app is not likely to get more 
than 100,000 hits per day, it is a good and portable substitute to a full-blown RDBMS like Mysql.
Because all the data is stored in a normal file in the host's system, no separate process is needed
to get the data. This often makes it faster than the alternatives.

To make interaction with the database more developer-friendly, app makes use of a Facade class called AuthorisedHosts.
Under the hood, it injects the Hosts repository interface and substitutes it with the Database implementation of the interface. 

To create or update a host, it uses a custom validation class to verify that all the requirements were met. 
In order to create a new host, it must have the following features: 

	Unique IP
	Valid subnet
	Description


The app makes use of its own RESTful API (a technique also known as dog-fooding) to fetch and process 
the data. It also implements paging to save server's resources and makes working with the front-end easier.

To use POST, PATCH or DELETE verbs on the API, the user has to be logged in (login credentials are supplied in the 
beginning of this document). 








