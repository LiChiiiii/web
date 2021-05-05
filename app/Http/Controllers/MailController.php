<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\Post;
use App\Models\Monitor;

class MailController extends Controller
{
  

    public function computer_index(string $computer_id)
    {
        $computer = Post::find($computer_id);

        $details = [
            'email' => 'joycem45@gmail.com',
            'subject' => 'Test Mail From Lichi Kao',
            'title' => 'Computer',
            'content' => 'This is for testing mail using gmail. ',
            'asset_num' => $computer->asset_num,
        ];

        return response()->json($details);
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required',
            'content' => 'required',
          ]);

        $details = [
            'email' => $request->email,
            'subject' => $request->subject,
            'title' => $request->title,
            'content' => $request->content,
        ];

        Mail::send('emails.MailTemplate', $details, function($message) use ($details) {
            $message->to($details['email'])
            ->subject($details['subject']);
          });
        
        return response()->json(['success'=>'成功寄出']);
    }

    
    public function monitor_index(string $monitor_id)
    {
        $monitor = Monitor::find($monitor_id);

        $details = [
            'email' => 'joycem45@gmail.com',
            'subject' => 'Test Mail From Lichi Kao',
            'title' => 'Monitor',
            'content' => 'This is for testing mail using gmail. ',
            'snid' => $monitor->snid,
        ];

        return response()->json($details);
    }

    
}
