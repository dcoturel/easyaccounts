# EasyAccounts

This is a software meant to provide an easy and simple solution to handle incomes and outcomes within a small group of people.
That intent is true but keeping an accounting record consistent.


## Features

The key features are:

1. **Accounts administration**: this is a support table containing the account plan
2. **Cash resources**: each cash resource is linked with an account
3. **Concepts**: the income and outcome concepts
4. **Incomes**: records of income movements. They generate an automated entry with the following schema:

|Account|D|H|
|----|----|----|
|Cash resource account|Amount||
|Concept account||Amount|

5. **Outcomes**: records of outcome movements. They generate an automated entry with the following schema:

|Account|D|H|
|----|----|----|
|Cash resource account||Amount|
|Concept account|Amount||

6. **Transferences**: records of movements between cash resources

## Contributing

The project is open for contributions. Just:

1. Fork
2. Feature branch
3. Pull request

## Using

The software is free to use. It's powered by [CakePHP](https://cakephp.org/), so I recommend to verify the minimum requirements for the framework in this page: [CakePHP Requirements](https://book.cakephp.org/3.0/en/installation.html). Also, it is good to read the [configuration](https://book.cakephp.org/3.0/en/development/configuration.html) page in order to know how to configure the database.

The steps for installation are:

1. Clone the project in your server
2. Run composer install to install dependencies
3. Configure the database
4. Run bin\cake migrations migrate in order to generate database schema
5. Configure your web server in order to publish the website
6. Open www.example.com/users/configure and create **Administrator** user password
