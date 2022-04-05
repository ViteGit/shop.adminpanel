<?php

namespace App\Service;

use Swift_Attachment;
use Swift_ByteStream_FileByteStream;
use Swift_IoException;
use Swift_Mailer;
use Swift_Message;
use Swift_Plugins_Loggers_ArrayLogger;
use Swift_Plugins_LoggerPlugin;
use Swift_RfcComplianceException;
use Swift_SmtpTransport;
use Swift_TransportException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MailSender
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var string
     */
    private $senderEmail;

    /**
     * @param string       $senderEmail
     * @param string       $senderEncryption
     * @param string       $senderHost
     * @param string       $senderPassword
     * @param string       $senderPort
     */
    public function __construct(
        string $senderEmail,
        string $senderEncryption,
        string $senderHost,
        string $senderPassword,
        string $senderPort
    ) {
        $this->senderEmail = $senderEmail;
        $this->mailer = new Swift_Mailer((new Swift_SmtpTransport($senderHost, $senderPort, null))
            ->setUsername($senderEmail)
            ->setPassword($senderPassword));
        $this->loggerReader = new Swift_Plugins_Loggers_ArrayLogger();
        $this->mailer->registerPlugin(new Swift_Plugins_LoggerPlugin($this->loggerReader));
    }

    /**
     * @param string                 $messageSubject
     * @param string                 $messageBody
     * @param array                  $recipientEmailAddresses
     * @param array | UploadedFile[] $attachments
     *
     * @return void

     * @throws Swift_IoException
     */
    public function sendEmail(
        string $messageSubject,
        string $messageBody,
        array $recipientEmailAddresses,
        array $attachments = []
    ): void {
        try {
            $mail = (new Swift_Message($messageSubject))
            ->setFrom($this->senderEmail)
            ->setTo($recipientEmailAddresses)
            ->setBody($messageBody);
        } catch (Swift_RfcComplianceException $ex) {
            return;
        }

        if (!empty($attachments)) {
            /**
             * @var UploadedFile $file
            */
            foreach ($attachments as $file) {
                $mail->attach(
                    new Swift_Attachment(
                        new Swift_ByteStream_FileByteStream($file->getRealPath()),
                        $file->getClientOriginalName(),
                        $file->getMimeType()
                    )
                );
            }
        }

        try {
            $this->mailer->send($mail);
        } catch (Swift_TransportException $ex) {
        }
    }
}
