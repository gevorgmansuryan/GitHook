# Git Hook

works with GitHub and BitBucket webHooks

##Installation (using composer)

```bash
composer require gevman/git-hook
```

###GitHub Events 	(for more info take a look at [Official Github Documentation](https://developer.github.com/webhooks/))

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

######automatically `git pull` on your server after every push

```php
require __DIR__.'/../vendor/autoload.php';

$gitHubRepo = new Gevman\GitHook\GitHub\Repository();

$gitHubRepo->onPush(function() {
    exec('cd /path/to/your/project && git pull');
});
```

######notify your team in Slack about `Pull request`
(I suggest use [gevman/slack-bot](https://packagist.org/packages/gevman/slack-bot))
```php
require __DIR__.'/../vendor/autoload.php';

$gitHubRepo = new Gevman\GitHook\GitHub\Repository();
$slackBot = new Gevman\SlackBot\IncomingBot('YOUR_SLACK_HOOK_URL');

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