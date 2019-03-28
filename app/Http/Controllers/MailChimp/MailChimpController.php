<?php

namespace App\Http\Controllers\MailChimp;

use App\Http\Controllers\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Mailchimp\Mailchimp;

abstract class MailChimpController extends Controller
{
    /**
     * @var \Mailchimp\Mailchimp
     */
    protected $mailChimp;

    /**
     * ListsController constructor.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     * @param \Mailchimp\Mailchimp $mailchimp
     */
    public function __construct(EntityManagerInterface $entityManager, Mailchimp $mailchimp)
    {
        parent::__construct($entityManager);

        $this->mailChimp = $mailchimp;
    }
}