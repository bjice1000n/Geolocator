<?php

use app\Integrations\GoogleMapsAPI;
use PHPUnit\Framework\TestCase;

final class GoogleMapsAPITest extends TestCase
{
    public function testCanBeCreatedFromValidAddress(): void
    {
        $googleMapsAPI = new GoogleMapsAPI('България, София');

        $this->assertInstanceOf(
            GoogleMapsAPI::class,
            $googleMapsAPI
        );
    }
    public function testCanPrepareAddressForSearch(): void
    {
        $mock = $this->getMockBuilder(GoogleMapsAPI::class)
            ->setConstructorArgs(['България, София, бул. България 111'])
            ->getMock();
        $mock->expects($this->any())
            ->method('prepareAddressForSearch')
            ->will($this->returnValue('България,+София,+бул.+България+111'));

        $response = $mock->prepareAddressForSearch();

        $this->assertEquals('България,+София,+бул.+България+111', $response);

    }
    public function testCanGenerateSearchAddressUrl(): void
    {
        $mock = $this->getMockBuilder(GoogleMapsAPI::class)
            ->setConstructorArgs(['България, София'])
            ->getMock();
        $mock->expects($this->any())
            ->method('generateSearchAddressUrl')
            ->will($this->returnValue('https://maps.googleapis.com/maps/api/geocode/json?address=България,+София&key=KKEEYY'));

        $response = $mock->generateSearchAddressUrl();

        $this->assertEquals('https://maps.googleapis.com/maps/api/geocode/json?address=България,+София&key=KKEEYY', $response);
    }
    public function testSearchForLocationByAddress(): void
    {
        $mock = $this->getMockBuilder(GoogleMapsAPI::class)
            ->setConstructorArgs(['България, София'])
            ->getMock();
        $mock->expects($this->any())
            ->method('searchLocationByAddress')
            ->will($this->returnValue([
                'lat' => 11.0001122,
                'lng' => 11.0001122,
            ]));

        $response = $mock->searchLocationByAddress();

        $this->assertIsArray($response);
        $this->assertArrayHasKey('lat', $response);
        $this->assertArrayHasKey('lng', $response);
        $this->assertEquals('11.0001122', $response['lat']);
        $this->assertEquals('11.0001122', $response['lng']);
    }
    public function testGetCoordinates(): void
    {
        $mock = $this->getMockBuilder(GoogleMapsAPI::class)
            ->setConstructorArgs(['България, София'])
            ->getMock();
        $mock->expects($this->any())
            ->method('getCoordinates')
            ->will($this->returnValue([
                'lat' => 11.0001122,
                'lng' => 11.0001122,
            ]));

        $response = $mock->getCoordinates();

        $this->assertIsArray($response);
        $this->assertArrayHasKey('lat', $response);
        $this->assertArrayHasKey('lng', $response);
        $this->assertEquals('11.0001122', $response['lat']);
        $this->assertEquals('11.0001122', $response['lng']);
    }
}
