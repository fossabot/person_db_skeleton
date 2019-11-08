<?php

namespace PersonDBSkeleton\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * PeoplePhoneNumbers
 *
 * @ORM\Table(name="people_phone_numbers", indexes={
 *     @ORM\Index(name="idx_ppn_reverse", columns={"phone_id", "person_id"}),
 *     @ORM\Index(name="fk_ppn_type", columns={"type_id"}),
 *     @ORM\Index(name="idx_ppn_person", columns={"person_id"}),
 *     @ORM\Index(name="idx_ppn_phone", columns={"phone_id"})})
 * @ORM\Entity
 */
class PeoplePhoneNumbers {
    /**
     * Get comment.
     *
     * @return string|null
     */
    public function getComment(): ?string {
        return $this->comment;
    }
    /**
     * Get person.
     *
     * @return People
     */
    public function getPerson(): People {
        return $this->person;
    }
    /**
     * Get phone.
     *
     * @return PhoneNumbers
     */
    public function getPhone(): PhoneNumbers {
        return $this->phone;
    }
    /**
     * Get type.
     *
     * @return PhoneTypes
     */
    public function getType(): PhoneTypes {
        return $this->type;
    }
    /**
     * Set comment.
     *
     * @param string|null $comment
     *
     * @return PeoplePhoneNumbers
     */
    public function setComment($comment = null): PeoplePhoneNumbers {
        $this->comment = $comment;
        return $this;
    }
    /**
     * Set person.
     *
     * @param People $person
     *
     * @return PeoplePhoneNumbers
     */
    public function setPerson(People $person): PeoplePhoneNumbers {
        $this->person = $person;
        return $this;
    }
    /**
     * Set phone.
     *
     * @param PhoneNumbers $phone
     *
     * @return PeoplePhoneNumbers
     */
    public function setPhone(PhoneNumbers $phone): PeoplePhoneNumbers {
        $this->phone = $phone;
        return $this;
    }
    /**
     * Set type.
     *
     * @param PhoneTypes $type
     *
     * @return PeoplePhoneNumbers
     */
    public function setType(PhoneTypes $type): PeoplePhoneNumbers {
        $this->type = $type;
        return $this;
    }
    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    private $comment;
    /**
     * @var People
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="People", inversedBy="phoneNumbers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;
    /**
     * @var PhoneNumbers
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="PhoneNumbers", inversedBy="people")
     * @ORM\JoinColumn(nullable=false)
     */
    private $phone;
    /**
     * @var PhoneTypes
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="PhoneTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;
}
