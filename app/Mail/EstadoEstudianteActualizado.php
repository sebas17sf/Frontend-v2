<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EstadoEstudianteActualizado extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;  // Agrega esta propiedad para aceptar el usuario en el constructor

    /**
     * Create a new message instance.
     *
     * @param  array  $usuario
     * @return void
     */
    public function __construct($usuario)
    {
        $this->usuario = $usuario;  // Asigna el usuario a la propiedad
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Estudiante Aprobado',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.estado_estudiante_actualizado',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
