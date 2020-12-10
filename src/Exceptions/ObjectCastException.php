<?php

	namespace ItsMieger\Obj\Exceptions;


	class ObjectCastException extends \Exception
	{

		protected $objectType;
		protected $castType;

		/**
		 * ObjectCastException constructor.
		 * @param string $objectType The object type
		 * @param string $castType The type to which the object should be casted
		 * @param string $message The message
		 */
		public function __construct(string $objectType, string $castType, string $message = '') {
			$this->objectType = $objectType;
			$this->castType   = $castType;

			if (!$message)
				$message = 'Could not cast "' . $objectType . '" to ' . $castType;

			parent::__construct($message);
		}

		/**
		 * @return string
		 */
		public function getObjectType(): string {
			return $this->objectType;
		}

		/**
		 * @return string
		 */
		public function getCastType(): string {
			return $this->castType;
		}


	}