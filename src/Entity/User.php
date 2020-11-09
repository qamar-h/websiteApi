<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *  @ApiResource(
 *      collectionOperations={
 *          "get"={"access_control"="is_granted('ROLE_USER')"},
 *          "post"={"access_control"="is_granted('ROLE_USER')"},
 *      },
 *      itemOperations={
 *          "get"={"access_control"="is_granted('ROLE_USER')"},
 *          "put"={"access_control"="is_granted('ROLE_USER')"},
 *          "delete"={"access_control"="is_granted('ROLE_USER')"},
 *     },
 *      attributes={
 *          "access_control",
 *          "normalization_context"={"groups"={"user_get"}},
 *     },
 * )
 * @ApiFilter(SearchFilter::class, properties={
 *      "id" : "exact",
 * })
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_get"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_get"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"user_get"})
     */
    private $active = '1';

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"user_get"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_get"})
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"user_get"})
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_get"})
     */
    private $updatedBy;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user_get"})
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"user_get"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_get"})
     */
    private $password;

    /**
     * @ORM\Column(type="array")
     * @Groups({"user_get"})
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user_get"})
     */
    private $email;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return User
     */
    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }


    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return User
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    /**
     * @param string $createdBy
     * @return User
     */
    public function setCreatedBy(string $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface $updatedAt
     * @return User
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    /**
     * @param string $updatedBy
     * @return User
     */
    public function setUpdatedBy(string $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @param string|null $avatar
     * @return User
     */
    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }


    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

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
}
