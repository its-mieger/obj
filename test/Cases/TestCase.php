<?php

	namespace ItsMiegerObjTest\Cases;


	use ItsMieger\Obj\Obj;

	abstract class TestCase extends \PHPUnit\Framework\TestCase
	{
		protected function setUp(): void {
			parent::setUp();

			Obj::resetMock();
		}

	}