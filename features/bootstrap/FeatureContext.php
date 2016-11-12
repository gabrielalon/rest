<?php

namespace ISklep\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Coduo\PHPMatcher\Factory\SimpleFactory;
use ISklep\API\Client;
use ISklep\API\ClientFactory;
use ISklep\API\Credentials;
use ISklep\API\Mappers\MapperObjectInterface;
use ISklep\Behat\Context\Traits\PaymentMethodTrait;
use ISklep\Behat\Context\Traits\ProducerTrait;
use ISklep\Behat\Context\Traits\StatusTrait;
use PHPUnit_Framework_Assert as Asserts;

class FeatureContext
    implements Context
{
    use ProducerTrait;
    use PaymentMethodTrait;
    use StatusTrait;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * @param $host
     * @param $login
     * @param $pass
     */
    public function __construct(
        $host,
        $login,
        $pass
    ) {
        $this
            ->setHost($host)
            ->setCredentials($login, $pass);
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     *
     * @return FeatureContext
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return Credentials
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @param $login
     * @param $pass
     *
     * @return FeatureContext
     */
    public function setCredentials($login, $pass)
    {
        $this->credentials = (new Credentials())
            ->setUsername($login)
            ->setPassword($pass);

        return $this;
    }

    /**
     * @param MapperObjectInterface|null $mapper
     *
     * @return Client
     */
    public function getClient($mapper = null)
    {
        $logger = new InMemoryLogger();
        $logger->clear();

        return ClientFactory::create(
            $this->getHost(),
            $this->getCredentials(),
            $mapper,
            $logger
        );
    }

    /**
     * @Then the :query :what should contain json:
     *
     * @param string       $query
     * @param string       $what
     * @param PyStringNode $jsonString
     */
    public function producerResponseShouldContain($query, $what, PyStringNode $jsonString)
    {
        $logger = new InMemoryLogger();
        $logs = $logger->getLog('info');

        $matcher = (new SimpleFactory())
            ->createMatcher();
        $current = $logs[sprintf(
            '%s::%s::%s',
            Client::class,
            $query,
            $what
        )];

        switch ($what) {
            case 'response':
                $current = $current['body'];
                break;
            default:
                break;
        }

        $expected = (string)$jsonString;
        if (!$matcher->match($current, $expected)) {
            Asserts::fail($matcher->getError());
        }
    }
}
