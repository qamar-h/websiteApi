<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\User;
use App\Service\MailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


final class UserDataPersister implements ContextAwareDataPersisterInterface
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
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(EntityManagerInterface $manager,MailService $mailService,UserPasswordEncoderInterface $encoder)
    {
        $this->manager = $manager;
        $this->mailService = $mailService;
        $this->encoder = $encoder;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function persist($data, array $context = [])
    {

        $originalPass = $data->getPassword();
        $hash =  $this->encoder->encodePassword($data,$originalPass);
        $data->setPassword($hash);

        $this->manager->persist($data);
        $this->manager->flush();

        return $data;
    }

    public function remove($data, array $context = [])
    {
        $this->manager->remove($data);
        $this->manager->flush();
    }


}