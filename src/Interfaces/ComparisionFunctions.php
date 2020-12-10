<?php

	namespace ItsMieger\Obj\Interfaces;


	use ItsMieger\Obj\Contracts\Comparable;

	interface ComparisionFunctions extends Comparable
	{
		/**
		 * Checks if the object equals the specified value
		 * @param mixed $value The value to compare to
		 * @return bool True if equals. Else false.
		 */
		public function equals($value);

		/**
		 * Checks if the object does not equal the specified value
		 * @param mixed $value The value to compare to
		 * @return bool True if not equals. Else false.
		 */
		public function notEquals($value);

		/**
		 * Checks if the object is greater than the specified value
		 * @param mixed $value The value to compare to
		 * @return bool True if greater than the specified value. Else false.
		 */
		public function isGreaterThan($value);

		/**
		 * Checks if the object is greater than or equal to the specified value
		 * @param mixed $value The value to compare to
		 * @return bool True if greater than or equal to the specified value. Else false.
		 */
		public function isGreaterThanOrEqual($value);

		/**
		 * Checks if the object is less than the specified value
		 * @param mixed $value The value to compare to
		 * @return bool True if less than the specified value. Else false.
		 */
		public function isLessThan($value);

		/**
		 * Checks if the object is less than or equal to the specified value
		 * @param mixed $value The value to compare to
		 * @return bool True if less than or equal to the specified value. Else false.
		 */
		public function isLessThanOrEqual($value);
	}