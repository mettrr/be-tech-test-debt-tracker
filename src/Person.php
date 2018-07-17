<?php

namespace DebtSimplifier;

/**
 * Represents a person involved in paying or recieving debts.
 *
 * A person can have any number of debts to any number of people.
 * These debts can then be resolved in the simplest way possible. 
 */
class Person {

    /**
     * The name of the person.
     */
    private $name;

    /**
     * The person's overall credit after debts.
     */
    private $credit;


    /**
     * @param string
     */
    public function __construct($name)
    {
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return float
     */
    public function getCredit()
    {
        return $this->credit;
    }


    /**
     * @param float
     */
    private function addCredit($amount)
    {
        $this->credit += $amount;
    }


    /**
     * Add a debt the person owes.
     *
     * @param object $person Person the debt is owed to
     * @param float $amount Amount 
     */
    public function addDebt(Person $person, $amount)
    {
        $this->addCredit(-$amount);
        $person->addCredit($amount);
    }


    /**
     * Given an array of all people involved, return the simplest possible way of settling their debts.
     * Returns an array of transaction arrays containing the two people involved and the amount.
     * This array represents the transactions that were made in resolving the debts in the simplest way.
     * 
     * @param array People
     *
     * @return array
     */
    public static function settleDebts(array $people)
    {
        $transactions = array();

        // Sorting in this way ensures that matching debts are paid off first resulting in less transactions.
        usort($people, array("self", "compareAbsolute"));

        foreach ($people as $negPerson) {
            foreach ($people as $posPerson) {
                if ($posPerson->getCredit() > 0 && $negPerson->getCredit() < 0) {
                    $amount = min(array(-$negPerson->getCredit(), $posPerson->getCredit()));

                    $posPerson->addCredit(-$amount);
                    $negPerson->addCredit($amount);

                    $transactions[] = array($negPerson, $amount, $posPerson);
                }
            }
        }

        return $transactions;
    }


    /**
     * Comparison function to sort instances of Person by the absolute value of their credit.
     *
     * @param object Person a
     * @param object Person b
     *
     * @return int
     */
    public static function compareAbsolute($a, $b)
    {
        if (abs($a->getCredit()) > abs($b->getCredit())) {
            return 1;
        } elseif (abs($a->getCredit()) < abs($b->getCredit())) {
            return -1;
        } else {
            return 0;
        }
    }
}
