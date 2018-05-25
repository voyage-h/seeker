<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Event;
use App\Events\NotificationEvent;
use Auth;

class AnswerQuestionNotification extends Notification
{
    use Queueable;
    public $answer;
    public $question;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($answer)
    {
        $this->answer = $answer;
        $this->question = $answer->question;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }
    public function toDatabase($notifiable)
    {
        return [
                'user'=> [
                    'name' => Auth::user()->name,
                    'id' => Auth::id()
                ],
                'question' => [
                    'id' => $this->question->id,
                    'title' => $this->question->title
                ],
                'answer' => $this->answer->id,
                'note' => '回答了问题',
            ];
    }
}
