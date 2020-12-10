<?php

	namespace ItsMieger\Obj;


	/**
	 * Static interface for object helper functions
	 * @method mixed cast($value, string $type) static Casts a value to a specified type if possible
	 * @method bool equalsNull($value) static Checks if a value equals null
	 * @method int compare($a, $b) static Compares two objects
	 * @method mixed add($a, $b) static Adds two values
	 * @method mixed subtract($a, $b) static Subtracts two values
	 * @method mixed multiply($a, $b) static Multiplies two values
	 * @method mixed divide($a, $b) static Divides a value by another value
	 * @method bool equal($a, $b) static Checks if two values are equal
	 * @method bool notEqual($a, $b) static Checks if two values are not equal
	 * @method bool greaterThan($a, $b) static Checks if a value is greater than another value
	 * @method bool greaterThanOrEqual($a, $b) static Checks if a value is greater than or equal to another value
	 * @method bool lessThan($a, $b) static Checks if a value is less than another value
	 * @method bool lessThanOrEqual($a, $b) static Checks if a value is less than or equal to another value
	 * @method bool isNull($value) static Checks if a value represents null
	 * @method bool isInt($value) static Checks if a value is an integer or casts as integer
	 * @method bool isFloat($value) static Checks if a value is a float or casts as float
	 * @method bool isBool($value) static Checks if a value is a boolean or casts as boolean
	 * @method float castFloat($value) static Casts the value as float
	 * @method int castInt($value) static Casts the value as integer
	 * @method bool castBool($value) static Casts the value as boolean
	 * @method string castString($value) static Casts the value as string
	 * @method int comparePipe(...$comparisons) static Executes multiples comparisons in a pipeline. The pipeline exits immediately if a step does not return 0. This function helps to check multiple criteria.
	 * @package ItsMieger\Obj
	 */
	class Obj
	{
		protected static $singleton;

		/**
		 * Returns the singleton instance
		 * @return ObjectHelper The singleton instance
		 */
		public static function singleton() {
			if (!self::$singleton)
				self::$singleton = new ObjectHelper();

			return self::$singleton;
		}

		/**
		 * Replaces the singleton instance with a mocked instance
		 * @param object $instance The mocked instance
		 */
		public static function mock($instance) {
			self::$singleton = $instance;
		}

		/**
		 * Resets the singleton instance from mocked instance.
		 */
		public static function resetMock() {
			self::$singleton = null;
		}

		/**
		 * Loads the helper functions
		 */
		public static function loadHelpers() {
			require_once __DIR__ . '/helpers.php';
		}

		public static function __callStatic($name, $arguments) {

			// forward call to the singleton instance
			return self::singleton()->{$name}(...$arguments);
		}


	}