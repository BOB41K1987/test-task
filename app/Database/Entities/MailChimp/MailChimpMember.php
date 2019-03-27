<?php
declare(strict_types=1);

namespace App\Database\Entities\MailChimp;

use Doctrine\ORM\Mapping as ORM;
use EoneoPay\Utils\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="mail_chimp_member")
 */
class MailChimpMember extends MailChimpEntity
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $memberId;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $mailChimpId;

    /**
     * @ORM\ManyToOne(targetEntity="MailChimpList")
     * @ORM\JoinColumn(nullable=false, name="list_id")
     */
    private $listId;

    /**
     * @ORM\Column(type="string")
     */
    private $emailAddress;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $emailType;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $mergeFeilds;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $interests;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $language;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vip;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $marketingPermission;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $ipSignup;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $timestampSignup;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ipOpt;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $timestampOpt;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $tags;

    /**
     * Get id.
     *
     * @return null|string
     */
    public function getMemberId(): ?string
    {
        return $this->memberId;
    }

    /**
     * Get mailchimp id of the member
     *
     * @return null|string.
     */
    public function getMailChimpId(): ?string
    {
        return $this->mailChimpId;
    }

    /**
     * Set mailchimp id of the member.
     *
     * @param string $mailChimpId
     *
     * @return MailChimpMember
     */
    public function setMailChimpId($mailChimpId): self
    {
        $this->mailChimpId = $mailChimpId;

        return $this;
    }

    /**
     * Get the id for related list.
     *
     * @return string
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * Set the id of related list.
     *
     * @param string $listId
     *
     * @return MailChimpMember
     */
    public function setListId($listId): self
    {
        $this->listId = $listId;

        return $this;
    }

    /**
     * GEt email address for a subscriber.
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set email address for a subscriber.
     *
     * @param string $emailAddress
     *
     * @return MailChimpMember
     */
    public function setEmailAddress($emailAddress): self
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Type of email this member asked to get (‘html’ or ‘text’).
     *
     * @return null|string
     */
    public function getEmailType()
    {
        return $this->emailType;
    }

    /**
     * Type of email this member asked to get (‘html’ or ‘text’).
     *
     * @param string $emailType
     *
     * @return MailChimpMember
     */
    public function setEmailType($emailType): self
    {
        $this->emailType = $emailType;

        return $this;
    }

    /**
     * Get subscriber’s current status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set subscriber’s current status.
     *
     * @param string $status
     *
     * @return MailChimpMember
     */
    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get an individual merge var and value for a member.
     *
     * @return null|array
     */
    public function getMergeFeilds()
    {
        return $this->mergeFeilds;
    }

    /**
     * Set an individual merge var and value for a member.
     *
     * @param array $mergeFeilds
     *
     * @return MailChimpMember
     */
    public function setMergeFeilds($mergeFeilds): self
    {
        $this->mergeFeilds = $mergeFeilds;

        return $this;
    }

    /**
     * Get subscriber Interests
     *
     * @return null|array
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * Set subscriber Interests
     *
     * @param array $interests
     *
     * @return MailChimpMember
     */
    public function setInterests($interests): self
    {
        $this->interests = $interests;

        return $this;
    }

    /**
     * Get subscriber's language
     *
     * @return null|string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set subscriber's language
     *
     * @param string $language
     *
     * @return MailChimpMember
     */
    public function setLanguage($language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get VIP status for subscriber
     *
     * @return boolean
     */
    public function getVip()
    {
        return $this->vip;
    }

    /**
     * Set VIP status for subscriber
     *
     * @param boolean $vip
     *
     * @return MailChimpMember
     */
    public function setVip($vip): self
    {
        $this->vip = $vip;

        return $this;
    }

    /**
     * Get subscriber location information
     *
     * @return null|string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set subscriber location information
     *
     * @param string $location
     *
     * @return MailChimpMember
     */
    public function setLocation($location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get marketing permissions for the subscriber
     *
     * @return null|array
     */
    public function getMarketingPermission()
    {
        return $this->marketingPermission;
    }

    /**
     * Set marketing permissions for the subscriber
     *
     * @param string $marketingPermission
     *
     * @return MailChimpMember
     */
    public function setMarketingPermission($marketingPermission): self
    {
        $this->marketingPermission = $marketingPermission;

        return $this;
    }

    /**
     * Get IP address the subscriber signed up from
     *
     * @return null|string
     */
    public function getIpSignup()
    {
        return $this->ipSignup;
    }

    /**
     * Set IP address the subscriber signed up from
     *
     * @param string $ipSignup
     *
     * @return MailChimpMember
     */
    public function setIpSignup($ipSignup): self
    {
        $this->ipSignup = $ipSignup;

        return $this;
    }

    /**
     * Get Signup Timestamp
     *
     * @return string
     */
    public function getTimestampSignup()
    {
        return $this->timestampSignup;
    }

    /**
     * Set Signup Timestamp
     *
     * @param string $timestampSignup
     *
     * @return MailChimpMember
     */
    public function setTimestampSignup($timestampSignup): self
    {
        $this->timestampSignup = $timestampSignup;

        return $this;
    }

    /**
     * Get the IP address the subscriber used to confirm their opt-in status.
     *
     * @return string
     */
    public function getIpOpt()
    {
        return $this->ipOpt;
    }

    /**
     * Set the IP address the subscriber used to confirm their opt-in status.
     *
     * @param string $ipOpt
     *
     * @return MailChimpMember
     */
    public function setIpOpt($ipOpt)
    {
        $this->ipOpt = $ipOpt;

        return $this;
    }

    /**
     * Get the date and time the subscribe confirmed their opt-in status
     *
     * @return string
     */
    public function getTimestampOpt()
    {
        return $this->timestampOpt;
    }

    /**
     * Set the date and time the subscribe confirmed their opt-in status
     *
     * @param string $timestampOpt
     *
     * @return MailChimpMember
     */
    public function setTimestampOpt($timestampOpt)
    {
        $this->timestampOpt = $timestampOpt;

        return $this;
    }

    /**
     * Get the tags that are associated with a member.
     *
     * @return null|array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set the tags that are associated with a member.
     *
     * @param array $tags
     *
     * @return MailChimpMember
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    public function getValidationRules(): array
    {
        return [
            'mailchimp_id'                                  => 'nullable|string',
            'email_address'                                 => 'required|string',
            'email_type'                                    => 'nullable|string|in:html,text',
            'status'                                        => 'required|string|in:subscribed,unsubscribed,cleaned,pending',
            'merge_fields'                                  => 'nullable|array',
            'interests'                                     => 'nullable|array',
            'language'                                      => 'nullable|string',
            'vip'                                           => 'nullable|boolean',
            'location'                                      => 'nullable|array',
            'location.latitude'                             => 'nullable|numeric',
            'location.longitude'                            => 'nullable|numeric',
            'marketing_permissions'                         => 'nullable|array',
            'marketing_permissions.marketing_permission_id' => 'nullable|string',
            'marketing_permissions.enabled'                 => 'nullable|boolean',
            'ip_signup'                                     => 'nullable|ip',
            'timestamp_signup'                              => 'nullable|string',
            'ip_opt'                                        => 'nullable|ip',
            'timestamp_opt'                                 => 'nullable|string',
            'tags'                                          => 'nullable|array',
        ];
    }

    public function toArray(): array
    {
        // TODO: Implement toArray() method.
    }

}