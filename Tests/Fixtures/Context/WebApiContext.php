<?php

namespace Virhi\LazyRestApiBundle\Tests\Fixtures\Context;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use \PHPUnit_Framework_Assert;


/**
 * Feature context.
 */
class WebApiContext extends MinkContext
{
    /**
     * @var array
     */
    private $headers = array();

    /**
     * @var array
     */
    private $placeHolders = array();

    /**
     * @var string
     */
    private $expected;

    /**
     * @var array
     */
    private $credentials;

    /**
     * @var \Behat\Mink\Driver\Goutte\Client
     */
    private $client;


    public function getClient() {
        return $this->getMink()->getSession()->getDriver()->getClient();
    }

    /**
     * Adds Basic Authentication header to next request.
     *
     * @param string $username
     * @param string $password
     *
     * @Given /^I am authenticating as "([^"]*)" with "([^"]*)" password$/
     */
    public function iAmAuthenticatingAs($username, $password)
    {
        $this->credentials = array('username' => $username, 'password'=>$password);
        $this->authorization = base64_encode($username.':'.$password);
        $this->headers['Authorization'] = 'Basic '.$this->authorization;
    }

    /**
     * Sets a HTTP Header.
     *
     * @param string $name  header name
     * @param string $value header value
     *
     * @Given /^I set header "([^"]*)" with value "([^"]*)"$/
     */
    public function iSetHeaderWithValue($name, $value)
    {
        $this->addHeader($name, $value);
    }

    /**
     * Sends HTTP request to specific relative URL.
     *
     * @param string $method request method
     * @param string $url    relative url
     *
     * @When /^(?:I )?send a ([A-Z]+) request to "([^"]+)"$/
     */
    public function iSendARequest($method, $uri)
    {
        $this->getClient()->request($method, $this->replacePlaceHolder($uri), array(), array(), $this->formatHeadersAsHttp());
    }

    /**
     * Sends HTTP request to specific URL with field values from Table.
     *
     * @param string    $method request method
     * @param string    $url    relative url
     * @param TableNode $post   table of post values
     *
     * @When /^(?:I )?send a ([A-Z]+) request to "([^"]+)" with values:$/
     */
    public function iSendARequestWithValues($method, $url, TableNode $post)
    {
        $fields = array();

        $params = array();
        foreach ($post->getRowsHash() as $key => $val) {
            $params[] = urlencode($key) . '=' . urlencode($this->replacePlaceHolder($val));
        }

        parse_str(implode('&', $params), $fields);

        $this->getClient()->request($method, $this->replacePlaceHolder($url), $fields, array(), $this->formatHeadersAsHttp());
    }

    /**
     * Sends HTTP request to specific URL with raw body from PyString.
     *
     * @param string       $method request method
     * @param string       $url    relative url
     * @param PyStringNode $string request body
     *
     * @When /^(?:I )?send a ([A-Z]+) request to "([^"]+)" with body:$/
     */
    public function iSendARequestWithBody($method, $url, PyStringNode $string)
    {
        $url    = ltrim($this->replacePlaceHolder($url));
        $string = $this->replacePlaceHolder(trim($string));

        $this->getClient()->request($method, $url, array(), array(), $this->formatHeadersAsHttp(), $string);
    }

    /**
     * Sends HTTP request to specific URL with form data from PyString.
     *
     * @param string       $method request method
     * @param string       $url    relative url
     * @param PyStringNode $string request body
     *
     * @When /^(?:I )?send a ([A-Z]+) request to "([^"]+)" with form data:$/
     */
    public function iSendARequestWithFormData($method, $url, PyStringNode $string)
    {
        $url    = ltrim($this->replacePlaceHolder($url));
        $string = $this->replacePlaceHolder(trim($string));

        parse_str(implode('&', explode("\n", $string)), $fields);

        $this->getClient()->request($method, $url, $fields, array(), $this->formatHeadersAsHttp());

    }

    /**
     * Checks that response body contains specific text.
     *
     * @param string $text
     *
     * @Then /^(?:the )?DISABLEDresponse should contain "([^"]*)"$/
     * @Then /^response should contain "([^"]*)"$/
     */
    public function theResponseShouldContain($text)
    {
        PHPUnit_Framework_Assert::assertRegExp('/'.preg_quote($text).'/', $this->getClient()->getResponse()->getContent());
    }

    /**
     * Checks that response body doesn't contains specific text.
     *
     * @param string $text
     *
     * @Then /^(?:the )?DISABLEDresponse should not contain "([^"]*)"$/
     * @Then /^response should not contain "([^"]*)"$/
     */
    public function theResponseShouldNotContain($text)
    {
        PHPUnit_Framework_Assert::assertNotRegExp('/'.preg_quote($text).'/', $this->getClient()->getResponse()->getContent());
    }

    /**
     * @Then /^the response code should be (\d+)$/
     */
    public function theResponseCodeShouldBe($code)
    {
        PHPUnit_Framework_Assert::assertSame(intval($code), $this->getStatus($this->getClient()->getResponse()));
    }

    /**
     * Checks that response body contains JSON from PyString.
     *
     * @param PyStringNode $jsonString
     *
     * @Then /^(?:the )?response should contain json:$/
     */
    public function theResponseShouldContainJson(PyStringNode $jsonString)
    {
        $etalon = json_decode($this->replacePlaceHolder($jsonString->getRaw()), true);
        $actual = json_decode($this->getClient()->getResponse()->getContent(), true);

        if (null === $etalon) {
            throw new \RuntimeException(
                "Can not convert etalon to json:\n".$this->replacePlaceHolder($jsonString->getRaw())
            );
        }
        $this->expected = $etalon;
        if(null === $actual) {
            $actual = array();
        }
        PHPUnit_Framework_Assert::assertCount(sizeof($etalon), $actual);
        foreach ($actual as $key => $needle) {
            PHPUnit_Framework_Assert::assertArrayHasKey($key, $etalon);
            PHPUnit_Framework_Assert::assertEquals($etalon[$key], $actual[$key]);
        }
    }

    private function getStatus($response) {
        if(method_exists($response, 'getStatus')) {
            $code = $response->getStatus();
        } else {
            $code = $response->getStatusCode();
        }
        return $code;
    }

    /**
     * Prints last response body.
     *
     * @Then print response
     */
    public function printResponse()
    {
        $request  = $this->getClient()->getRequest();
        $response = $this->getClient()->getResponse();

        $this->printDebug(sprintf("%s %s => %d:\n%s",
            $request->getMethod(),
            $request->getUri(),
            $this->getStatus($response),
            $response->getContent()
        ));
    }

    /**
     * Sets place holder for replacement.
     *
     * you can specify placeholders, which will
     * be replaced in URL, request or response body.
     *
     * @param string $key   token name
     * @param string $value replace value
     */
    public function setPlaceHolder($key, $value)
    {
        $this->placeHolders[$key] = $value;
    }

    /**
     * Replaces placeholders in provided text.
     *
     * @param string $string
     *
     * @return string
     */
    public function replacePlaceHolder($string)
    {
        foreach ($this->placeHolders as $key => $val) {
            $string = str_replace($key, $val, $string);
        }

        return $string;
    }

    /**
     * Adds header
     *
     * @param string $header
     */
    protected function addHeader($name, $value)
    {
        if (!array_key_exists($name, $this->headers)) {
            $this->headers[$name] = array();
        }
        $this->headers[$name][] = $value;
    }

    protected function formatHeadersAsHttp() {

        $results = array();
        foreach ($this->headers as $name => $values) {
            $httpName = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
            $results[$httpName] = $values;
        }

        return $results;
    }

}