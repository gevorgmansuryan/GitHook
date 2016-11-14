<?php

namespace Gevman\GitHook\BitBucket;

use Gevman\GitHook\Repository as BaseRepository;
use Closure;

/**
 * Class Repository
 * @package Gevman\GitHook\BitBucket
 *
 * @method onPush(Closure $handler)
 * @method onFork(Closure $handler)
 * @method onUpdated(Closure $handler)
 * @method onCommitCommentCreated(Closure $handler)
 * @method onBuildStatusCreated(Closure $handler)
 * @method onBuildStatusUpdated(Closure $handler)
 * @method onIssueCreated(Closure $handler)
 * @method onIssueUpdated(Closure $handler)
 * @method onIssueCommentCreated(Closure $handler)
 * @method onPullRequestCreated(Closure $handler)
 * @method onPullRequestUpdated(Closure $handler)
 * @method onPullRequestApproved(Closure $handler)
 * @method onPullRequestApprovalRemoved(Closure $handler)
 * @method onPullRequestMerged(Closure $handler)
 * @method onPullRequestDeclined(Closure $handler)
 * @method onPullRequestCommentCreated(Closure $handler)
 * @method onPullRequestCommentUpdated(Closure $handler)
 * @method onPullRequestCommentDeleted(Closure $handler)
 */
class Repository extends BaseRepository
{
	public function __construct()
	{
		parent::__construct(EventHandler::class);
	}
}