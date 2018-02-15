<?php

	namespace ItsMieger\Obj\Contracts;


	use ItsMieger\Obj\Exceptions\InvalidOperandException;

	interface OperatorSubtract
	{
		/**
		 * Subtracts a value from the object and returns the result as new instance
		 * @param mixed $value
		 * @throws InvalidOperandException
		 * @return mixed The result
		 */
		public function _operator_subtract($value);
	}