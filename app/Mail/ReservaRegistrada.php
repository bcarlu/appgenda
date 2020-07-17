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

    
    public function __construct($data)
    {
        // Se almacenan los datos que vienen desde el controlador en la propiedad publica booking para manipularla en la vista
        $this->booking = $data;
    }

    
    public function build()
    {
        setlocale(LC_TIME, 'es_CO.utf8'); // Locale para cambiar el lenguaje a español

        // Se define remitente y asunto y se envia a la vista reserva-registrada
        return $this->from('no-reply@appgenda.local','Appgenda')
                    ->subject($this->booking['service'] . ' para ' . strftime('%A %e %B',strtotime($this->booking['date'])))
                    ->view('emails.reserva-registrada');
    }
}
