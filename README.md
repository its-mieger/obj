# ItsMieger Obj - Native data type behavior for PHP objects
This library helps to implement behavior like native data types (casts, comparision, conversion, operator overloading ...) for custom
PHP objects.

Since PHP does not support operator overloading, custom helper functions are implemented to apply
operations using the implemented behavior.

Following interfaces are available:

| Interface			  	| Purpose |
| :------------------ 	| :----------------------------------------------------- |
| Comparable        	| Object can be compared with others (overrides comparision operators)  |
| CastsAsBoolean        | Object can be represented as boolean                   |
| CastsAsFloat	        | Object can be represented as float                     |
| CastsAsInteger        | Object can be represented as integer                   |
| CastsAsString         | Object can be represented as string                    |
| OperatorAdd           | Object implements custom add operator                  |
| OperatorSubtract      | Object implements custom subtract operator             |
| OperatorMultiply      | Object implements custom multiply operator             |
| OperatorDivide        | Object implements custom divide operator               |
| Nullable              | Object can represent null             				 |


## Helper functions
Since PHP does not support operator overloading special helper functions must be used to make
objects behave as implemented by the specified interfaces. However helper functions are not
autoloaded but may be imported by calling `Obj::loadHelpers()`. If not loaded, the helpers
may be called using the static methods of the `Obj`-class

| Native operator | Helper function | Call without helper function |
| ----------------| --------------- | ----------------------------- |
| `==`				| `o_eq`		| `Obj::equal(...)`			|
| `!=`				| `o_ne`		| `Obj::notEqual(...)`			|
| `<=>`				| `o_comp`		| `Obj::compare(...)`			|
| `<`				| `o_lt`		| `Obj::lessThan(...)`			|
| `<=`				| `o_le`		| `Obj::lessThanOrEqual(...)`			|
| `>`				| `o_gt`		| `Obj::greaterThan(...)`			|
| `>=`				| `o_ge`		| `Obj::greaterThanOrEqual(...)`			|
| `+`				| `o_add`		| `Obj::add(...)`			|
| `-`				| `o_sub`		| `Obj::subtract(...)`			|
| `*`				| `o_mul`		| `Obj::multiply(...)`			|
| `/`				| `o_div`		| `Obj::divide(...)`			|

## Behavior
Using one of the object helper functions, objects behave like native data types would do for the
corresponding native operator.

Example:

	class MyInt implements CastsAsInteger {
	 	
	 	public function toInt(): int {
	 		return 3;
	 	}
	 	
	}
	$a = new MyInt();
	
	$result = op_add($a, 2);

In this example `$result` will be `5`. Adding an integer to the object will call the `toInt()`-function
to cast the object as integer and than execute the operation.

**Important** You should not implement more than one `CastsAs`*-interface in one class. Of you would
do the object might behave unexpected since in some situations it might be converted eg. to `int` and in
others to `float`. Rather than implementing both interface, you should only implement eg. `int`. If a float
value is required, the returned int value is casted to `float` automatically.

### Overriding operators
Sometimes casting objects is not enough. Imagine a custom Money implementation where you want to add
two Money objects and want to receive a new Money object instead of a scalar number. Therefore
you may implement one of the `Operator`*-interfaces and define your custom operator.

#### How operators are applied
Sometimes it is not obvious which operator function is called. Especially if having two objects implementing the
same operator. The behavior described below concerns the `Operator`*-interfaces as well as the `Comparable`-interface
which overrides all comparision operators with one function:

* If both implement the operator interface, the operator function is invoked for the descended object if the objects are descendants.
If objects are not descendants, the operator function is invoked for the left side object.

* If only one implements the Operator interface, the operator function is invoked for the corresponding object.

* If none implements the operator interface the objects are converted to their native representation
and the native operator is applied.

## Testing
You may mock helpers by creating a mock object for the `ObjectHelper`-class and pass it to
`Obj::mock(...)`. This way all calls to object helpers (via helper functions or static interface)
are redirected to the mocked object. Call `Obj::resetMock()` to remove the mocked object und make
object logic be used again.