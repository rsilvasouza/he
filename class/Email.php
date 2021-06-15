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
    public function sendEmail($tipo, $email)
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
                    $corpo = $this->novaConta();
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

    public function aprovarCadastro($tipo, $email)
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
                case 'liberacao':
                    $mail->Subject = "Acesso liberado";
                    $mail->AltBody = "";
                    $corpo = $this->bodyAprovarCadastro();
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

    public function novaConta(){
        
        $texto = "<div class=''>
        <div id=':14w' class='ii gt'>
            <div id=':14v' class='a3s aiL '>
                <div style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;color:rgb(30,30,30);line-height:1.4em;margin:0;padding:0;background-color:rgb(255,255,255);text-align:center'>
                    <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#f6f7f8' style='border-collapse:collapse'>
                        <tbody>
                            <tr>
                                <td align='center' valign='middle'>
                                    <div style='margin-top:24px;margin-bottom:24px'><img src='http://www.faeterj-paracambi.com.br/bind/wp-content/themes/ist/img/logo.gif' class='CToWUd'></div>
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
                                                        <strong>Bem vindo ao Sistema de SHE</strong>
                                                    </div>
                                                
                                                    <div style='padding:24px 16px'>
                                                        <div><span style='font-size:11pt'>
                                                            A sua conta no sistema de horas extracurriculares foi criada.<br>
                                                            Após a analise feita pelo professor responsável a sua conta será desbloqueada para acesso.<br><br>
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
                                                    <h2 style='color:rgb(0,162,199);'>''</h2>
                                                    
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


    public function bodyAprovarCadastro(){
        $texto = "<div class=''>
        <div id=':14w' class='ii gt'>
            <div id=':14v' class='a3s aiL '>
                <div style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:16px;font-weight:400;color:rgb(30,30,30);line-height:1.4em;margin:0;padding:0;background-color:rgb(255,255,255);text-align:center'>
                    <table cellspacing='0' cellpadding='0' width='100%' bgcolor='#f6f7f8' style='border-collapse:collapse'>
                        <tbody>
                            <tr>
                                <td align='center' valign='middle'>
                                    <div style='margin-top:24px;margin-bottom:24px'><img src='http://www.faeterj-paracambi.com.br/bind/wp-content/themes/ist/img/logo.gif' class='CToWUd'></div>
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
                                                        <strong>Análise Concluída!</strong>
                                                    </div>
                                                
                                                    <div style='padding:24px 16px'>
                                                        <div><span style='font-size:11pt'>
                                                            Informamos que o seu acesso ao sistema esta liberado e você poderá cadastrar as suas horas extracurriculares.<br><br>
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
                                                    <h2 style='color:rgb(0,162,199);'>''</h2>
                                                    
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
