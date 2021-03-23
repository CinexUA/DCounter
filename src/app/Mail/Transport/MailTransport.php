<?php


namespace App\Mail\Transport;

use Illuminate\Mail\Transport\Transport;
use Swift_Mime_SimpleMessage;

class MailTransport extends Transport

{
    public function __construct()
    {
    }

    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $subject = $message->getSubject();
        $message->getHeaders()->remove('Subject');
        $message->getHeaders()->remove('Content-Type');
        $message->getHeaders()->addTextHeader('Content-Type', 'text/html; charset=utf-8');
        $message->getHeaders()->defineOrdering(['MIME-Version', 'Content-Type', 'To', 'From']);
        //$addresses = implode(',', array_values($this->getTo($message)));

        mail(null, $subject, $message->getBody(), $message->getHeaders()->toString());
    }

    /**
     * Get all the addresses this message should be sent to.
     *
     * Note that Mandrill still respects CC, BCC headers in raw message itself.
     *
     * @param  \Swift_Mime_SimpleMessage $message
     * @return array
     */
    protected function getTo(Swift_Mime_SimpleMessage $message)
    {
        $to = [];

        if ($message->getTo()) {
            $to = array_merge($to, array_keys($message->getTo()));
        }

        if ($message->getCc()) {
            $to = array_merge($to, array_keys($message->getCc()));
        }

        if ($message->getBcc()) {
            $to = array_merge($to, array_keys($message->getBcc()));
        }

        return $to;
    }
}
