# Git Hook

works with GitHub and BitBucket webHooks

##Installation (using composer)

```bash
composer require gevman/git-hook
```

###GitHub Events 	(for more info take a look at [Official GitHub Documentation](https://developer.github.com/webhooks/))

- `onCommitComment` - Commit or diff commented on.
- `onCreate` - Branch or tag created.
- `onDelete` - Branch or tag deleted.
- `onDeployment` - Repository deployed.
- `onDeploymentStatus` - Deployment status updated from the API.
- `onFork` - Repository forked.
- `onGollum` - Wiki page updated.
- `onIssueComment` - Issue comment created, edited, or deleted.
- `onIssues` - Issue opened, edited, closed, reopened, assigned, unassigned, labeled, unlabeled, milestoned, or demilestoned.
- `onLabel` - Label created or deleted.
- `onMember` - Collaborator added to a repository.
- `onMilestone` - Milestone created, closed, opened, edited, or deleted.
- `onPageBuild` - Pages site built.
- `onPrivateToPublic` - Repository changes from private to public.
- `onPullRequest` - Pull request opened, closed, reopened, edited, assigned, unassigned, labeled, unlabeled, or synchronized.
- `onPullRequestReview` - Pull request review submitted.
- `onPullRequestReviewComment` - Pull request diff comment created, edited, or deleted.
- `onPush` - Git push to a repository.
- `onRelease` - Release published in a repository.
- `onStatus` - Commit status updated from the API.
- `onTeamAdd` - Team added or modified on a repository.
- `onWatch` - User stars a repository.

####Examples

######Example #1
automatically `git pull` on your server after every push

```php
require __DIR__.'/vendor/autoload.php';

$gitHubRepo = new \Gevman\GitHook\GitHub\Repository();

$gitHubRepo->onPush(function() {
    exec('cd /path/to/your/project && git pull');
});
```

######Example #2
notify your team in Slack about `Pull request`

(I suggest use [gevman/slack-bot](https://packagist.org/packages/gevman/slack-bot) ☺)
```php
require __DIR__.'/vendor/autoload.php';

$gitHubRepo = new \Gevman\GitHook\GitHub\Repository();
$slackBot = new \Gevman\SlackBot\IncomingBot('YOUR_SLACK_HOOK_URL');

$gitHubRepo->onPullRequest(function($payload) use ($slackBot) {
    $message = sprintf(
        '%s just %s pull request: `%s`',
        $payload['pull_request']['user']['login'],
        $payload['action'],
        $payload['pull_request']['title']
    );
    
    $slackBot->send($message)
        ->withIcon('https://assets-cdn.github.com/images/modules/logos_page/GitHub-Mark.png')
        ->to('general');
});
```

###BitBucket Events 	(for more info take a look at [Official BitBucket Documentation](https://confluence.atlassian.com/bitbucket/event-payloads-740262817.html))

- `onPush` - A user pushes 1 or more commits to a repository.
- `onFork` - A user forks a repository.
- `onUpdated` - A user updates the Name, Description, Website, or Language fields under the Repository details page of the repository settings.
- `onCommitCommentCreated` - A user comments on a commit in a repository.
- `onBuildStatusCreated` - A build system, CI tool, or another vendor recognizes that a user recently pushed a commit and updates the commit with its status.
- `onBuildStatusUpdated` - A build system, CI tool, or another vendor recognizes that a commit has a new status and updates the commit with its status.
- `onIssueCreated` - A user creates an issue for a repository.
- `onIssueUpdated` - A user updated an issue for a repository.
- `onIssueCommentCreated` - A user comments on an issue associated with a repository.
- `onPullRequestCreated` - A user creates a pull request for a repository.
- `onPullRequestUpdated` - A user updates a pull request for a repository.
- `onPullRequestApproved` - A user approves a pull request for a repository.
- `onPullRequestApprovalRemoved` - A user removes an approval from a pull request for a repository.
- `onPullRequestMerged` - A user merges a pull request for a repository.
- `onPullRequestDeclined` - A user declines a pull request for a repository.
- `onPullRequestCommentCreated` - A user comments on a pull request.
- `onPullRequestCommentUpdated` - A user updates a comment on a pull request.
- `onPullRequestCommentDeleted` - A user deletes a comment on a pull request.

####Examples

######Example #1
automatically `git pull` on your server after every push

```php
require __DIR__.'/vendor/autoload.php';

$bitBucketRepo = new \Gevman\GitHook\BitBucket\Repository();

$bitBucketRepo->onPush(function() {
    exec('cd /path/to/your/project && git pull');
});
```

######Example #2
notify your team in Slack about `Pull request`

(I suggest use [gevman/slack-bot](https://packagist.org/packages/gevman/slack-bot) ☺)
```php
require __DIR__.'/vendor/autoload.php';

$bitBucketRepo = new \Gevman\GitHook\BitBucket\Repository();
$slackBot = new \Gevman\SlackBot\IncomingBot('YOUR_SLACK_HOOK_URL');

$notifier = function($action) use ($slackBot) {
    return function($payload) use ($action, $slackBot) {
        $message = sprintf(
            '%s just %s pull request: `%s`',
            $payload['actor']['display_name'],
            $action,
            $payload['pullrequest']['title']
        );
        $slackBot->send($message)
            ->withIcon('https://wac-cdn.atlassian.com/assets/img/icons/logo/bitbucket_rgb_blue.svg')
            ->to('general');
    };
};

$bitBucketRepo->onPullRequestApproved($notifier('Approved'))
    ->onPullRequestApprovalRemoved($notifier('ApprovalRemoved'))
    ->onPullRequestCreated($notifier('Created'))
    ->onPullRequestMerged($notifier('Merged'))
    ->onPullRequestUpdated($notifier('Updated'));
```