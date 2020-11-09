<?php


namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class MailService
{

    private $params;

    private $mailer;


    public function __construct(
        ParameterBagInterface $params,
        \Swift_Mailer $mailer
    )
    {
        $this->params = $params;
        $this->mailer = $mailer;
    }


    public function send(
        $from,
        $to,
        $subject,
        $message,
        $cc = null,
        $bcc = null,
        $files = null
    )
    {

        $m = (new \Swift_Message($subject));
        $m->setFrom($from);
        $m->setTo($to);
        $m->setBody($message);

        $type = $m->getHeaders()->get('Content-Type');
        $type->setValue('text/html');
        $type->setParameter('charset', 'utf-8');


        if($cc != null) $m->setCc($cc);

        if($bcc != null) $m->setBcc($bcc);

        if($files != null){

            foreach($files as $f){
                $attachment = \Swift_Attachment::fromPath($f);
                // Attach it to the message
                $m->attach($attachment);
            }

        }

        return $this->mailer->send($m);

    }


    public function interpreter($object,$body)
    {

        preg_match_all( '#\{{([a-zA-Z._-]{1,})}}#',$body,$m);

        foreach($m[1] as $m){

            $v = explode('.',$m);
            $count =  count($v) -1;
            $req = $object;
            foreach($v as $key => $d){

                if(property_exists($req,$d)){

                    if($key < $count){
                        if($key == 0){
                            $req = $object->get($d);
                        }else{
                            $req = $req->get($d);
                        }
                    }else{

                        $result = $req->get($d);

                        //Conversion
                        if($d == 'numeros_a_portes'){
                            if(is_array($result)){

                                $r = '<ul>';
                                foreach($result as $res){
                                    $r .= "<li>".implode(" - ",$res).'</li>';
                                }
                                $r .= '</ul>';
                                $result = $r;
                            }
                        }

                        $body = str_replace ('{{'.$m.'}}',$result, $body);
                    }

                }

            }

        }

        return $body;

    }




}
