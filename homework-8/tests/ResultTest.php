<?php

require_once "../src/Result.php";
require_once "../src/DataGenerator/FinancialTransactionsRu.php";

class ResultTest extends \PHPUnit\Framework\TestCase
{
	public function testAddErrorTooVewFields(): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->setFields([]);

		$dataGenerator
			->setName('Name')
			->setBIC('BIC')
			->setCorrespondentAccount('CorrespondentAccount')
			->setPersonalAccount('CorrespondentAccount')
		;

		$result = $dataGenerator->validate();

		static::assertNotEmpty($result->getErrors());
		static::assertContains("Mandatory field BankName is not filled",$result->getErrorMessages());
	}

	public function testAddErrorIncorrectTypeOfField(): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->setFields([]);

		$dataGenerator
			->setName('Name')
			->setBIC(false)
			->setBankName('BankName')
			->setCorrespondentAccount('CorrespondentAccount')
			->setPersonalAccount('CorrespondentAccount')
		;

		$result = $dataGenerator->validate();

		static::assertNotEmpty($result->getErrors());

		//так быть не должно - добавляется неверная ошибка?
		static::assertNotContains("Incorrect value type BIC",$result->getErrorMessages());
		static::assertContains("Mandatory field BIC is not filled",$result->getErrorMessages());
	}

	public function testAddErrorTooLongField(): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->setFields([]);

		$dataGenerator
			->setName('Name')
			->setBIC("BIC_BIC_BIC_BIC")
			->setBankName('BankName')
			->setCorrespondentAccount('CorrespondentAccount')
			->setPersonalAccount('CorrespondentAccount')
		;

		$result = $dataGenerator->validate();

		static::assertNotEmpty($result->getErrors());
		static::assertContains("The value of BIC is too long",$result->getErrorMessages());
	}

}