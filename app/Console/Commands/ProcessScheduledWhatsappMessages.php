<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ScheduledWhatsappMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\WhatsAppController;

class ProcessScheduledWhatsappMessages extends Command
{
    protected $signature = 'whatsapp:process-scheduled';
    protected $description = 'Send WhatsApp messages that are scheduled after a delay';

    public function handle()
    {
        $messages = ScheduledWhatsappMessage::where('is_sent', false)
            ->where('send_after', '<=', now())
            ->where('dynamic_id', 7)
            ->get();

        foreach ($messages as $msg) {
            try {
                $request = new Request([
                    'phone' => $msg->phone,
                    'message' => $msg->message,
                    'name' => $msg->name,
                    'id' => $msg->dynamic_id, // <-- DYNAMIC ID
                ]);

                $controller = new WhatsAppController();
                $controller->sendMessage($request);

                $msg->is_sent = true;
                $msg->save();

                $this->info("WhatsApp sent to {$msg->phone}");
            } catch (\Exception $e) {
                $this->error("Failed to send message to {$msg->phone}: {$e->getMessage()}");
            }
        }
    }
}
