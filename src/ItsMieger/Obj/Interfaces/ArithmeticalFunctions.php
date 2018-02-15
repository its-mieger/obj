<?php

	namespace ItsMieger\Obj\Interfaces;


	use ItsMieger\Obj\Contracts\OperatorAdd;
	use ItsMieger\Obj\Contracts\OperatorDivide;
	use ItsMieger\Obj\Contracts\OperatorMultiply;
	use ItsMieger\Obj\Contracts\OperatorSubtract;

	interface ArithmeticalFunctions extends OperatorAdd, OperatorSubtract, OperatorMultiply, OperatorDivide
	{
		/**
		 * Adds a value to the object and returns the result value
		 * @param mixed $value The value to add
		 * @return mixed|static|self The result
		 */
		public function add($value);

		/**
		 * Subtracts a value from the object and returns the result value
		 * @param mixed $value The value to subtract
		 * @return mixed|static|self The result
		 */
		public function subtract($value);

		/**
		 * Multiplies the object with a value and returns the result value
		 * @param mixed $value The value to multiply
		 * @return mixed|static|self The result
		 */
		public function multiply($value);

		/**
		 * Divdes the object by a value and returns the result value
		 * @param mixed $value The value to divide by
		 * @return mixed|static|self The result
		 */
		public function divide($value);
	}