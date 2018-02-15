<?php
	/**
	 * Created by PhpStorm.
	 * User: chris
	 * Date: 14.02.18
	 * Time: 10:17
	 */

	namespace ItsMieger\Obj\Contracts;


	interface CastsAsBoolean
	{
		/**
		 * Casts the object as boolean
		 * @return bool The boolean representation of the object
		 */
		public function toBoolean(): bool;
	}