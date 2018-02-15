<?php

	namespace ItsMieger\Obj\Traits;


	use ItsMieger\Obj\Obj;

	trait ObjectArithmetic
	{
		/**
		 * Adds a value to the object and returns the result value
		 * @param mixed $value The value to add
		 * @return mixed|static|self The result
		 */
		public function add($value) {
			return Obj::singleton()->add($this, $value);
		}

		/**
		 * Subtracts a value from the object and returns the result value
		 * @param mixed $value The value to subtract
		 * @return mixed|static|self The result
		 */
		public function subtract($value) {
			return Obj::singleton()->subtract($this, $value);
		}

		/**
		 * Multiplies the object with a value and returns the result value
		 * @param mixed $value The value to multiply
		 * @return mixed|static|self The result
		 */
		public function multiply($value) {
			return Obj::singleton()->multiply($this, $value);
		}

		/**
		 * Divdes the object by a value and returns the result value
		 * @param mixed $value The value to divide by
		 * @return mixed|static|self The result
		 */
		public function divide($value) {
			return Obj::singleton()->divide($this, $value);
		}
	}