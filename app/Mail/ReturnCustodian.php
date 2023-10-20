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

class ReturnCustodian extends Mailable
{
    use Queueable, SerializesModels;

    public $custodian1;
    public $itemData;

    /**
     * Create a new message instance.
     *
     * @param $dataFromDatabase
     */
    public function __construct($dataFromDatabase,$itemArray)
    {
        $this->custodian1 = $dataFromDatabase;
        $this->itemData = $itemArray;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.markCustodian')
                ->subject('Returning of items in Custodian Form');
    }
}
