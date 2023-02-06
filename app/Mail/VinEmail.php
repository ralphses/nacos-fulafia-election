<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VinEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $url;
    protected string $voterId;
    protected string $name;
    protected string $stopTime;

    /**
     * @param string $url
     * @param string $voterId
     * @param string $name
     * @param string $stopTime
     */
    public function __construct(string $url, string $voterId, string $name, string $stopTime)
    {
        $this->url = $url;
        $this->voterId = $voterId;
        $this->name = $name;
        $this->stopTime = $stopTime;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getVoterId(): string
    {
        return $this->voterId;
    }

    /**
     * @param string $voterId
     */
    public function setVoterId(string $voterId): void
    {
        $this->voterId = $voterId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getStopTime(): string
    {
        return $this->stopTime;
    }

    /**
     * @param string $stopTime
     */
    public function setStopTime(string $stopTime): void
    {
        $this->stopTime = $stopTime;
    }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'NACOS VIN',

        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.vin-email',
            with: [
                'voterId' => $this->getVoterId(),
                'url' => $this->getUrl(),
                'name' => $this->getName(),
                'stopTime' => $this->getStopTime()
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
