<?php
declare(strict_types=1);
/**
 *
 * PHP version 7.3
 *
 * LICENSE:
 * This file is part of person_db_skeleton which is a set of skeleton database
 * tables for people and common associated data.
 *
 * Copyright (C) 2019 Michael Cummings. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice, this
 * list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation and/or
 * other materials provided with the distribution.
 *
 * 3. Neither the name of the copyright holder nor the names of its contributors
 * may be used to endorse or promote products derived from this software without
 * specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * You should have received a copy of the BSD-3 Clause License along with
 * this program. If not, see
 * <https://spdx.org/licenses/BSD-3-Clause.html>.
 *
 * You should be able to find a copy of this license in the LICENSE file.
 *
 * @author    Michael Cummings <mgcummings@yahoo.com>
 * @copyright 2019 Michael Cummings
 * @license   BSD-3-Clause
 */

namespace PersonDBSkeleton\Model\Entities;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Doctrine\ORM\Mapping as ORM;
use Uuid64Type\Entity\Uuid64Id;
use Uuid64Type\Uuid4;

/**
 * People
 *
 * @ORM\Table(
 *     name="people",
 *     indexes={
 *         @ORM\Index(name="idx_p_family_name", columns={"family_name"}),
 *         @ORM\Index(name="fk_p_gender", columns={"gender_id"}),
 *         @ORM\Index(name="fk_p_pronoun", columns={"pronoun_id"}),
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="unq_p_photo", columns={"photo_id"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="PersonDBSkeleton\Model\Repositories\PeopleRepository")
 */
