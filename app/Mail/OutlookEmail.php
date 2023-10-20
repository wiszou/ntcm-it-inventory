<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class OutlookEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $data2;

    /**
     * Create a new message instance.
     *
     * @param $dataFromDatabase
     */
    public function __construct($dataFromDatabase,$itemArray)
    {
        $this->data = $dataFromDatabase;
        $this->data2 = $itemArray;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.custodianCreation')
                ->subject('Creation of Custodian Form');
    }
}
