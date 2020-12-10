<?php
	/**
	 * Created by PhpStorm.
	 * User: chris
	 * Date: 14.02.18
	 * Time: 09:35
	 */

	namespace ItsMieger\Obj\Contracts;


	interface CastsAsFloat
	{
		/**
		 * Casts the object as float
		 * @return float The float representation of the object
		 */
		public function toFloat(): float;
	}