<?php

namespace Gevman\GitHook\BitBucket;

use Gevman\GitHook\Repository as BaseRepository;
use Closure;

/**
 * Class Repository
 * @package Gevman\GitHook\BitBucket
 *
 * @method $this onPush(Closure $handler) - A user pushes 1 or more commits to a repository.
 * @method $this onFork(Closure $handler) - A user forks a repository.
 * @method $this onUpdated(Closure $handler) - A user updates the Name, Description, Website, or Language fields under the Repository details page of the repository settings.
 * @method $this onCommitCommentCreated(Closure $handler) - A user comments on a commit in a repository.
 * @method $this onBuildStatusCreated(Closure $handler) - A build system, CI tool, or another vendor recognizes that a user recently pushed a commit and updates the commit with its status.
 * @method $this onBuildStatusUpdated(Closure $handler) - A build system, CI tool, or another vendor recognizes that a commit has a new status and updates the commit with its status.
 * @method $this onIssueCreated(Closure $handler) - A user creates an issue for a repository.
 * @method $this onIssueUpdated(Closure $handler) - A user updated an issue for a repository.
 * @method $this onIssueCommentCreated(Closure $handler) - A user comments on an issue associated with a repository.
 * @method $this onPullRequestCreated(Closure $handler) - A user creates a pull request for a repository.
 * @method $this onPullRequestUpdated(Closure $handler) - A user updates a pull request for a repository.
 * @method $this onPullRequestApproved(Closure $handler) - A user approves a pull request for a repository.
 * @method $this onPullRequestApprovalRemoved(Closure $handler) - A user removes an approval from a pull request for a repository.
 * @method $this onPullRequestMerged(Closure $handler) - A user merges a pull request for a repository.
 * @method $this onPullRequestDeclined(Closure $handler) - A user declines a pull request for a repository.
 * @method $this onPullRequestCommentCreated(Closure $handler) - A user comments on a pull request.
 * @method $this onPullRequestCommentUpdated(Closure $handler) - A user updates a comment on a pull request.
 * @method $this onPullRequestCommentDeleted(Closure $handler) - A user deletes a comment on a pull request.
 */
class Repository extends BaseRepository
{
	public function __construct()
	{
		parent::__construct(EventHandler::class);
	}
}