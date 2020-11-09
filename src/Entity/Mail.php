<?php

namespace App\Entity;

use App\Repository\MailRepository;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      collectionOperations={
 *          "get"={"access_control"="is_granted('ROLE_USER')"},
 *          "post",
 *      },
 *      itemOperations={
 *          "get"={"access_control"="is_granted('ROLE_USER')"},
 *          "put"={"access_control"="is_granted('ROLE_USER')"},
 *          "delete"={"access_control"="is_granted('ROLE_USER')"},
 *     },
 *      attributes={
 *          "access_control",
 *          "normalization_context"={"groups"={"mail_get"}},
 *     },
 * )
 * @ApiFilter(SearchFilter::class, properties={
 *      "id" : "exact",
 * })
 *
 * @ORM\Entity(repositoryClass=MailRepository::class)
 */
class Mail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("mail_get")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups("mail_get")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=200)
     * @Groups("mail_get")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups("mail_get")
     */
    private $subject;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("mail_get")
     */
    private $message;

    /*
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("mail_get")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups("mail_get")
     */
    private $sended;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSended(): ?bool
    {
        return $this->sended;
    }

    public function setSended(?bool $sended): self
    {
        $this->sended = $sended;

        return $this;
    }


}
