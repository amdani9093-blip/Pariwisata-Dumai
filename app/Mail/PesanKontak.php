<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
 
class PesanKontak extends Mailable
{
    use Queueable, SerializesModels;
 
    public $nama;
    public $emailPengirim;
    public $pesan;
 
    public function __construct($nama, $emailPengirim, $pesan)
    {
        $this->nama = $nama;
        $this->emailPengirim = $emailPengirim;
        $this->pesan = $pesan;
    }
 
    public function build()
    {
        return $this->subject('Pesan Baru dari Website - ' . $this->nama)
                    ->replyTo($this->emailPengirim)
                    ->view('emails.kontak');
    }
}
