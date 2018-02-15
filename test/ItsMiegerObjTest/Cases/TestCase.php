<?php

	namespace ItsMiegerObjTest\Cases;


	use ItsMieger\Obj\Obj;

	abstract class TestCase extends \PHPUnit\Framework\TestCase
	{
		protected function setUp() {
			parent::setUp();

			Obj::resetMock();
		}

	}