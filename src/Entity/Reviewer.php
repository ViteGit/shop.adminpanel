<?php

namespace App\Entity;

use App\VO\Email;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewerRepository")
 */
class Reviewer
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(type="email", name="email", nullable=false)
     */
    protected $email;

    /**
     * @var
     *
     * @ORM\Column(type="string", name="nickname")
     */
    protected $nickname = 'anonym';

    /**
     * @ORM\OneToMany(targetEntity="Review", mappedBy="reviewer", cascade={"persist", "remove"})
     */
    private $reviews;

    /**
     * @param Email $email
     * @param string $nickname
     */
    public function __construct(Email $email, string $nickname)
    {
        $this->email = $email;
        $this->nickname = $nickname;
        $this->reviews = new ArrayCollection();
    }

    /**
     * @param Review $review
     *
     * @return Reviewer
     */
    public function addReview(Review $review): self
    {
        $this->reviews->add($review);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }
}
