<?php
require "bootstrap.php";

function testFunction()
{
	echo 'testFunction';
	echo '<br>';
}

class TestClass{
	static function testStatic()
	{
		echo 'method is = '.__METHOD__;
		echo '<br>';
	}

	function testInstanceObject()
	{
		echo 'method is = '.__METHOD__;
		echo '<br>';
	}
}

class StaticOnly{
	static function test()
	{
		echo 'method is = '.__METHOD__;
		echo '<br>';
	}
}

$eventListener = new Arvelyon\Providers\EventListener;

$eventListener->onEvent('test', 'testFunction');
$eventListener->onEvent('test', function (){
	echo 'closure';
	echo '<br>';
});
$eventListener->onEvent('test', function (){
	echo 'closure';
	echo '<br>';
});
$eventListener->onEvent('test', 'TestClass::testStatic');
$eventListener->onEvent('test', [new TestClass, 'testInstanceObject']);
$eventListener->onEvent('stay_on', [StaticOnly::class, 'test']);

echo '<h2>Test Event Listeners</h2>';
$eventListener->doEvent('test');
$eventListener->doEvent('stay_on');

// clear and remove
$eventListener->removeEvent('test');
$eventListener->clear();
