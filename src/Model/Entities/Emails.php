<?php

namespace PersonDBSkeleton\Model\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Emails
 *
 * @ORM\Table(name="emails")
 * @ORM\Entity
 */
class Emails {
    /**
     * Constructor
     */
    public function __construct() {
        $this->person = new ArrayCollection();
    }
    /**
     * Add person.
     *
     * @param PeopleEmails $person
     *
     * @return Emails
     */
    public function addPerson(PeopleEmails $person): Emails {
        $this->person[] = $person;
        return $this;
    }
    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }
    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }
    /**
     * Get person.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPerson(): Collection {
        return $this->person;
    }
    /**
     * Remove person.
     *
     * @param PeopleEmails $person
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePerson(PeopleEmails $person): bool {
        return $this->person->removeElement($person);
    }
    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Emails
     */
    public function setEmail($email): Emails {
        $this->email = $email;
        return $this;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email = '';
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PeopleEmails", mappedBy="email", fetch="EXTRA_LAZY")
     */
    private $person;
}
