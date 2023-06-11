<?php

use app\Controllers\GetLocationController;
use PHPUnit\Framework\TestCase;

final class GetLocationControllerTest extends TestCase
{
    public function testCanBeCreatedFromValidAddress(): void
    {
        $googleMapsAPI = new GetLocationController();

        $this->assertInstanceOf(
            GetLocationController::class,
            $googleMapsAPI
        );
    }
    public function testCanSearchByAddress(): void
    {
        $mock = $this->getMockBuilder(GetLocationController::class)
            ->getMock();
        $mock->expects($this->any())
            ->method('searchByAddress')
            ->will($this->returnValue(
                json_decode(json_encode([
                    'lat' => 12.3456700,
                    'lng' => 12.3456700,
                ]))
            ));

        $response = $mock->searchByAddress('България, София, бул. България 111');

        $this->assertIsNotArray($response);
        $this->assertEquals('12.3456700', $response->lat);
        $this->assertEquals('12.3456700', $response->lng);
    }
}
