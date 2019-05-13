[![Build Status](https://travis-ci.org/albertborsos/phpunit-mockery-workshop.svg?branch=master)](https://travis-ci.org/albertborsos/yii2-realworld-example-app)

# How it works

- Fork this repository and clone it to your machine
- You will find the exercises in the modules folder
- You will find the prepared tests in the `tests/unit/modules` folder
- If you create a merge request the tests begins to run in Travis CI

# Getting started

```
# start the docker containers
docker-compose up

# log in to shell
docker exec -it phpunit-mockery-workshop_web_1 /bin/bash

# install project dependencies
composer install
./yii migrate
./tests/bin/yii migrate

# run tests
./vendor/bin/codecept run unit
```

## 1. Exercise - Ticket Status Workflow

 - On ticket create: allow only "Open" status
    - update validator in: `modules/01-ticket-status/services/ticket/forms/CreateTicketForm.php`
    - add test cases in: `tests/unit/modules/tickets/services/ticket/forms/CreateTicketFormTest.php`
        - valid test cases
        - invalid test cases

 - On Ticket update: allow only the following ticket statuses based on the current status.
 
     | Current status | Allowed statuses |
     | -------------- | ---------------- |
     |Open|Under Development, Closed|
     |Under Development|Open, Suspended, Ready to QA|
     |Suspended|Under Development|
     |Ready to QA|Under Development, QA Review|
     |QA Review|Under Development,Resolved|
     |Resolved|QA Review, Closed|
 
    - implement allowed statuses mapping in `modules/01-ticket-status/domains/ticket/Ticket.php`
    - add test cases in: `tests/unit/modules/tickets/services/ticket/forms/UpdateTicketFormTest.php`
        - valid test cases
        - invalid test cases
        - simplify valid-invalid test cases by merging data providers into one
