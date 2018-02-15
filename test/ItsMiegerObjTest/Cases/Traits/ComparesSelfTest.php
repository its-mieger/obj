<?php

	namespace ItsMiegerObjTest\Cases\Traits;


	use ItsMieger\Obj\Obj;
	use ItsMieger\Obj\ObjectHelper;
	use ItsMieger\Obj\Traits\ComparesSelf;
	use ItsMiegerObjTest\Cases\TestCase;

	class ComparesSelfTest extends TestCase
	{
		public function testEquals() {
			/** @var ComparesSelf|\PHPUnit_Framework_MockObject_MockObject $mock */
			$mock = $this->getMockForTrait(ComparesSelf::class);

			$objMock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$objMock
				->expects($this->once())
				->method('equal')
				->with($mock, 5)
				->willReturn(7);

			Obj::mock($objMock);

			$this->assertEquals(7, $mock->equals(5));
		}

		public function testNotEquals() {
			/** @var ComparesSelf|\PHPUnit_Framework_MockObject_MockObject $mock */
			$mock = $this->getMockForTrait(ComparesSelf::class);

			$objMock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$objMock
				->expects($this->once())
				->method('notEqual')
				->with($mock, 5)
				->willReturn(7);

			Obj::mock($objMock);

			$this->assertEquals(7, $mock->notEquals(5));
		}

		public function testIsLessThan() {
			/** @var ComparesSelf|\PHPUnit_Framework_MockObject_MockObject $mock */
			$mock = $this->getMockForTrait(ComparesSelf::class);

			$objMock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$objMock
				->expects($this->once())
				->method('lessThan')
				->with($mock, 5)
				->willReturn(7);

			Obj::mock($objMock);

			$this->assertEquals(7, $mock->isLessThan(5));
		}

		public function testIsLessThanOrEqual() {
			/** @var ComparesSelf|\PHPUnit_Framework_MockObject_MockObject $mock */
			$mock = $this->getMockForTrait(ComparesSelf::class);

			$objMock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$objMock
				->expects($this->once())
				->method('lessThanOrEqual')
				->with($mock, 5)
				->willReturn(7);

			Obj::mock($objMock);

			$this->assertEquals(7, $mock->isLessThanOrEqual(5));
		}

		public function testIsGreaterThan() {
			/** @var ComparesSelf|\PHPUnit_Framework_MockObject_MockObject $mock */
			$mock = $this->getMockForTrait(ComparesSelf::class);

			$objMock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$objMock
				->expects($this->once())
				->method('greaterThan')
				->with($mock, 5)
				->willReturn(7);

			Obj::mock($objMock);

			$this->assertEquals(7, $mock->isGreaterThan(5));
		}

		public function testIsGreaterThanOrEqual() {
			/** @var ComparesSelf|\PHPUnit_Framework_MockObject_MockObject $mock */
			$mock = $this->getMockForTrait(ComparesSelf::class);

			$objMock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$objMock
				->expects($this->once())
				->method('greaterThanOrEqual')
				->with($mock, 5)
				->willReturn(7);

			Obj::mock($objMock);

			$this->assertEquals(7, $mock->isGreaterThanOrEqual(5));
		}
	}