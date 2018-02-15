<?php

	namespace ItsMiegerObjTest\Cases;


	use ItsMieger\Obj\Obj;
	use ItsMieger\Obj\ObjectHelper;

	class ObjTest extends TestCase
	{

		public function testSingletonCall() {

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('compare')
				->with(3, 5)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertSame(7, Obj::compare(3,5));
		}

		public function testSingletonResolve() {

			$instance = Obj::singleton();

			$this->assertInstanceOf(ObjectHelper::class, $instance);
			$this->assertSame($instance, Obj::singleton());
		}

		public function testMockReset() {

			$mock = new \stdClass();

			Obj::mock($mock);
			Obj::resetMock();

			$this->assertNotEquals($mock, Obj::singleton());
		}

		public function testLoadHelperFunctions() {

			Obj::loadHelpers();

			$this->assertTrue(function_exists('o_comp'));
			$this->assertTrue(function_exists('o_eq'));
			$this->assertTrue(function_exists('o_ne'));
			$this->assertTrue(function_exists('o_lt'));
			$this->assertTrue(function_exists('o_le'));
			$this->assertTrue(function_exists('o_gt'));
			$this->assertTrue(function_exists('o_ge'));
			$this->assertTrue(function_exists('o_isNull'));
			$this->assertTrue(function_exists('o_isInt'));
			$this->assertTrue(function_exists('o_isFloat'));
			$this->assertTrue(function_exists('o_isBool'));
			$this->assertTrue(function_exists('o_isString'));
			$this->assertTrue(function_exists('o_add'));
			$this->assertTrue(function_exists('o_sub'));
			$this->assertTrue(function_exists('o_mul'));
			$this->assertTrue(function_exists('o_div'));
			$this->assertTrue(function_exists('o_castFloat'));
			$this->assertTrue(function_exists('o_castInt'));
			$this->assertTrue(function_exists('o_castBool'));
			$this->assertTrue(function_exists('o_castString'));
		}

		public function testDuplicateHelperLoad() {

			Obj::loadHelpers();
			Obj::loadHelpers();
		}

		public function testDuplicateHelperImport() {

			// this should fail if a function is defined twice
			include __DIR__ . '/../../../src/ItsMieger/Obj/helpers.php';
			include __DIR__ . '/../../../src/ItsMieger/Obj/helpers.php';
		}

	}