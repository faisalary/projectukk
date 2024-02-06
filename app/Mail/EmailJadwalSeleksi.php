<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\email_template;
use Illuminate\Http\Request;

class EmailJadwalSeleksi extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subjek;
    // public $pathToFile;

    /**
     * Create a new message instance.
     * 
     * @return void
     */
    public function __construct($user,$subjek)
    {
        $this->user = $user;
        $this->subjek = $subjek;
    }

    /**
     * Get the message envelope.
     * @return $this
     */
    public function build(Request $request)
    {
        $email = email_template::where('id_email_template', $request->subjek)->first();
        return $this->subject($this->subjek)
                    ->view('email.email_jadwalseleksi');
    }
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Email Jadwal Seleksi',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
