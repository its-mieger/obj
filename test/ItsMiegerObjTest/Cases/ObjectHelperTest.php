<?php

	namespace ItsMiegerObjTest\Cases;


	use ItsMieger\Obj\Contracts\CastsAsBoolean;
	use ItsMieger\Obj\Contracts\CastsAsFloat;
	use ItsMieger\Obj\Contracts\CastsAsInteger;
	use ItsMieger\Obj\Contracts\CastsAsString;
	use ItsMieger\Obj\Contracts\Comparable;
	use ItsMieger\Obj\Contracts\Nullable;
	use ItsMieger\Obj\Contracts\OperatorAdd;
	use ItsMieger\Obj\Contracts\OperatorDivide;
	use ItsMieger\Obj\Contracts\OperatorMultiply;
	use ItsMieger\Obj\Contracts\OperatorSubtract;
	use ItsMieger\Obj\Exceptions\ObjectCastException;
	use ItsMieger\Obj\ObjectHelper;

	class ObjectHelperTest extends TestCase
	{
		protected static $classId = 0;

		protected function vectorTest(string $fn, array $vectors, $strict = false) {
			$obj = new ObjectHelper();

			foreach ($vectors as $label => $curr) {
				$ret = array_pop($curr);

				if (!$strict)
					$this->assertEquals($ret, $obj->{$fn}(...$curr), 'Testing ' . $fn . ' for "' . trim($label) . '"');
				else
					$this->assertSame($ret, $obj->{$fn}(...$curr), 'Testing ' . $fn . ' for "' . trim($label) . '"');
			}
		}

		protected function callPrecedenceTestCommutative(string $fn, string $interface, string $interfaceMethod, $returnType) {
			$obj = new ObjectHelper();

			++self::$classId;

			eval("class CallPrecedenceTestClass_" . self::$classId . " implements " . $interface . " { public function " . $interfaceMethod . "(\$a) : $returnType { throw new Exception('Method should not be called for this instance (" . $fn .")'); } }");
			$cls = "CallPrecedenceTestClass_" . self::$classId;


			// both implement - a inherits b => a should be called
			$b = new $cls();
			$a = $this->getMockBuilder($cls)->getMock();
			$a->expects($this->once())->method($interfaceMethod)->with($b);
			$obj->{$fn}($a, $b);

			// both implement - b inherits a => b should be called
			$a = new $cls();
			$b = $this->getMockBuilder($cls)->getMock();
			$b->expects($this->once())->method($interfaceMethod)->with($a);
			$obj->{$fn}($a, $b);

			// both implement - not inherited => a should be called
			$b = new $cls();
			$a = $this->getMockBuilder($interface)->getMock();
			$a->expects($this->once())->method($interfaceMethod)->with($b);
			$obj->{$fn}($a, $b);

			// both implement - same type => a should be called
			$b = $this->getMockBuilder($interface)->getMock();
			$b->expects($this->never())->method($interfaceMethod);
			$a = $this->getMockBuilder($interface)->getMock();
			$a->expects($this->once())->method($interfaceMethod)->with($b);
			$obj->{$fn}($a, $b);

			// only a implements => a should be called
			$b = new \stdClass();
			$a = $this->getMockBuilder($interface)->getMock();
			$a->expects($this->once())->method($interfaceMethod)->with($b);
			$obj->{$fn}($a, $b);

			// only b implements => b should be called
			$a = new \stdClass();
			$b = $this->getMockBuilder($interface)->getMock();
			$b->expects($this->once())->method($interfaceMethod)->with($a);
			$obj->{$fn}($a, $b);

			// none implements, none should be called
			$obj->{$fn}(1, 1);

		}

		protected function callPrecedenceTestNonCommutative(string $fn, string $interface, string $interfaceMethod, $returnType) {
			$obj = new ObjectHelper();

			++self::$classId;

			// create helper classes for inheritance tests on the fly
			eval("class CallPrecedenceTestClass_FailOnCall_" . self::$classId . " implements " . $interface . ", " . CastsAsInteger::class . " { public function " . $interfaceMethod . "(\$a) : $returnType { throw new Exception('Method should not be called for this instance (" . $fn .")'); } public function toInt() : int { return 1; } }");
			eval("class CallPrecedenceTestClass_AcceptCall_" . self::$classId . " implements " . $interface . " { public function " . $interfaceMethod . "(\$a) : $returnType { return ($returnType)1; } }");
			$cllShouldNotBeCalled = "CallPrecedenceTestClass_FailOnCall_" . self::$classId;
			$cllShouldBeCalled = "CallPrecedenceTestClass_AcceptCall_" . self::$classId;


			// both implement - a inherits b => a should be called
			$b = new $cllShouldNotBeCalled();
			$a = $this->getMockBuilder($cllShouldNotBeCalled)->getMock();
			$a->expects($this->once())->method($interfaceMethod)->with($b);
			$obj->{$fn}($a, $b);

			// both implement - b inherits a => a should be called
			$a = new $cllShouldBeCalled();
			$b = $this->getMockBuilder($cllShouldNotBeCalled)->getMock();
			$b->expects($this->never())->method($interfaceMethod)->with($a);
			$obj->{$fn}($a, $b);

			// both implement - not inherited => a should be called
			$b = new $cllShouldNotBeCalled();
			$a = $this->getMockBuilder($interface)->getMock();
			$a->expects($this->once())->method($interfaceMethod)->with($b);
			$obj->{$fn}($a, $b);

			// both implement - same type => a should be called
			$b = $this->getMockBuilder($interface)->getMock();
			$b->expects($this->never())->method($interfaceMethod);
			$a = $this->getMockBuilder($interface)->getMock();
			$a->expects($this->once())->method($interfaceMethod)->with($b);
			$obj->{$fn}($a, $b);

			// only a implements => a should be called
			$b = 1;
			$a = $this->getMockBuilder($interface)->getMock();
			$a->expects($this->once())->method($interfaceMethod)->with($b);
			$obj->{$fn}($a, $b);

			// only b implements => none should be called
			$a = 1;
			$b = new $cllShouldNotBeCalled();
			$obj->{$fn}($a, $b);


			// none implements, none should be called
			$obj->{$fn}(1, 1);

		}

		protected function mockObjectComparable($return, ...$with) {

			$mock = $this->getMockBuilder(Comparable::class)->getMock();
			$mock
				->expects($this->once())
				->method('compareTo')
				->with(...$with)
				->willReturn($return);

			return $mock;
		}

		protected function mockObjectCastsAsFloat($return) {
			$mock = $this->getMockBuilder(CastsAsFloat::class)->getMock();
			$mock
				->expects($this->once())
				->method('toFloat')
				->willReturn($return);

			return $mock;
		}

		protected function mockObjectCastsAsBoolean($return) {
			$mock = $this->getMockBuilder(CastsAsBoolean::class)
				->getMock();
			$mock
				->expects($this->once())
				->method('toBoolean')
				->willReturn($return);

			return $mock;
		}

		protected function mockObjectCastsAsInteger($return) {
			$mock = $this->getMockBuilder(CastsAsInteger::class)->getMock();
			$mock
				->expects($this->once())
				->method('toInt')
				->willReturn($return);

			return $mock;
		}

		protected function valuesInt() {
			$values = [
				' -100' => [-100],
				' -1'   => [-1],
				' 0'    => [0],
				' 1'    => [1],
				' 100'  => [100],
			];

			$ret = $values;
			foreach($values as $label => $curr) {
				$m = $this->getMockBuilder(CastsAsInteger::class)->getMock();
				$m->method('toInt')
					->willReturn($curr[0]);

				$ret['CastsAsInteger(' . trim($label) . ')'] = [$m, $curr[0]];
			}

			return $ret;
		}

		protected function valuesFloat() {
			$values = [
				' -100.1' => [-100.1],
				' -1.1'   => [-1.1],
				' 0.0'    => [0.0],
				' 1.1'    => [1.1],
				' 100.1'  => [100.1],
			];

			$ret = $values;
			foreach($values as $label => $curr) {
				$m = $this->getMockBuilder(CastsAsFloat::class)->getMock();
				$m->method('toFloat')
					->willReturn($curr[0]);

				$ret['CastsAsFloat(' . trim($label) . ')'] = [$m, $curr[0]];
			}

			return $ret;
		}

		protected function valuesBool() {
			$values = [
				' true'   => [true],
				' false'  => [false],
			];

			$ret = $values;
			foreach($values as $label => $curr) {
				$m = $this->getMockBuilder(CastsAsBoolean::class)->getMock();
				$m->method('toBoolean')
					->willReturn($curr[0]);

				$ret['CastsAsBoolean(' . trim($label) . ')'] = [$m, $curr[0]];
			}

			return $ret;
		}

		protected function valuesNull() {
			$values = [
				' null'   => [null],
			];

			$ret = $values;
			foreach($values as $label => $curr) {
				$m = $this->getMockBuilder(Nullable::class)->getMock();
				$m->method('isNull')
					->willReturn(true);

				$ret['CastsAsBoolean(' . trim($label) . ')'] = [$m, $curr[0]];
			}

			return $ret;
		}

		protected function valuesString() {
			$values = [
				'\'\''      => [''],
				'\'a\''     => ['a'],
				'\'true\''  => ['true'],
				'\'false\'' => ['false'],
				'\'0\''     => ['0'],
			];

			$ret = $values;
			foreach ($values as $label => $curr) {
				$m = $this->getMockBuilder(CastsAsString::class)->getMock();
				$m->method('toString')
					->willReturn($curr[0]);

				$ret['CastsAsString(' . trim($label) . ')'] = [$m, $curr[0]];
			}

			return $ret;
		}

		protected function cartesian($a, $b) {
			$ret = [];
			foreach($a as $labelA => $currA) {
				foreach ($b as $labelB => $currB) {
					$ret[] = [$labelA => $currA, $labelB . ' ' => $currB];
				}
			}

			return $ret;
		}

		protected function generateTestBinaryVectorsForAllValues(\Closure $resultFn) {
			$values = array_merge(
				$this->valuesInt(),
				$this->valuesFloat(),
				$this->valuesBool(),
				$this->valuesNull(),
				$this->valuesString()
			);

			$joined  = $this->cartesian($values, $values);
			$vectors = [];
			foreach ($joined as $curr) {

				list($labelA, $labelB) = array_keys($curr);
				list($valueA, $valueB) = array_values($curr);

				try {
					$vectors[trim($labelA) . ', ' . trim($labelB)] = [$valueA[0], $valueB[0], $resultFn((array_key_exists(1, $valueA) ? $valueA[1] : $valueA[0]), (array_key_exists(1, $valueB) ? $valueB[1] : $valueB[0]))];
				}
				catch (\Exception $ex) {}
			}

			return $vectors;
		}

		protected function generateTestVectorsForAllValues(\Closure $resultFn) {
			$values = array_merge(
				$this->valuesInt(),
				$this->valuesFloat(),
				$this->valuesBool(),
				$this->valuesNull(),
				$this->valuesString()
			);

			$vectors = [];
			foreach ($values as $label => $curr) {

				try {
					$vectors[$label] = [$curr[0], $resultFn(array_key_exists(1, $curr) ? $curr[1] : $curr[0])];
				}
				catch (\Exception $ex) {}
			}

			return $vectors;
		}


		public function testCompareVectors() {
			$this->vectorTest('compare', $this->generateTestBinaryVectorsForAllValues(function($a, $b) {
				return $a <=> $b;
			}));
		}

		public function testComparePrecedence() {
			$this->callPrecedenceTestCommutative('compare', Comparable::class, 'compareTo', 'int');
		}

		public function testAddVectors() {
			$this->vectorTest('add', $this->generateTestBinaryVectorsForAllValues(function($a, $b) {
				return $a + $b;
			}));
		}

		public function testAddPrecedence() {
			$this->callPrecedenceTestCommutative('add', OperatorAdd::class, '_operator_add', 'int');
		}

		public function testSubtractVectors() {
			$this->vectorTest('subtract', $this->generateTestBinaryVectorsForAllValues(function($a, $b) {
				return $a - $b;
			}));
		}

		public function testSubtractPrecedence() {
			$this->callPrecedenceTestNonCommutative('subtract', OperatorSubtract::class, '_operator_subtract', 'int');
		}

		public function testMultiplyVectors() {
			$this->vectorTest('multiply', $this->generateTestBinaryVectorsForAllValues(function ($a, $b) {
				return $a * $b;
			}));
		}

		public function testMultiplyPrecedence() {
			$this->callPrecedenceTestCommutative('multiply', OperatorMultiply::class, '_operator_multiply', 'int');
		}

		public function testDivideVectors() {
			$this->vectorTest('divide', $this->generateTestBinaryVectorsForAllValues(function ($a, $b) {

				// exclude vector
				if ($b == 0)
					throw new \Exception();

				return $a / $b;
			}));
		}

		public function testDividePrecedence() {
			$this->callPrecedenceTestNonCommutative('divide', OperatorDivide::class, '_operator_divide', 'int');
		}

		public function testCastFloat() {
			$this->vectorTest('castFloat', $this->generateTestVectorsForAllValues(function ($value) {
				return (float)$value;
			}), true);
		}

		public function testCastFloatException() {
			$obj = new ObjectHelper();

			$this->expectException(ObjectCastException::class);

			$obj->castFloat(new \stdClass());
		}

		public function testCastInt() {
			$this->vectorTest('castInt', $this->generateTestVectorsForAllValues(function ($value) {
				return (int)$value;
			}), true);
		}

		public function testCastIntException() {
			$obj = new ObjectHelper();

			$this->expectException(ObjectCastException::class);

			$obj->castInt(new \stdClass());
		}

		public function testCastBoolean() {
			$this->vectorTest('castBool', $this->generateTestVectorsForAllValues(function ($value) {
				return (bool)$value;
			}), true);
		}

		public function testCastBooleanException() {
			$obj = new ObjectHelper();

			$this->expectException(ObjectCastException::class);

			$obj->castBool(new \stdClass());
		}


		public function testCastString() {
			$this->vectorTest('castString', $this->generateTestVectorsForAllValues(function ($value) {
				return (string)$value;
			}), true);
		}

		public function testCastStringException() {
			$obj = new ObjectHelper();

			$this->expectException(ObjectCastException::class);

			$obj->castString(new \stdClass());
		}

	}