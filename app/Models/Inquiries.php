<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Inquiries extends Model
{
    use Notifiable;

    /**
     * Route notifications for the mail channel.
     *
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @return array|string
     */
    public function routeNotificationForMail( $notification )
    {
        return [ config( 'app.recipient_notification.email' ) => config( 'app.recipient_notification.name' ) ];
    }
}
