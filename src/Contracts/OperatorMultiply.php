<?php
	/**
	 * Created by PhpStorm.
	 * User: chris
	 * Date: 14.02.18
	 * Time: 09:47
	 */

	namespace ItsMieger\Obj\Contracts;


	use ItsMieger\Obj\Exceptions\InvalidOperandException;

	interface OperatorMultiply
	{
		/**
		 * Multiplies a value to the object and returns the result as new instance
		 * @param mixed $value
		 * @throws InvalidOperandException
		 * @return mixed The result
		 */
		public function _operator_multiply($value);
	}