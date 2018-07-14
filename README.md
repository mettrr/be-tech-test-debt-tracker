# Mettrr Backend Tech Test - The Debt Simplifier

Welcome to the Mettrr backend tech test!

## Installation and setup

Please spend no more than 4 hours on this test. If you have some spare time 
have a go at the bonus questions at the bottom. Don't worry if you don't have a
complete solution by the end, feel free to submit in English how you would go
about finishing the rest of the test and / or bonus questions. You may do this 
test in whatever language you feel comfortable with, ideally with a test suite 
in place using a testing framework of your choosing.

Please start by creating a branch from master with the naming convention -
"{your name}/mettrr-tech-test".

## The Test

Your goal is to create a program which can track debts between between people.
The program should allow the ability to add a debt between two people and be 
able to view for a given person how much they owe and are owed and to whom. 
You may add any other features you think might benefit the program.

Feel free to use whatever third party packages or dependencies you think may
help to simplify this test but please be prepared to justify your decision to
use them.

If at any stage you have any questions, please contact Dom at db@mettrr.com.

Once you are done, push your changes to your branch and create a pull
request to master, tagging @dbatten5 in it and followed by an email to myself
(address above) to confirm your completion. Good luck!

## Bonus Questions

### Multi debts

Allow a debt to be added which can be split evenly between multiple people.

### Debt simplifying

Consider the following scenario:

Alex owes Bea £10 and Bea owes Clare £10. In order to settle their debts,
instead of Alex having to pay Bea and Bea having to pay Clare, Alex can simply
pay Clare £10.

Add a feature to your program which can calculate the simplest way to settle
debts between multiple people.
