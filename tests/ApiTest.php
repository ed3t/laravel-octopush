<?php

namespace Tests;

use Tests\TestCase;
use Octopush\Api;
use Octopush\Message;

/**
 *  Testing Api
 */
class ApiTest extends TestCase
{
    /**
     * @test
     */
    public function testIfCredentialLoginIsSet()
    {
        $this->assertNotNull(SMS_API_LOGIN, 'the login constant must be set');
    }

    /**
     * @test
     */
    public function testIfCredentialApiKeyIsSet()
    {
        $this->assertNotNull(SMS_API_KEY, 'the api key constant must be set');
    }

    /**
     * @test
     */
    public function testIfCredentialSmsSenderIsSet()
    {
        $this->assertNotNull(SMS_SENDER, 'the message sender must be set');
    }

    /**
     * @test
     * @return \Octopush\Api
     */
    public function testInvokeServiceOctopush()
    {
        $octopush = app()->make('octopush');
        $this->assertInstanceOf(Api::class, $octopush);
        return $octopush;
    }

    /**
     * @test
     * @depends testInvokeServiceOctopush
     * @param  \Octopush\Api    $octopush
     * @return \Octopush\Api
     */
    public function testGetCredit(Api $octopush)
    {
        $this->assertGreaterThan(0, $octopush->getCredit());
    }

    /**
     * @test
     * @depends testInvokeServiceOctopush
     * @param  \Octopush\Api    $octopush
     * @return \Octopush\Api
     */
    public function testGetBalance(Api $octopush)
    {
        $this->assertCount(2, $octopush->getBalance());
    }


    /**
     * @test
     * @depends testInvokeServiceOctopush
     * @param  \Octopush\Api    $octopush
     * @return \Octopush\Api
     */
    public function testGetPremiumBalance(Api $octopush)
    {
        $this->assertGreaterThan(0, $octopush->getPremiumBalance());
    }

    /**
     * @test
     * @depends testInvokeServiceOctopush
     * @param  \Octopush\Api    $octopush
     * @return \Octopush\Api
     */
    public function testGetLowCostBalance(Api $octopush)
    {
        $this->assertGreaterThan(0, $octopush->getLowCostBalance());
    }

    /**
     * @test
     * @depends testInvokeServiceOctopush
     * @param  \Octopush\Api    $octopush
     * @return \Octopush\Api
     */
    public function testCompareBalances(Api $octopush)
    {
        $this->assertGreaterThan($octopush->getPremiumBalance(), $octopush->getLowCostBalance());
    }


    /**
     * @test
     * @depends testInvokeServiceOctopush
     * @param  \Octopush\Api    $octopush
     * @return array
     */
    public function testSendSimpleMessage(Api $octopush)
    {
        $message = 'This a test from Laravel Octopush SDK';

        $isSend = $octopush->sendMessage($message, [
          'sms_recipients' => TEST_PHONE_NUMBER,
          'sms_text' => $message,
          'sms_type' => Message::SMS_LOW_COST,
          'sms_sender' => 'Octopush sdk',
          'request_mode' => Message::SIMULATION_MODE
        ]);

        $this->assertTrue($isSend);

        $response = $octopush->getResponse();
        return $response;
    }

    /**
     * @test
     * @depends testSendSimpleMessage
     * @param  array $response
     * @return void
     */
    public function testResponseSimpleMessage($response)
    {
        $this->assertEquals('000', $response['error_code']);
        $this->assertEquals('1', $response['number_of_sendings']);
        $this->assertEquals('XXXSIMULATIONXXX', $response['ticket']);
        $this->assertEmpty($response['failures']);
    }
}
