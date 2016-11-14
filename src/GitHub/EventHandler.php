<?php

namespace Gevman\GitHook\GitHub;

use Closure;
use Gevman\GitHook\EventHandler as BaseEventHandler;

class EventHandler extends BaseEventHandler
{
	public function add($event, Closure $function)
	{
		$events = [
			'commit_comment' => 'onCommitComment',
			'create' => 'onCreate',
			'delete' => 'onDelete',
			'deployment' => 'onDeployment',
			'deployment_status' => 'onDeploymentStatus',
			'fork' => 'onFork',
			'gollum' => 'onGollum',
			'issue_comment' => 'onIssueComment',
			'issues' => 'onIssues',
			'label' => 'onLabel',
			'member' => 'onMember',
			'milestone' => 'onMilestone',
			'page_build' => 'onPageBuild',
			'public' => 'onPrivateToPublic',
			'pull_request_review_comment' => 'onPullRequestReviewComment',
			'pull_request_review' => 'onPullRequestReview',
			'pull_request' => 'onPullRequest',
			'push' => 'onPush',
			'release' => 'onRelease',
			'status' => 'onStatus',
			'team_add' => 'onTeamAdd',
			'watch' => 'onWatch',
		];
		if ($this->event && $events[$this->event] == $event) {
			$this->handle($function);
		}
	}
}