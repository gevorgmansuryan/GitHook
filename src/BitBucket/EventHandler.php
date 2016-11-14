<?php

namespace Gevman\GitHook\BitBucket;

use Closure;
use Gevman\GitHook\EventHandler as BaseEventHandler;

class EventHandler extends BaseEventHandler
{
	public function add($event, Closure $function)
	{
		$events = [
			'repo:push' => 'onPush',
			'repo:fork' => 'onFork',
			'repo:updated' => 'onUpdated',
			'repo:commit_comment_created' => 'onCommitCommentCreated',
			'repo:commit_status_created' => 'onBuildStatusCreated',
			'repo:commit_status_updated' => 'onBuildStatusUpdated',
			'issue:created' => 'onIssueCreated',
			'issue:updated' => 'onIssueUpdated',
			'issue:comment_created' => 'onIssueCommentCreated',
			'pullrequest:created' => 'onPullRequestCreated',
			'pullrequest:updated' => 'onPullRequestUpdated',
			'pullrequest:approved' => 'onPullRequestApproved',
			'pullrequest:unapproved' => 'onPullRequestApprovalRemoved',
			'pullrequest:fulfilled' => 'onPullRequestMerged',
			'pullrequest:rejected' => 'onPullRequestDeclined',
			'pullrequest:comment_created' => 'onPullRequestCommentCreated',
			'pullrequest:comment_updated' => 'onPullRequestCommentUpdated',
			'pullrequest:comment_deleted' => 'onPullRequestCommentDeleted',
		];
		if ($this->event && $events[$this->event] == $event) {
			$this->handle($function);
		}
	}
}