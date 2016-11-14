<?php

namespace Gevman\GitHook;

use Gevman\GitHook\GitHub\Repository as GitHubRepository;
use Gevman\GitHook\BitBucket\Repository as BitBucketRepository;

class Request
{
	private $type;
	private $event;
	private $payload;

	public function __construct($repo, $secret = null)
	{
		if ($repo instanceof GitHubRepository) {
			$this->type = Repository::GitHub;
		}
		if ($repo instanceof BitBucketRepository) {
			$this->type = Repository::BitBucket;
		}
		$this->payload = !empty($_POST['payload']) ? $_POST['payload'] : file_get_contents("php://input");

		if ($this->type == Repository::GitHub && isset($_SERVER['HTTP_X_GITHUB_EVENT'])) {
			$this->event = $_SERVER['HTTP_X_GITHUB_EVENT'];
			if ($secret && hash_hmac('sha1', $this->payload, $secret) != str_replace('sha1=', '', $_SERVER['HTTP_X_HUB_SIGNATURE'])) {
				$this->event = null;
			}
		}
		if ($this->type == Repository::BitBucket && isset($_SERVER['HTTP_X_EVENT_KEY'])) {
			$this->event = $_SERVER['HTTP_X_EVENT_KEY'];
		}
	}

	public function isOk()
	{
		return (strtolower($_SERVER['REQUEST_METHOD']) == 'post' && $this->payload && $this->event);
	}

	public function getPayload()
	{
		return json_decode($this->payload, true);
	}

	public function getEventType()
	{
		return $this->event;
	}
}