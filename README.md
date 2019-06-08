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


