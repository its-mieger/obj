<?php
	/**
	 * Created by PhpStorm.
	 * User: chris
	 * Date: 14.02.18
	 * Time: 09:48
	 */

	namespace ItsMieger\Obj\Contracts;


	use ItsMieger\Obj\Exceptions\InvalidOperandException;

	interface OperatorDivide
	{
		/**
		 * Divides the object by a specified value and returns the result as new instance
		 * @param mixed $value
		 * @throws InvalidOperandException
		 * @return mixed The result
		 */
		public function _operator_divide($value);
	}