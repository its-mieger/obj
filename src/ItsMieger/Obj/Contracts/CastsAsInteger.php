<?php
	/**
	 * Created by PhpStorm.
	 * User: chris
	 * Date: 14.02.18
	 * Time: 10:22
	 */

	namespace ItsMieger\Obj\Contracts;


	interface CastsAsInteger
	{
		/**
		 * Casts the object as integer
		 * @return int The integer representation of the object
		 */
		public function toInt(): int;
	}