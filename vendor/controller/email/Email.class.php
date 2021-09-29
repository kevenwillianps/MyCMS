<?php

/** Defino o local da classes */

namespace vendor\controller\email;

/** Importação de classes */
use \PHPMailer\PHPMailer\PHPMailer;

class Email
{

    /** Parâmetros da classes */
    private $Email = null;

    private $html = null;
    private $data = null;
    private $subject = null;

    /** Método construtor */
    public function __construct()
    {

        /** Instânciamento de classes */
        $this->Email = new PHPMailer(true);

    }

    public function send(string $html, $data, string $subject): void
    {

        /** Parâmetros de entrada */
        $this->html = $html;
        $this->data = $data;
        $this->subject = $subject;

        /** Configurações do servidor */
        $this->Email->isSMTP();
        $this->Email->Host = 'mail.souza.inf.br';
        $this->Email->SMTPAuth = true;
        $this->Email->Username = 'contato@souza.inf.br';
        $this->Email->Password = 'Star147oi.';
        $this->Email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->Email->Port = 465;

        /** Destinatários */
        $this->Email->setFrom('contato@souza.inf.br', 'SCT - MyCMS');
        $this->Email->addAddress($this->data->email, $this->data->name_first . ' ' . $this->data->name_last);

        /** Conteúdo */
        $this->Email->isHTML(true);
        $this->Email->Subject = $this->subject;
        $this->Email->Body = utf8_decode($this->html);
        $this->Email->AltBody = 'Para visualizar essa mensagem acesse';

        /** Envio do email */
        $this->Email->Send();

    }

}