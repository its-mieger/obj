<?php


	namespace ItsMieger\Obj\Traits;


	use ItsMieger\Obj\Obj;

	trait ComparesSelf
	{
		/**
		 * Compares the object to an other value
		 * @param mixed $value The value to compare to
		 * @return int 0 if equals value. -1 if less than value. 1 if greater than value.
		 */
		public abstract function compareTo($value): int;


		/**
		 * Checks if the object equals the specified value
		 * @param mixed $value The value to compare to
		 * @return bool True if equals. Else false.
		 */
		public function equals($value) {
			return Obj::singleton()->equal($this, $value);
		}

		/**
		 * Checks if the object does not equal the specified value
		 * @param mixed $value The value to compare to
		 * @return bool True if not equals. Else false.
		 */
		public function notEquals($value) {
			return Obj::singleton()->notEqual($this, $value);
		}

		/**
		 * Checks if the object is greater than the specified value
		 * @param mixed $value The value to compare to
		 * @return bool True if greater than the specified value. Else false.
		 */
		public function isGreaterThan($value) {
			return Obj::singleton()->greaterThan($this, $value);
		}

		/**
		 * Checks if the object is greater than or equal to the specified value
		 * @param mixed $value The value to compare to
		 * @return bool True if greater than or equal to the specified value. Else false.
		 */
		public function isGreaterThanOrEqual($value) {
			return Obj::singleton()->greaterThanOrEqual($this, $value);
		}

		/**
		 * Checks if the object is less than the specified value
		 * @param mixed $value The value to compare to
		 * @return bool True if less than the specified value. Else false.
		 */
		public function isLessThan($value) {
			return Obj::singleton()->lessThan($this, $value);
		}

		/**
		 * Checks if the object is less than or equal to the specified value
		 * @param mixed $value The value to compare to
		 * @return bool True if less than or equal to the specified value. Else false.
		 */
		public function isLessThanOrEqual($value) {
			return Obj::singleton()->lessThanOrEqual($this, $value);
		}
	}