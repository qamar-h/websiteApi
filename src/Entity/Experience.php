<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ExperienceRepository;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Core\Annotation\ApiFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *   @ApiResource(
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
 *          "normalization_context"={"groups"={"experience_get"}},
 *     },
 * )
 * @ApiFilter(SearchFilter::class, properties={
 *      "id" : "exact",
 * })
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ExperienceRepository::class)
 */
class Experience
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({"experience_get"})
     */
    private $companyName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"experience_get"})
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({"experience_get"})
     */
    private $posteName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"experience_get"})
     */
    private $period;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"experience_get"})
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

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

    public function getPosteName(): ?string
    {
        return $this->posteName;
    }

    public function setPosteName(string $posteName): self
    {
        $this->posteName = $posteName;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