class People {
    use CreateAt;
    use Json;
    use Uuid4;
    use Uuid64Id;
    /**
     * Constructor
     *
     * @param string $givenName  Given (often first) name.
     * @param string $familyName Family (often last) name.
     *
     * @throws \Exception
     */
    public function __construct(string $givenName, string $familyName) {
        $this->createdAt = new \DateTimeImmutable();
        $this->familyName = $familyName;
        $this->givenName = $givenName;
        $this->id = self::asBase64();
        $this->emails = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->phoneNumbers = new ArrayCollection();
    }
    /**
     * Add address.
     *
     * @param PeopleAddresses $address
     *
     * @return People
     */
    public function addAddress(PeopleAddresses $address): People {
        $this->addresses->add($address);
        return $this;
    }
    /**
     * Add email.
     *
     * @param PeopleEmails $email
     *
     * @return People
     */
    public function addEmail(PeopleEmails $email): People {
        $this->emails->add($email);
        return $this;
    }
    /**
     * Add phoneNumber.
     *
     * @param PeoplePhoneNumbers $phoneNumber
     *
     * @return People
     */
    public function addPhoneNumber(PeoplePhoneNumbers $phoneNumber): People {
        $this->phoneNumbers->add($phoneNumber);
        return $this;
    }
    /**
     * Delete (remove) address.
     *
     * @param PeopleAddresses $address
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function deleteAddress(PeopleAddresses $address): bool {
        return $this->addresses->removeElement($address);
    }
    /**
     * Delete (remove) email.
     *
     * @param PeopleEmails $email
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function deleteEmail(PeopleEmails $email): bool {
        return $this->emails->removeElement($email);
    }
    /**
     * Delete (remove) phoneNumber.
     *
     * @param PeoplePhoneNumbers $phoneNumber
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function deletePhoneNumber(PeoplePhoneNumbers $phoneNumber): bool {
        return $this->phoneNumbers->removeElement($phoneNumber);
    }
    /**
     * Get additionalName.
     *
     * @return string|null
     */
    public function getAdditionalName(): ?string {
        return $this->additionalName;
    }
    /**
     * Get addresses.
     *
     * @return Collection
     */
    public function getAddresses(): Collection {
        return $this->addresses;
    }
    /**
     * Get birthday.
     *
     * @return \DateTimeImmutable|null
     */
    public function getBirthday(): ?\DateTimeImmutable {
        return $this->birthday;
    }
    /**
     * Get emails.
     *
     * @return Collection
     */
    public function getEmails(): Collection {
        return $this->emails;
    }
    /**
     * Get familyName.
     *
     * @return string
     */
    public function getFamilyName(): string {
        return $this->familyName;
    }
    /**
     * Get gender.
     *
     * @return Genders|null
     */
    public function getGender(): ?Genders {
        return $this->gender;
    }
    /**
     * Get givenName.
     *
     * @return string
     */
    public function getGivenName(): string {
        return $this->givenName;
    }
    /**
     * Get honorificPrefix.
     *
     * @return string|null
     */
    public function getHonorificPrefix(): ?string {
        return $this->honorificPrefix;
    }
    /**
     * Get honorificSuffix.
     *
     * @return string|null
     */
    public function getHonorificSuffix(): ?string {
        return $this->honorificSuffix;
    }
    /**
     * Get phoneNumbers.
     *
     * @return Collection
     */
    public function getPhoneNumbers(): Collection {
        return $this->phoneNumbers;
    }
    /**
     * Get photo.
     *
     * @return PeoplePhotos|null
     */
    public function getPhoto(): ?PeoplePhotos {
        return $this->photo;
    }
    /**
     * Get pronouns.
     *
     * @return Pronouns|null
     */
    public function getPronouns(): ?Pronouns {
        return $this->pronouns;
    }
    /**
     * @param string|null $value
     *
     * @return self Fluent interface
     */
    public function setAdditionalName(?string $value = null): self {
        $this->additionalName = $value;
        return $this;
    }
    /**
     * @param \DateTimeImmutable|null $value
     *
     * @return self Fluent interface
     */
    public function setBirthday(?\DateTimeImmutable $value = null): self {
        $this->birthday = $value;
        return $this;
    }
    /**
     * @param string $value
     *
     * @return self Fluent interface
     */
    public function setFamilyName(string $value): self {
        $this->familyName = $value;
        return $this;
    }
    /**
     * @param Genders|null $value
     *
     * @return self Fluent interface
     */
    public function setGender(?Genders $value = null): self {
        $this->gender = $value;
        return $this;
    }
    /**
     * @param string $value
     *
     * @return self Fluent interface
     */
    public function setGivenName(string $value): self {
        $this->givenName = $value;
        return $this;
    }
    /**
     * @param string|null $value
     *
     * @return self Fluent interface
     */
    public function setHonorificPrefix(?string $value = null): self {
        $this->honorificPrefix = $value;
        return $this;
    }
    /**
     * @param string|null $value
     *
     * @return self Fluent interface
     */
    public function setHonorificSuffix(?string $value = null): self {
        $this->honorificSuffix = $value;
        return $this;
    }
    /**
     * @param PeoplePhotos|null $value
     *
     * @return self Fluent interface
     */
    public function setPhoto(?PeoplePhotos $value = null): self {
        $this->photo = $value;
        return $this;
    }
    /**
     * @param Pronouns|null $value
     *
     * @return self Fluent interface
     */
    public function setPronouns(?Pronouns $value = null): self {
        $this->pronouns = $value;
        return $this;
    }
    /**
     * Other (e.g. middle) name.
     *
     * @var string|null
     *
     * @ORM\Column(
     *     name="additional_name",
     *     type="string",
     *     length=255,
     *     nullable=true
     * )
     */
    private $additionalName;
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PeopleAddresses", mappedBy="person", fetch="EXTRA_LAZY", orphanRemoval=true)
     */
    private $addresses;
    /**
     * @var \DateTimeImmutable|null
     *
     * @ORM\Column(name="birthday", type="datetime_immutable", nullable=true)
     */
    private $birthday;
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PeopleEmails", mappedBy="person", fetch="EXTRA_LAZY", orphanRemoval=true)
     */
    private $emails;
    /**
     * Family (often last) name.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="family_name",
     *     type="string",
     *     length=100,
     *     nullable=false
     * )
     */
    private $familyName;
    /**
     * @var Genders|null
     *
     * @ORM\ManyToOne(targetEntity="Genders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gender_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $gender;
    /**
     * Given (often first) name.
     *
     * @var string
     *
     * @ORM\Column(
     *     name="given_name",
     *     type="string",
     *     length=100,
     *     nullable=false
     * )
     */
    private $givenName;
    /**
     * Honorific prefix e.g. Mrs., Mr. or Dr.
     *
     * @var string|null
     *
     * @ORM\Column(name="honorific_prefix",
     *     type="string",
     *     length=50,
     *     nullable=true
     * )
     */
    private $honorificPrefix;
    /**
     * Honorific suffix e.g. Ph.D, Esq.
     *
     * @var string|null
     *
     * @ORM\Column(
     *     name="honorific_suffix",
     *     type="string",
     *     length=50,
     *     nullable=true
     * )
     */
    private $honorificSuffix;
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="PeoplePhoneNumbers", mappedBy="person", fetch="EXTRA_LAZY", orphanRemoval=true)
     */
    private $phoneNumbers;
    /**
     * @var PeoplePhotos|null
     *
     * @ORM\OneToOne(targetEntity="PeoplePhotos", fetch="EXTRA_LAZY", orphanRemoval=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $photo;
    /**
     * @var Pronouns|null
     *
     * @ORM\ManyToOne(targetEntity="Pronouns")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pronoun_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $pronouns;
}
