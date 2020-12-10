<?php

	namespace ItsMiegerObjTest\Cases\Traits;


	use ItsMieger\Obj\Obj;
	use ItsMieger\Obj\ObjectHelper;
	use ItsMieger\Obj\Traits\ObjectArithmetic;
	use ItsMiegerObjTest\Cases\TestCase;

	class ObjectArithmeticTest extends TestCase
	{
		public function testAdd() {
			/** @var ObjectArithmetic|\PHPUnit_Framework_MockObject_MockObject $mock */
			$mock = $this->getMockForTrait(ObjectArithmetic::class);

			$objMock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$objMock
				->expects($this->once())
				->method('add')
				->with($mock, 5)
				->willReturn(7);

			Obj::mock($objMock);

			$this->assertEquals(7, $mock->add(5));
		}

		public function testSubtract() {
			/** @var ObjectArithmetic|\PHPUnit_Framework_MockObject_MockObject $mock */
			$mock = $this->getMockForTrait(ObjectArithmetic::class);

			$objMock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$objMock
				->expects($this->once())
				->method('subtract')
				->with($mock, 5)
				->willReturn(7);

			Obj::mock($objMock);

			$this->assertEquals(7, $mock->subtract(5));
		}

		public function testMultiply() {
			/** @var ObjectArithmetic|\PHPUnit_Framework_MockObject_MockObject $mock */
			$mock = $this->getMockForTrait(ObjectArithmetic::class);

			$objMock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$objMock
				->expects($this->once())
				->method('multiply')
				->with($mock, 5)
				->willReturn(7);

			Obj::mock($objMock);

			$this->assertEquals(7, $mock->multiply(5));
		}

		public function testDivide() {
			/** @var ObjectArithmetic|\PHPUnit_Framework_MockObject_MockObject $mock */
			$mock = $this->getMockForTrait(ObjectArithmetic::class);

			$objMock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$objMock
				->expects($this->once())
				->method('divide')
				->with($mock, 5)
				->willReturn(7);

			Obj::mock($objMock);

			$this->assertEquals(7, $mock->divide(5));
		}
	}