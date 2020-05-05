<?php

declare(strict_types=1);

namespace Webloyer\Infra\Notification\Laravel;

use Webloyer\Domain\Model\Deployment;
use Webloyer\Domain\Model\Project;

class DeploymentWasCompletedNotificationDto implements Deployment\DeploymentInterest, Project\ProjectInterest
{
    /**
     * @param string $projectId
     * @return void
     */
    public function informProjectId(string $projectId): void
    {
        $this->projectId = $projectId;
    }

    /**
     * @param int $number
     * @return void
     */
    public function informNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * @param string $task
     * @return void
     */
    public function informTask(string $task): void
    {
        $this->task = $task;
    }

    /**
     * @param string $status
     * @return void
     */
    public function informStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @param string $log
     * @return void
     */
    public function informLog(string $log): void
    {
        $this->log = $log;
    }

    /**
     * @param string $executor
     * @return void
     */
    public function informExecutor(string $executor): void
    {
        $this->executor = $executor;
    }

    public function informCompletionDate(?string $completionDate): void
    {
        $this->completionDate = $completionDate;
    }

    /**
     * @param string $id
     * @return void
     */
    public function informId(string $id): void
    {
    }

    /**
     * @param string $name
     * @return void
     */
    public function informName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string ...$recipeIds
     * @return void
     */
    public function informRecipeIds(string ...$recipeIds): void
    {
    }

    /**
     * @param string $serverId
     * @return void
     */
    public function informServerId(string $serverId): void
    {
    }

    /**
     * @param string $repositoryUrl
     * @return void
     */
    public function informRepositoryUrl(string $repositoryUrl): void
    {
    }

    /**
     * @param string $stageName
     * @return void
     */
    public function informStageName(string $stageName): void
    {
    }

    /**
     * @param string|null $deployPath
     * @return void
     */
    public function informDeployPath(?string $deployPath): void
    {
    }

    /**
     * @param string|null $emailNotificationRecipient
     * @return void
     */
    public function informEmailNotificationRecipient(?string $emailNotificationRecipient): void
    {
        $this->email = $emailNotificationRecipient;
    }

    /**
     * @param int|null $deploymentKeepDays
     * @return void
     */
    public function informDeploymentKeepDays(?int $deploymentKeepDays): void
    {
    }

    /**
     * @param bool $keepLastDeployment
     * @return void
     */
    public function informKeepLastDeployment(bool $keepLastDeployment): void
    {
    }

    /**
     * @param int|null $deploymentKeepMaxNumber
     * @return void
     */
    public function informDeploymentKeepMaxNumber(?int $deploymentKeepMaxNumber): void
    {
    }

    /**
     * @param string|null $githubWebhookSecret
     * @return void
     */
    public function informGithubWebhookSecret(?string $githubWebhookSecret): void
    {
    }

    /**
     * @param string|null $githubWebhookExecutor
     * @return void
     */
    public function informGithubWebhookExecutor(?string $githubWebhookExecutor): void
    {
    }
}
