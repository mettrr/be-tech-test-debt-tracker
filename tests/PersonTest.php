<?php

namespace DebtSimplifier\Test;

use PHPUnit\Framework\TestCase;
use DebtSimplifier\Person;

class PersonTest extends TestCase
{
	public function testAddDebt()
	{
		$alex = new Person("Alex");
		$bea = new Person("Bea");

		$alex->addDebt($bea, 10);

		$this->assertEquals($alex->getCredit(), -10);
		$this->assertEquals($bea->getCredit(), 10);
	}


	/**
	 * @depends testAddDebt
	 */
	public function testCompareAbsolute()
	{
		$alex = new Person("Alex");
		$bea = new Person("Bea");
		$clare = new Person("Clare");

		$this->assertEquals(Person::compareAbsolute($alex, $clare), 0);

		$alex->addDebt($bea, 10);
		$bea->addDebt($clare, 10);

		// Check that 10 and -10 return equal (absolute value)
		$this->assertEquals(Person::compareAbsolute($alex, $clare), 0);

		$this->assertEquals(Person::compareAbsolute($alex, $bea), 1);

		$this->assertEquals(Person::compareAbsolute($bea, $alex), -1);
	}


	/**
	 * @depends testAddDebt
	 * @depends testCompareAbsolute
	 */
	public function testSettleDebtsThreePeople()
	{
		$alex = new Person("Alex");
		$bea = new Person("Bea");
		$clare = new Person("Clare");

		$people = array($alex, $bea, $clare);

		$alex->addDebt($bea, 10);
		$bea->addDebt($clare, 10);

		$expectedResult = array(
			array($alex, 10, $clare)
		);

		$this->assertEquals(Person::settleDebts($people), $expectedResult);
	}


	/**
	 * @depends testAddDebt
	 * @depends testCompareAbsolute
	 */
	public function testSettleDebtsFourPeople()
	{
		$alex = new Person("Alex");
		$bea = new Person("Bea");
		$clare = new Person("Clare");
		$david = new Person("David");

		$people = array($alex, $bea, $clare, $david);

		$alex->addDebt($clare, 10);
		$bea->addDebt($clare, 10);
		$alex->addDebt($david, 10);

		$expectedResult = array(
			array($bea, 10, $david),
			array($alex, 20, $clare),
		);

		$actualResult = Person::settleDebts($people);

		$this->assertEquals(count($actualResult), 2);
		$this->assertContains($actualResult[0], $expectedResult);
		$this->assertContains($actualResult[1], $expectedResult);
	}
}
