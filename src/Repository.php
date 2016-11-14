<?php

namespace Gevman\GitHook;

abstract class Repository
{
	/**
	 * @var EventHandler
	 */
	protected $eventHandler;
	protected $request;

	const GitHub = 1;
	const BitBucket = 2;

	public function __construct($eventHandler)
	{
		$this->eventHandler = new $eventHandler(new Request($this));
	}

	public function __call($name, $arguments)
	{
		$this->eventHandler->add($name, $arguments[0]);
	}
}
