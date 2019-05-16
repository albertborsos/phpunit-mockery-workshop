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
    - update test to use a data provider: `tests/unit/modules/tickets/services/ticket/CreateTicketServiceTest.php`

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
    - get ticket from database fixtures and test to update every allowed attributes: `tests/unit/modules/tickets/services/ticket/UpdateTicketServiceTest.php` 

## 2. Exercise - Offer Discount With Dynamic Deadline

 - You send an offer to a customer. This offer contains a discount with a dynamic deadline, which calculates from the time, when the customer saw the offer first.
 The period of the discount can be between 1 and 8 workdays. The opening hours are the following:

  | Day | Close At |
  | -------------: | :-------------- |
  |Monday| 17:00|
  |Tuesday| 17:00|
  |Wednesday| 17:00|
  |Thursday| 17:00|
  |Friday| 17:00|
  |Saturday| 14:00|
  |Sunday| - |

  - write tests to check the calculation of the discount's deadline: `tests/unit/modules/store/domains/offer/OfferTest.php`

## 3. Exercise - Create Invoice for Offers

Write the tests in `tests/unit/modules/billing/services/invoice/forms/CreateInvoiceFormTest.php`, based on the following rules:

| Invoice Type | Rule |
| -------------| ---- |
|Deposit| can create multiple deposit invoices for an offer |
|Deposit| amount with zero value is not valid |
|Deposit| amount cannot be larger than the price of the offer |
|Deposit| sum of deposit invoices can not be larger than the price of the offer |
|Deposit| cannot create deposit invoice if final invoice already exists |
|Final| offer must have at least one deposit invoice to create a final invoice  |
|Final| amount of the invoice cannot be larger then the price of the offer minus the sum of the deposit invoices |
|Final| amount with zero value is valid |
|Final| only 1 final invoice is allowed |
|Full| cannot create full invoice if the sum of the deposit invoices and the final invoice are reached the price of the offer |
|Full| cannot create full invoice if deposit invoice exists, but final invoice is not exist |
|Full| amount must be equals with the price of the offer OR the price of the offer minus the sum of the deposit and final invoices |

Write tests in `tests/unit/modules/billing/services/invoice/CreateInvoiceServiceTest.php` to check the following things:
 - created invoice got a serial number (mock the "api")