<?php

namespace Gevman\GitHook;

use Closure;

abstract class EventHandler implements EventHandlerInterface
{
	protected $event;
	protected $payload;

	public function __construct(Request $request)
	{
		if ($request->isOk()) {
			$this->event = $request->getEventType();
			$this->payload = $request->getPayload();
		}
	}

	protected function handle(Closure $function)
	{
		$function($this->payload);
	}
}