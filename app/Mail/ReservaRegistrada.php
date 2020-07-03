<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservaRegistrada extends Mailable
{
    use Queueable, SerializesModels;

    

    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->booking = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        setlocale(LC_TIME, 'es_CO.utf8'); // Locale para cambiar el lenguaje a español
        
        return $this->from([
                        'address' => 'no-reply@appgenda.local',
                        'name' => 'Appgenda',
                    ])
                    ->subject($this->booking['service'] . ' para ' . strftime('%A %e %B',strtotime($this->booking['date'])))
                    ->view('emails.reserva-registrada');
    }
}
