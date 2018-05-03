<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectNameRepository")
 */
class ProjectName
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()s
     */
    private $projectCode;

    public function getId()
    {
        return $this->id;
    }

    public function getProjectCode(): ?string
    {
        return $this->projectCode;
    }

    public function setProjectCode(string $projectCode): self
    {
        $this->projectCode = $projectCode;

        return $this;
    }
}
