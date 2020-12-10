<?php
	/**
	 * Created by PhpStorm.
	 * User: chris
	 * Date: 14.02.18
	 * Time: 19:44
	 */

	namespace ItsMieger\Obj\Contracts;


	interface CastsAsString
	{
		/**
		 * Casts the object as string
		 * @return string The string representation of the object
		 */
		public function toString(): string;
	}