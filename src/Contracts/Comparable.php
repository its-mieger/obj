<?php

	namespace ItsMieger\Obj\Contracts;


	interface Comparable
	{
		/**
		 * Compares the object to an other value
		 * @param mixed $value The value to compare to
		 * @return int 0 if equals value. -1 if less than value. 1 if greater than value.
		 */
		public function compareTo($value) : int;
	}