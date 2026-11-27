<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Mostrar a página de contactos
    public function index()
    {
        return view('contacts');
    }

    // Enviar mensagem
    public function send(Request $request)
    {
        $request->validate([

            'name' => 'required|min:3|max:100',
            'email' => 'required|email|max:255',
            'subject' => 'required|min:3|max:150',
            'message' => 'required|min:10|max:2000'

        ], [

            'name.required' => 'O nome é obrigatório.',
            'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'name.max' => 'O nome é demasiado longo.',

            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Introduz um email válido.',
            'email.max' => 'O email é demasiado longo.',

            'subject.required' => 'O assunto é obrigatório.',
            'subject.min' => 'O assunto deve ter pelo menos 3 caracteres.',
            'subject.max' => 'O assunto é demasiado longo.',

            'message.required' => 'A mensagem é obrigatória.',
            'message.min' => 'A mensagem deve ter pelo menos 10 caracteres.',
            'message.max' => 'A mensagem não pode ultrapassar 2000 caracteres.'

        ]);

        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $message = $request->message;

        $body = "Nome: " . $name . "\n";
        $body .= "Email: " . $email . "\n\n";
        $body .= "Mensagem:\n" . $message;

        Mail::raw($body, function ($mail) use ($email, $subject) {

            $mail->to(config('mail.from.address'))
                 ->replyTo($email)
                 ->subject('BookStore - ' . $subject);

        });

        if (config('mail.default') == 'log') {

            return redirect()->route('contacts')
                ->with('success', 'Mensagem registada em modo de teste.');
        }

        return redirect()->route('contacts')
            ->with('success', 'Mensagem enviada com sucesso!');
    }
}
