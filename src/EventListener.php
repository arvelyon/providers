<?php
/**
 * This file is a part of arvelyon providers, for about license please read LICENSE file
 * @author    Michael M Langitan <michaelmlangitan@gmail.com>
 * @copyright 2018
 */

namespace Arvelyon\Providers;


class EventListener
{
	private $events = [];
	private $sorted = [];

	function onEvent($name, $callable, $acceptArgs = 0, $priority = 5)
	{
		if(!is_callable($callable)){
			throw new \InvalidArgumentException(sprintf('Expected callable type to set %s event listener.', $name));
		}

		$this->events[$name][$priority][$this->getCallableKey($callable)] = [
			'callable'=>$callable,
			'accept_args'=>$acceptArgs
		];

		unset($this->sorted[$name]);
	}

	function doEvent($name)
	{
		if(!isset($this->events[$name])){
			return;
		}

		if(!isset($this->sorted[$name])){
			ksort($this->events[$name]);
			$this->sorted[$name] = true;
		}

		$args = array_slice(func_get_args(), 1);
		reset($this->events[$name]);
		do{
			foreach( (array) current($this->events[$name]) as $event ){
				call_user_func_array( $event['callable'], array_slice( $args, 0, $event['accept_args'] ) );
			}
		}while(false !== next($this->events[$name]));
	}

	function removeEvent($name)
	{
		unset($this->events[$name], $this->sorted[$name]);
	}

	function clear()
	{
		$this->events = [];
		$this->sorted = [];
	}

	private function getCallableKey($callable)
	{
		if(!is_string($callable)){
			$callable = (array) $callable;
			if(is_callable($callable[0]) || is_object($callable[0])){
				return spl_object_hash($callable[0]).(isset($callable[1])?$callable[1]:'');
			}

			return $callable[0].'::'.$callable[1];
		}

		return $callable;
	}
}