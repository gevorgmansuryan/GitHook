<?php

namespace Gevman\GitHook;

use Closure;

interface EventHandlerInterface
{
	public function add($event, Closure $function);
}