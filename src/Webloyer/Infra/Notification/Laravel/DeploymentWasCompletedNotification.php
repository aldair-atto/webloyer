<?php

declare(strict_types=1);

namespace Webloyer\Infra\Notification\Laravel;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Webloyer\Infra\Notification\Laravel\DeploymentWasCompletedNotificationDto;

class DeploymentWasCompletedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(DeploymentWasCompletedNotificationDto $dto)
    {
        $this->dto = $dto;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = sprintf('Deployment of %s #%s finished: %s',
            $dto->name,
            $dto->number,
            $dto->status,
        );
        $url = route('projects.deployments.show', [
            'project' => $dto->projectId,
            'deployment' => $dto->number,
        ]);

        return (new MailMessage())
            ->subject($subject)
            ->greeting('Hello!')
            ->line('Deploymeny was completed!')
            ->action('Show Deployment', $url)
            ->line('Task: ' . $dto->task)
            ->line('Log: ' . $dto->log)
            ->line('Status: ' . $dto->status)
            ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}