<?php

namespace Gevman\GitHook\GitHub;

use Gevman\GitHook\Repository as BaseRepository;
use Closure;

/**
 * Class Repository
 * @package Gevman\GitHook\BitBucket
 *
 * @method onCommitComment(Closure $handler) - Commit or diff commented on.
 * @method onCreate(Closure $handler) - Branch or tag created.
 * @method onDelete(Closure $handler) - Branch or tag deleted.
 * @method onDeployment(Closure $handler) - Repository deployed.
 * @method onDeploymentStatus(Closure $handler) - Deployment status updated from the API.
 * @method onFork(Closure $handler) - Repository forked.
 * @method onGollum(Closure $handler) - Wiki page updated.
 * @method onIssueComment(Closure $handler) - Issue comment created, edited, or deleted.
 * @method onIssues(Closure $handler) - Issue opened, edited, closed, reopened, assigned, unassigned, labeled, unlabeled, milestoned, or demilestoned.
 * @method onLabel(Closure $handler) - Label created or deleted.
 * @method onMember(Closure $handler) - Collaborator added to a repository.
 * @method onMilestone(Closure $handler) - Milestone created, closed, opened, edited, or deleted.
 * @method onPageBuild(Closure $handler) - Pages site built.
 * @method onPrivateToPublic(Closure $handler) - Repository changes from private to public.
 * @method onPullRequest(Closure $handler) - Pull request opened, closed, reopened, edited, assigned, unassigned, labeled, unlabeled, or synchronized.
 * @method onPullRequestReview(Closure $handler) - Pull request review submitted.
 * @method onPullRequestReviewComment(Closure $handler) - Pull request diff comment created, edited, or deleted.
 * @method onPush(Closure $handler) - Git push to a repository.
 * @method onRelease(Closure $handler) - Release published in a repository.
 * @method onStatus(Closure $handler) - Commit status updated from the API.
 * @method onTeamAdd(Closure $handler) - Team added or modified on a repository.
 * @method onWatch(Closure $handler) - User stars a repository.
 */
class Repository extends BaseRepository
{
	public function __construct()
	{
		parent::__construct(EventHandler::class);
	}
}