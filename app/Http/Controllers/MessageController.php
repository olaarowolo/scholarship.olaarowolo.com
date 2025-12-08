<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller
{
    // Fetch messages for the logged-in user
    public function tray()
    {
        $user = Auth::user();
        $messages = Message::where('receiver_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($messages);
    }
}
