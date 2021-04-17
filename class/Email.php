<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once "PHPMailer/src/Exception.php";
require_once "PHPMailer/src/PHPMailer.php";
require_once "PHPMailer/src/SMTP.php";
require_once "config.php";


class Email
{
    public function sendEmail($tipo, $email, $cpf, $senha)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->charSet = "UTF-8";


            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            //$mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->SMTPAuth   = true;
            // $mail->SMTPSecure = false;
            // $mail->SMTPAutoTLS = false;
            $mail->Port       = 587;
            $mail->Host       = MAIL_HOST;
            $mail->Username   = MAIL_USER;
            $mail->Password   = MAIL_PASS;

            $mail->setFrom(MAIL_USER, TITLE);

            $mail->isHTML(true);
            
            switch ($tipo) {
                case 'cadastro':
                    $mail->Subject = "Nova conta criada";
                    $mail->AltBody = "";
                    $corpo = $this->novaConta($cpf, $senha);
                    break;
                
                default:
                    
                    break;
            }
            

            $mail->addAddress($email);
            $mail->Body = utf8_decode($corpo);

            if ($mail->send()) {
                return true;
            }
            return false;
        } catch (Exception $e) {
        }
    }

    public function novaConta($cpf, $senha){
        
        $texto = "<div class=''>
        <div id=':14w' class='ii gt'>
            <div id=':14v' class='a3s aiL '>
                <div style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;color:rgb(30,30,30);line-height:1.4em;margin:0;padding:0;background-color:rgb(255,255,255);text-align:center'>
                    <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#f6f7f8' style='border-collapse:collapse'>
                        <tbody>
                            <tr>
                                <td align='center' valign='middle'>
                                    <div style='margin-top:24px;margin-bottom:24px'><img src='http://www.1rm.eb.mil.br/images/banners/logo.png' class='CToWUd'></div>
                                </td>
                            </tr>
                            <tr>
                              <td>
                                <table align='center' cellspacing='0' cellpadding='0' width='650' bgcolor='#ffffff' style='border-collapse:collapse;border-radius:8px'>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div style='text-align: left;'>
                                                    <div style='border-bottom:1px solid rgb(246,247,248);padding:24px 16px'>
                                                        <strong>Bem vindo ao Sistema de PTTC</strong>
                                                    </div>
                                                
                                                    <div style='padding:24px 16px'>
                                                        <div><span style='font-size:11pt'>
                                                            O senhor(a) está recebendo o e-mail de confirmação de acesso ao Sistema de PTTC.<br><br>
                                                            Segue abaixo as informações de acesso:<br><br>
                                                            CPF: {$cpf}<br>
                                                            Senha: {$senha}<br><br>
                                                            
                                                            <a style='margin:0;padding:0;line-height:1.4em;color:rgb(0,162,199);text-decoration:none' target='_blank' href='http://10.1.11.97/pttc'>
                                                                Clique aqui para acessar o <span>Sistema</span>
                                                            </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                              </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <div>
                                        <div style='clear:both;background-color:#eee;border-top:solid 20px #eee;border-bottom:solid 15px #eee;margin:30px 0 0'>
                                            <div style='width:94%;margin:0 auto;text-align:center;border-left:solid 10px #eee;border-right:solid 10px #eee;min-width:220px;max-width:650px;font-family:arial;color:#2d2d2d;font-size:11px'>
                                                <p style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;color:rgb(30,30,30);line-height:1.4em;margin:0;padding:0;font-size:16px;font-weight:bold;margin:0 0 10px'>
                                                    <br>
                                                    <h2 style='color:rgb(0,162,199);'>'Servir bem aos que já serviram'</h2>
                                                    Desenolvido pela Divisão de Tecnologia da Informação 1ª RM
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>";

        return $texto;

    }
}
