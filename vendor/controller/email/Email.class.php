<?php

/** Defino o local da classes */
namespace vendor\controller\email;

/** Importação de classes */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email
{

    /** Parâmetros da classes */
    private $Email = null;

    private $html = null;
    private $data = null;
    private $subject = null;
    private $preferences = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Email = new PHPMailer(true);

    }

    /** Envio de email */
    public function send(string $html, $data, string $subject, $preferences): void
    {

        /** Parâmetros de entrada */
        $this->html = $html;
        $this->data = $data;
        $this->subject = $subject;
        $this->preferences = $preferences;

        /** Configurações do servidor */
        $this->Email->isSMTP();
        $this->Email->Host = $this->preferences->email_host;
        $this->Email->SMTPAuth = true;
        $this->Email->Username = $this->preferences->email_username;
        $this->Email->Password = $this->preferences->email_password;
        $this->Email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->Email->Port = $this->preferences->email_port;

        /** Destinatários */
        $this->Email->setFrom($this->preferences->email_username, 'SCT - MyCMS');
        $this->Email->addAddress($this->data->email, $this->data->name_first . ' ' . $this->data->name_last);

        /** Conteúdo */
        $this->Email->isHTML(true);
        $this->Email->Subject = utf8_decode($this->subject);
        $this->Email->Body = utf8_decode($this->html);
        $this->Email->AltBody = 'Para visualizar essa mensagem acesse';

        /** Envio do email */
        $this->Email->Send();

    }

}
