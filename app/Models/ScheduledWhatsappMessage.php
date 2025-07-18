<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduledWhatsappMessage extends Model
{
    protected $fillable = [
        'phone',
        'message',
        'name',
        'orderid',
        'price',
        'dynamic_id',
        'send_after',
        'is_sent',
    ];
}
