<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Mail;
use App\Service\MailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


final class MailDataPersister implements ContextAwareDataPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var MailService
     */
    private $mailService;

    /**
     * @var ParameterBagInterface
     */
    private $params;

    public function __construct(EntityManagerInterface $manager,MailService $mailService,ParameterBagInterface $param)
    {
        $this->manager = $manager;
        $this->mailService = $mailService;
        $this->params = $param;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Mail;
    }

    public function persist($data, array $context = [])
    {

        $this->manager->persist($data);
        $this->manager->flush();

        if(
            $this->params->get('mail') != null
            && isset($this->params->get('mail')['expediteur']) && filter_var($this->params->get('mail')['expediteur'],FILTER_VALIDATE_EMAIL)
            && isset($this->params->get('mail')['destinataire']) && filter_var($this->params->get('mail')['destinataire'],FILTER_VALIDATE_EMAIL)
        ){
            $message = "<p>Message de {$data->getName()} '{$data->getEmail()}' </p><br><p>{$data->getMessage()}</p>";
            $sended = $this->mailService->send(
                $this->params->get('mail')['expediteur'],
                $this->params->get('mail')['destinataire'],
                $data->getSubject(),
                $message
            );

            $data->setSended($sended);
            $this->manager->persist($data);
            $this->manager->flush();
        }

        return $data;
    }

    public function remove($data, array $context = [])
    {
       $this->manager->remove($data);
       $this->manager->flush();
    }


}