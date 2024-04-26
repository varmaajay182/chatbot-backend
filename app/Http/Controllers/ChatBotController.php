<?php

namespace App\Http\Controllers;

use Gemini\Laravel\Facades\Gemini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatBotController extends Controller
{
    public function generateResponse(Request $request)
    {
        Log::info('message: ');
        try {
            $message = $request->input('message');
            if ($message === null) {
                throw new \InvalidArgumentException('Message cannot be null');
            }
            $result = Gemini::geminiPro()->generateContent($message);
            $answer = $result->text();
            // Log::info('message: ' . $answer);
            return response()->json(['status' => true, 'answer' => $answer]);

        } catch (\Exception $e) {
            Log::error('Error processing message: ' . $e->getMessage());
            return response()->json(['status' => false, 'error' => 'Failed to send message'], 500);
        }

    }
    
    public function testData()
    {
        try {
          
            $result = Gemini::geminiPro()->generateContent('What is Laravel');
            $answer = $result->text();
            
            return response()->json(['status' => true, 'answer' => $answer]);

        } catch (\Exception $e) {
            Log::error('Error processing message: ' . $e->getMessage());
            return response()->json(['status' => false, 'error' => 'Failed to send message'], 500);
        }

    }
}
