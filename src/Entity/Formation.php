<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FormationRepository;
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
 *          "normalization_context"={"groups"={"formation_get"}},
 *     },
 * )
 * @ApiFilter(SearchFilter::class, properties={
 *      "id" : "exact",
 * })
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FormationRepository::class)
 */
class Formation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups({"formation_get"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"formation_get"})
     */
    private $school;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"formation_get"})
     */
    private $period;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"formation_get"})
     */
    private $level;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"formation_get"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"formation_get"})
     */
    private $year;



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

    public function getSchool(): ?string
    {
        return $this->school;
    }

    public function setSchool(string $school): self
    {
        $this->school = $school;

        return $this;
    }

    public function getPeriod(): ?string
    {
        return $this->period;
    }

    public function setPeriod(string $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

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

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }


}
