<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestScheduledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $Candidat, $testDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Candidat, $testDate)
    {
        $this->Candidat = $Candidat;
        $this->testDate = $testDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Test Presentiel Youcode')
        ->view('emails.testPresentieltime')
        ->with([
            'Candidat' => $this->Candidat,
            'testDate' => $this->testDate,
        ]);
    }



}
