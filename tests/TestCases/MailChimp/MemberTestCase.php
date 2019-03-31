<?php

namespace Tests\App\TestCases\MailChimp;

use App\Database\Entities\MailChimp\MailChimpList;
use App\Database\Entities\MailChimp\MailChimpMember;
use Illuminate\Http\JsonResponse;
use Mailchimp\Mailchimp;
use Mockery;
use Mockery\MockInterface;

abstract class MemberTestCase extends ListTestCase
{
    /**
     * @var MailChimpList
     */
    protected $list;

    /**
     * @var array
     */
    protected $createdMembersIds = [];

    /**
     * @var array
     */
    protected static $memberData = [
        'email_address'    => 'test-task@test.com.ua',
        'email_type'       => 'html',
        'status'           => 'subscribed',
        'language'         => 'en',
        'vip'              => false,
        'location'         => [
            'latitude'  => '13.756331',
            'longitude' => '100.501762',
        ],
        'ip_signup'        => '202.44.213.160',
        'timestamp_signup' => '2019-03-27T17:25:58+00:00',
        'ip_opt'           => '202.44.213.161',
        'timestamp_opt'    => '2019-03-27T17:28:58+00:00'
    ];

    /**
     * @var array
     */
    protected static $notRequired = [
        'email_type',
        'merge_fields',
        'language',
        'vip',
        'location',
        'ip_signup',
        'timestamp_signup',
        'ip_opt',
        'timestamp_opt',
        'tags',
    ];

    /**
     * Create MailChimpList using ListTestCase
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->post('/mailchimp/lists', static::$listData);

        $content = \json_decode($this->response->getContent(), true);

        $this->list = $this->createList($content);

        $this->createdListIds[] = $this->list->getMailChimpId(); // Store MailChimp list id for cleaning purposes
    }

    /**
     * Call MailChimp to delete members created during test.
     *
     * @return void
     */
    public function tearDown(): void
    {
        /** @var Mailchimp $mailChimp */
        $mailChimp = $this->app->make(Mailchimp::class);

        foreach ($this->createdMembersIds as $memberId) {
            // Delete list on MailChimp after test
            $mailChimp->delete(\sprintf('lists/%s/members/%s', $this->list->getMailChimpId(), $memberId));
        }

        parent::tearDown();
    }

    /**
     * Asserts error response when member not found.
     *
     * @param string $memberId
     * @param string $listId
     *
     * @return void
     */
    protected function assertMemberNotFoundResponse(string $memberId, string $listId): void
    {
        $content = \json_decode($this->response->content(), true);

        $this->assertResponseStatus(404);
        self::assertArrayHasKey('message', $content);
        self::assertEquals(\sprintf('MailChimpMember[%s] in MailChimpList[%s] not found', $memberId, $listId), $content['message']);
    }

    /**
     * Asserts error response when MailChimp exception is thrown.
     *
     * @param \Illuminate\Http\JsonResponse $response
     *
     * @return void
     */
    protected function assertMailChimpExceptionResponse(JsonResponse $response): void
    {
        $content = \json_decode($response->content(), true);

        self::assertEquals(400, $response->getStatusCode());
        self::assertArrayHasKey('message', $content);
        self::assertEquals(self::MAILCHIMP_EXCEPTION_MESSAGE, $content['message']);
    }

    /**
     * Create MailChimp member into database.
     *
     * @param array $data
     *
     * @return \App\Database\Entities\MailChimp\MailChimpMember
     */
    protected function createMember(array $data): MailChimpMember
    {
        $member = new MailChimpMember($data);
        $member->setList($this->list);

        $this->entityManager->persist($member);
        $this->entityManager->flush();

        return $member;
    }

    /**
     * Returns mock of MailChimp to trow exception when requesting their API.
     *
     * @param string $method
     *
     * @return \Mockery\MockInterface
     *
     * @SuppressWarnings(PHPMD.StaticAccess) Mockery requires static access to mock()
     */
    protected function mockMailChimpForException(string $method): MockInterface
    {
        $mailChimp = Mockery::mock(Mailchimp::class);

        $mailChimp
            ->shouldReceive($method)
            ->once()
            ->withArgs(function (string $method, ?array $options = null) {
                return !empty($method) && (null === $options || \is_array($options));
            })
            ->andThrow(new \Exception(self::MAILCHIMP_EXCEPTION_MESSAGE));

        return $mailChimp;
    }
}