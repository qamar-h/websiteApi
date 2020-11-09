<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SkillRepository;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *  @ApiResource(
 *      collectionOperations={
 *          "get",
 *          "post"={"access_control"="is_granted('ROLE_USER')"},
 *      },
 *      itemOperations={
 *          "get"={"access_control"="is_granted('ROLE_USER')"},
 *          "put"={"access_control"="is_granted('ROLE_USER')"},
 *          "delete"={"access_control"="is_granted('ROLE_USER')"},
 *     },
 *      attributes={
 *          "access_control",
 *          "normalization_context"={"groups"={"skill_get"}},
 *     },
 * )
 * @ApiFilter(SearchFilter::class, properties={
 *      "id" : "exact",
 * })
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({"skill_get"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"skill_get"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"skill_get"})
     */
    private $rate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"skill_get"})
     */
    private $secondary;


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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getSecondary(): ?bool
    {
        return $this->secondary;
    }

    public function setSecondary(?bool $secondary): self
    {
        $this->secondary = $secondary;

        return $this;
    }
}
