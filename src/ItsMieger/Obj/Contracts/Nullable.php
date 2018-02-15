<?php

	namespace ItsMieger\Obj\Contracts;


	interface Nullable
	{
		/**
		 * Returns if the object represents null
		 * @return bool True if represents null. Else false.
		 */
		public function isNull(): bool ;
	}