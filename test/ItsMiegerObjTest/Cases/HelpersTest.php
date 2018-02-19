<?php

	namespace ItsMiegerObjTest\Cases;


	use ItsMieger\Obj\Obj;
	use ItsMieger\Obj\ObjectHelper;

	class HelpersTest extends TestCase
	{
		public function testOCompare() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('compare')
				->with(3, 5)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_comp(3, 5));
		}

		public function testOEqual() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('equal')
				->with(3, 5)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_eq(3, 5));
		}

		public function testONotEqual() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('notEqual')
				->with(3, 5)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_ne(3, 5));
		}

		public function testOLessThan() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('lessThan')
				->with(3, 5)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_lt(3, 5));
		}

		public function testOLessThanOrEqual() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('lessThanOrEqual')
				->with(3, 5)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_le(3, 5));
		}

		public function testOGreaterThan() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('greaterThan')
				->with(3, 5)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_gt(3, 5));
		}

		public function testOGreaterThanOrEqual() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('greaterThanOrEqual')
				->with(3, 5)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_ge(3, 5));
		}

		public function testOIsNull() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('isNull')
				->with(3)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_isNull(3));
		}

		public function testOIsInt() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('isInt')
				->with(3)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_isInt(3));
		}

		public function testOIsFloat() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('isFloat')
				->with(3)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_isFloat(3));
		}

		public function testOIsBool() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('isBool')
				->with(3)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_isBool(3));
		}

		public function testOIsString() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('isString')
				->with(3)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_isString(3));
		}

		public function testOAdd() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('add')
				->with(3, 5)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_add(3, 5));
		}


		public function testOSubtract() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('subtract')
				->with(3, 5)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_sub(3, 5));
		}

		public function testOMultiply() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('multiply')
				->with(3, 5)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_mul(3, 5));
		}

		public function testODivide() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('divide')
				->with(3, 5)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_div(3, 5));
		}

		public function testOCastFloat() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('castFloat')
				->with(3)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_castFloat(3));
		}

		public function testOCastInt() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('castInt')
				->with(3)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_castInt(3));
		}

		public function testOCastBool() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('castBool')
				->with(3)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_castBool(3));
		}

		public function testOCastString() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('castString')
				->with(3)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_castString(3));
		}

		public function testOComparePipe() {
			Obj::loadHelpers();

			$mock = $this->getMockBuilder(ObjectHelper::class)->getMock();
			$mock
				->expects($this->once())
				->method('comparePipe')
				->with(3, 7, 8)
				->willReturn(7);

			Obj::mock($mock);

			$this->assertEquals(7, o_comparePipe(3, 7,8));
		}
	}