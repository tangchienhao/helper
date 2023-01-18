<?php

namespace tests\Unit\DataExchange;

use Chtang\Helper\DataExchange\Enums\Status;
use Chtang\Helper\DataExchange\JsonFormat;
use PHPUnit\Framework\TestCase;

final class JsonFormatTest extends TestCase
{
    /**
     * 測試makeResponse
     *
     * @return void
     */
    public function testMakeResponse(): void
    {
        $sampleMessage = '訊息';
        $sampleData = [['張三', 18], ['李四', 20]];
        $sampleOption = ['Option1' => '訊息1', 'Option2' => '訊息2'];

        //狀態fail、2個參數
        $response = JsonFormat::makeResponse(Status::FAIL, $sampleMessage);
        $this->assertEquals('Symfony\Component\HttpFoundation\Response', get_class($response));
        $this->assertEquals(http_response_code(200), $response->getStatusCode());
        $this->assertJson($response->getContent());

        //狀態success、2個參數
        $response = JsonFormat::makeResponse(Status::SUCCESS, $sampleMessage);
        $this->assertEquals('Symfony\Component\HttpFoundation\Response', get_class($response));
        $this->assertEquals(http_response_code(200), $response->getStatusCode());
        $this->assertJson($response->getContent());
        $this->assertEquals('success', json_decode($response->getContent())->status);
        $this->assertEquals($sampleMessage, json_decode($response->getContent())->message);

        //狀態success、3個參數
        $response = JsonFormat::makeResponse(Status::SUCCESS, $sampleMessage, $sampleData);
        $this->assertJson($response->getContent());
        $this->assertEquals('success', json_decode($response->getContent())->status);
        $this->assertEquals($sampleMessage, json_decode($response->getContent())->message);
        $this->assertEquals($sampleData, json_decode($response->getContent(), true)['data']);

        //狀態success、4個參數
        $response = JsonFormat::makeResponse(Status::SUCCESS, $sampleMessage, $sampleData, $sampleOption);
        $this->assertJson($response->getContent());
        $this->assertEquals('success', json_decode($response->getContent())->status);
        $this->assertEquals($sampleMessage, json_decode($response->getContent())->message);
        $this->assertEquals($sampleData, json_decode($response->getContent(), true)['data']);
        $this->assertEquals($sampleOption, json_decode($response->getContent(), true)['option']);

        //狀態success、5個參數
        $response = JsonFormat::makeResponse(Status::SUCCESS, $sampleMessage, $sampleData, $sampleOption, false);
        $this->assertJson($response->getContent());
    }
}
