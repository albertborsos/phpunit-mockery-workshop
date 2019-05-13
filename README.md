[![Build Status](https://travis-ci.org/albertborsos/phpunit-mockery-workshop.svg?branch=master)](https://travis-ci.org/albertborsos/yii2-realworld-example-app)

# How it works

> Every conduit related classes are in the modules folder
> - modules/conduit - common/base classes
> - modules/api - api related classes and services

# Getting started

```
docker-compose up
docker exec -it phpunit-mockery-workshop_web_1 /bin/bash

composer install
./yii migrate
./tests/bin/yii migrate
```

## 1. Exercise - Ticket Status Workflow

 - On ticket create: allow only "Open" status
    - update validator in: `modules/01-ticket-status/services/ticket/forms/CreateTicketForm.php`
    - add test cases in: `tests/unit/modules/tickets/services/ticket/forms/CreateTicketFormTest.php`
        - valid test cases
        - invalid test cases

 - On Ticket update: allow only the following ticket statuses based on the current status.
    - implement allowed statuses mapping in `modules/01-ticket-status/domains/ticket/Ticket.php`
    - add test cases in: `tests/unit/modules/tickets/services/ticket/forms/UpdateTicketFormTest.php`
        - valid test cases
        - invalid test cases
        - simplify valid-invalid test cases by merging data providers into one
 
 | Current status | Allowed statuses |
 | -------------- | ---------------- |
 |Open|Under Development, Closed|
 |Under Development|Open, Suspended, Ready to QA|
 |Suspended|Under Development|
 |Ready to QA|Under Development, QA Review|
 |QA Review|Under Development,Resolved|
 |Resolved|QA Review, Closed|
 
