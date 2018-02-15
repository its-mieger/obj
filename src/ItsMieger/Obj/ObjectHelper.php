<?php


	namespace ItsMieger\Obj;


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

	/**
	 * Implements object helper functions
	 * @package ItsMieger\Obj
	 */
	class ObjectHelper
	{
		/**
		 * Invokes a binary operation for two values
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @param string $interface The interface implementing the operation
		 * @param string $fn The function to invoke
		 * @param mixed $result The result returned by the operation
		 * @param bool $commutative True if commutative operation
		 * @return bool True if could be invoked. Else false.
		 */
		protected function invokeBinaryOperation($a, $b, string $interface, string $fn, &$result, $commutative = true) {
			$aHasAbility = is_object($a) && ($a instanceof $interface);
			$bHasAbility = is_object($b) && ($b instanceof $interface);

			if ($aHasAbility && $bHasAbility) {
				$classNameA = get_class($a);
				$classNameB = get_class($b);
				if (!$commutative || $a instanceof $classNameB || !($b instanceof $classNameA))
					$result = $a->{$fn}($b);
				else
					$result = $b->{$fn}($a);

				return true;
			}
			elseif ($aHasAbility) {
				$result = $a->{$fn}($b);

				return true;
			}
			elseif ($bHasAbility && $commutative) {
				$result = $b->{$fn}($a);

				return true;
			}
			else {
				return false;
			}
		}

		/**
		 * Casts a value to a specified type if possible
		 * @param mixed $value The value
		 * @param string $type The type to cast to
		 * @return mixed
		 */
		protected function tryCastNative($value, string $type) {
			switch ($type) {
				case 'bool':
				case 'boolean':
					if (!is_object($value))
						return (bool)$value;
					elseif ($value instanceof Nullable && $value->isNull())
						return (bool)null;
					elseif ($value instanceof CastsAsBoolean)
						return $value->toBoolean();
					elseif ($value instanceof CastsAsFloat)
						return (bool)$value->toFloat();
					elseif ($value instanceof CastsAsInteger)
						return (bool)$value->toInt();
					elseif ($value instanceof CastsAsString)
						return (bool)$value->toString();
					else
						return $value;

				case 'int':
				case 'integer':
					if (!is_object($value))
						return (int)$value;
					elseif ($value instanceof Nullable && $value->isNull())
						return (integer)null;
					elseif ($value instanceof CastsAsInteger)
						return $value->toInt();
					elseif ($value instanceof CastsAsBoolean)
						return (int)$value->toBoolean();
					elseif ($value instanceof CastsAsFloat)
						return (int)$value->toFloat();
					elseif ($value instanceof CastsAsString)
						return (int)$value->toString();
					else
						return $value;

				case 'float':
					if (!is_object($value))
						return (float)$value;
					elseif ($value instanceof Nullable && $value->isNull())
						return (float)null;
					elseif ($value instanceof CastsAsFloat)
						return $value->toFloat();
					elseif ($value instanceof CastsAsInteger)
						return (float)$value->toInt();
					elseif ($value instanceof CastsAsBoolean)
						return (float)$value->toBoolean();
					elseif ($value instanceof CastsAsString)
						return (float)$value->toString();
					else
						return $value;

				case 'null':
					if (!is_object($value))
						return $value;
					elseif ($value instanceof Nullable && $value->isNull())
						return null;
					elseif ($value instanceof CastsAsFloat)
						return $value->toFloat();
					elseif ($value instanceof CastsAsInteger)
						return $value->toInt();
					elseif ($value instanceof CastsAsBoolean)
						return $value->toBoolean();
					elseif ($value instanceof CastsAsString)
						return $value->toString();
					else
						return $value;

				case 'string':
					if (!is_object($value))
						return (string)$value;
					elseif ($value instanceof Nullable && $value->isNull())
						return (string)null;
					elseif ($value instanceof CastsAsString)
						return $value->toString();
					elseif ($value instanceof CastsAsFloat)
						return (string)$value->toFloat();
					elseif ($value instanceof CastsAsInteger)
						return (string)$value->toInt();
					elseif ($value instanceof CastsAsBoolean)
						return (string)$value->toBoolean();
					else
						return $value;

				default:
					return $value;
			}
		}

		/**
		 * Converts the objects as native operands as good as possible
		 * @param mixed $a Operand a
		 * @param mixed $b Operand b
		 */
		protected function asNativeOperands(&$a, &$b, $typePrecedence = ['string', 'float', 'int', 'bool', 'null']) {

			$targetType = 'object';
			foreach($typePrecedence as $currType) {
				if ($this->{'is' . ucfirst($currType)}($a) || $this->{'is' . ucfirst($currType)}($b)) {
					$targetType = $currType;
					break;
				}
			}

			$a = $this->tryCastNative($a, $targetType);
			$b = $this->tryCastNative($b, $targetType);
		}

		/**
		 * Gets the type name (class name or type) of the passed object
		 * @param mixed $obj The object
		 * @return string The type name
		 */
		protected function getTypeName($obj) {
			$type = gettype($obj);

			switch($type) {
				case 'object':
					return get_class($obj);
				default:
					return $type;
			}
		}

		/**
		 * Casts the value as float
		 * @param mixed $value The value
		 * @return float The value as float
		 * @throws ObjectCastException
		 */
		public function castFloat($value) : float {
			$ret = $this->tryCastNative($value, 'float');

			if (!is_float($ret))
				throw new ObjectCastException($this->getTypeName($value), 'float');

			return $ret;
		}

		/**
		 * Casts the value as integer
		 * @param mixed $value The value
		 * @return int The value as integer
		 * @throws ObjectCastException
		 */
		public function castInt($value) : int {
			$ret = $this->tryCastNative($value, 'int');

			if (!is_int($ret))
				throw new ObjectCastException($this->getTypeName($value), 'int');

			return $ret;
		}

		/**
		 * Casts the value as boolean
		 * @param mixed $value The value
		 * @return bool The value as boolean
		 * @throws ObjectCastException
		 */
		public function castBool($value) : bool {
			$ret = $this->tryCastNative($value, 'bool');

			if (!is_bool($ret))
				throw new ObjectCastException($this->getTypeName($value), 'bool');

			return $ret;
		}

		/**
		 * Casts the value as string
		 * @param mixed $value The value
		 * @return string The value as string
		 * @throws ObjectCastException
		 */
		public function castString($value) : string {
			$ret = $this->tryCastNative($value, 'string');

			if (!is_string($ret))
				throw new ObjectCastException($this->getTypeName($value), 'string');

			return $ret;
		}

		/**
		 * Checks if a value represents null
		 * @param mixed $value The value
		 * @return bool True if represents null. Else false.
		 */
		public function isNull($value): bool {
			if (is_object($value) && $value instanceof Nullable && $value->isNull())
				return true;
			else
				return $value == null;
		}

		/**
		 * Checks if a value is an integer or casts as integer
		 * @param mixed $value The value
		 * @return bool True if integer. Else false.
		 */
		public function isInt($value) {
			return is_int($value) || (is_object($value) && $value instanceof CastsAsInteger);
		}

		/**
		 * Checks if a value is a float or casts as float
		 * @param mixed $value The value
		 * @return bool True if float. Else false.
		 */
		public function isFloat($value) {
			return is_float($value) || (is_object($value) && $value instanceof CastsAsFloat);
		}

		/**
		 * Checks if a value is a boolean or casts as boolean
		 * @param mixed $value The value
		 * @return bool True if boolean. Else false.
		 */
		public function isBool($value) {
			return is_bool($value) || (is_object($value) && $value instanceof CastsAsBoolean);
		}

		/**
		 * Checks if a value is a string or casts as string
		 * @param mixed $value The value
		 * @return bool True if string. Else false.
		 */
		public function isString($value) {
			return is_string($value) || (is_object($value) && $value instanceof CastsAsString);
		}

		/**
		 * Compares two objects.
		 *
		 * If both implement the Comparable interface, the compareTo function is invoked for the descended object if the objects are descendants.
		 * If objects are not descendants, the compareTo function is invoked for the first object.
		 *
		 * If only one implements the Comparable interface, the compareTo function is invoked for the corresponding object.
		 *
		 * If none implements the Comparable interface the spaceship operator is used to compare both values
		 *
		 * @param mixed|Comparable $a The object a
		 * @param mixed|Comparable $b The object b
		 * @return int 0 if equals value. -1 if less than value. 1 if greater than value.
		 */
		public function compare($a, $b): int {

			$result = null;
			if (!$this->invokeBinaryOperation($a, $b, Comparable::class, 'compareTo', $result)) {

				$this->asNativeOperands($a, $b, ['null', 'bool', 'float', 'int', 'string']);

				$result = $a <=> $b;
			}

			return $result;
		}


		/**
		 * Adds two values
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return mixed The result
		 */
		public function add($a, $b) {
			$result = null;
			if (!$this->invokeBinaryOperation($a, $b, OperatorAdd::class, '_operator_add', $result)) {
				$this->asNativeOperands($a, $b);
				$result = $a + $b;
			}

			return $result;
		}

		/**
		 * Subtracts two values
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return mixed The result
		 */
		public function subtract($a, $b) {
			$result = null;
			if (!$this->invokeBinaryOperation($a, $b, OperatorSubtract::class, '_operator_subtract', $result, false)) {
				$this->asNativeOperands($a, $b);
				$result = $a - $b;
			}

			return $result;
		}

		/**
		 * Multiplies two values
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return mixed The result
		 */
		public function multiply($a, $b) {
			$result = null;
			if (!$this->invokeBinaryOperation($a, $b, OperatorMultiply::class, '_operator_multiply', $result)) {
				$this->asNativeOperands($a, $b);
				$result = $a * $b;
			}

			return $result;
		}

		/**
		 * Divides a value by another value
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return mixed The result
		 */
		public function divide($a, $b) {
			$result = null;
			if (!$this->invokeBinaryOperation($a, $b, OperatorDivide::class, '_operator_divide', $result, false)) {
				$this->asNativeOperands($a, $b);
				$result = $a / $b;
			}

			return $result;
		}

		/**
		 * Checks if two values are equal
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return bool True if equals. Else false.
		 */
		public function equal($a, $b) : bool {
			return $this->compare($a, $b) == 0;
		}

		/**
		 * Checks if two values are not equal
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return bool True if equals. Else false.
		 */
		public function notEqual($a, $b) {
			return !$this->equal($a, $b);
		}

		/**
		 * Checks if a value is greater than another value
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return bool True if first value is greater than the second value. Else false.
		 */
		public function greaterThan($a, $b) : bool {
			return $this->compare($a, $b) > 0;
		}

		/**
		 * Checks if a value is greater than or equal to another value
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return bool True if first value is greater than or equal to the second value. Else false.
		 */
		public function greaterThanOrEqual($a, $b) : bool {
			return $this->compare($a, $b) >= 0;
		}

		/**
		 * Checks if a value is less than another value
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return bool True if first value is less than the second value. Else false.
		 */
		public function lessThan($a, $b): bool {
			return $this->compare($a, $b) < 0;
		}

		/**
		 * Checks if a value is less than or equal to another value
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return bool True if first value is less than or equal to the second value. Else false.
		 */
		public function lessThanOrEqual($a, $b): bool {
			return $this->compare($a, $b) <= 0;
		}
	}