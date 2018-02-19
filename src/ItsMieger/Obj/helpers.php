<?php
	use ItsMieger\Obj\Exceptions\ObjectCastException;
	use ItsMieger\Obj\Obj;

	if (!function_exists('o_comp')) {

		/**
		 * Compares two objects
		 * @param mixed $a The object a
		 * @param mixed $b The object b
		 * @return int 0 if equals value. -1 if less than value. 1 if greater than value.
		 */
		function o_comp($a, $b) {
			return Obj::singleton()->compare($a, $b);
		}
	}

	if (!function_exists('o_eq')) {

		/**
		 * Checks if two values are equal
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return bool True if equals. Else false.
		 */
		function o_eq($a, $b) {
			return Obj::singleton()->equal($a, $b);
		}
	}

	if (!function_exists('o_ne')) {

		/**
		 * Checks if two values are not equal
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return bool True if equals. Else false.
		 */
		function o_ne($a, $b) {
			return Obj::singleton()->notEqual($a, $b);
		}
	}

	if (!function_exists('o_lt')) {

		/**
		 * Checks if a value is less than another value
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return bool True if first value is less than the second value. Else false.
		 */
		function o_lt($a, $b) {
			return Obj::singleton()->lessThan($a, $b);
		}
	}

	if (!function_exists('o_le')) {

		/**
		 * Checks if a value is less than or equal to another value
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return bool True if first value is less than or equal to the second value. Else false.
		 */
		function o_le($a, $b) {
			return Obj::singleton()->lessThanOrEqual($a, $b);
		}
	}

	if (!function_exists('o_gt')) {

		/**
		 * Checks if a value is greater than another value
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return bool True if first value is greater than the second value. Else false.
		 */
		function o_gt($a, $b) {
			return Obj::singleton()->greaterThan($a, $b);
		}
	}

	if (!function_exists('o_ge')) {

		/**
		 * Checks if a value is greater than or equal to another value
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return bool True if first value is greater than or equal to the second value. Else false.
		 */
		function o_ge($a, $b) {
			return Obj::singleton()->greaterThanOrEqual($a, $b);
		}
	}

	if (!function_exists('o_isNull')) {

		/**
		 * Checks if a value represents null
		 * @param mixed $value The value
		 * @return bool True if represents null. Else false.
		 */
		function o_isNull($value) {
			return Obj::singleton()->isNull($value);
		}
	}

	if (!function_exists('o_isInt')) {

		/**
		 * Checks if a value is an integer or casts as integer
		 * @param mixed $value The value
		 * @return bool True if integer. Else false.
		 */
		function o_isInt($value) {
			return Obj::singleton()->isInt($value);
		}
	}

	if (!function_exists('o_isFloat')) {

		/**
		 * Checks if a value is a float or casts as float
		 * @param mixed $value The value
		 * @return bool True if float. Else false.
		 */
		function o_isFloat($value) {
			return Obj::singleton()->isFloat($value);
		}
	}

	if (!function_exists('o_isBool')) {

		/**
		 * Checks if a value is a boolean or casts as boolean
		 * @param mixed $value The value
		 * @return bool True if boolean. Else false.
		 */
		function o_isBool($value) {
			return Obj::singleton()->isBool($value);
		}
	}

	if (!function_exists('o_isString')) {

		/**
		 * Checks if a value is a string or casts as string
		 * @param mixed $value The value
		 * @return bool True if string. Else false.
		 */
		function o_isString($value) {
			return Obj::singleton()->isString($value);
		}
	}

	if (!function_exists('o_add')) {

		/**
		 * Adds two values
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return mixed The result
		 */
		function o_add($a, $b) {
			return Obj::singleton()->add($a, $b);
		}
	}

	if (!function_exists('o_sub')) {

		/**
		 * Subtracts two values
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return mixed The result
		 */
		function o_sub($a, $b) {
			return Obj::singleton()->subtract($a, $b);
		}
	}

	if (!function_exists('o_mul')) {

		/**
		 * Multiplies two values
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return mixed The result
		 */
		function o_mul($a, $b) {
			return Obj::singleton()->multiply($a, $b);
		}
	}

	if (!function_exists('o_div')) {

		/**
		 * Divides a value by another value
		 * @param mixed $a The first value
		 * @param mixed $b The second value
		 * @return mixed The result
		 */
		function o_div($a, $b) {
			return Obj::singleton()->divide($a, $b);
		}
	}

	if (!function_exists('o_castFloat')) {

		/**
		 * Casts the value as float
		 * @param mixed $value The value
		 * @return float The value as float
		 * @throws ObjectCastException
		 */
		function o_castFloat($value) {
			return Obj::singleton()->castFloat($value);
		}
	}

	if (!function_exists('o_castInt')) {

		/**
		 * Casts the value as integer
		 * @param mixed $value The value
		 * @return int The value as integer
		 * @throws ObjectCastException
		 */
		function o_castInt($value) {
			return Obj::singleton()->castInt($value);
		}
	}

	if (!function_exists('o_castBool')) {

		/**
		 * Casts the value as boolean
		 * @param mixed $value The value
		 * @return bool The value as boolean
		 * @throws ObjectCastException
		 */
		function o_castBool($value) {
			return Obj::singleton()->castBool($value);
		}
	}

	if (!function_exists('o_castString')) {

		/**
		 * Casts the value as string
		 * @param mixed $value The value
		 * @return string The value as string
		 * @throws ObjectCastException
		 */
		function o_castString($value) {
			return Obj::singleton()->castString($value);
		}
	}

	if (!function_exists('o_comparePipe')) {

		/**
		 * Executes multiples comparisons in a pipeline. The pipeline exits immediately if a step does not return 0. This function helps to check multiple criteria.
		 * @param array[]|\Closure[]|int[] ...$comparisons A step may be an integer representing a comparision result, a closure to call for a comparision result or an array of two values to be compared.
		 * @return int The comparision result.
		 */
		function o_comparePipe(...$comparisons) {
			return Obj::singleton()->comparePipe(...$comparisons);
		}
	}

