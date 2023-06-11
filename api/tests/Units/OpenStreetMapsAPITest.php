<?php
// include 'helpers.php';

use app\Integrations\OpenStreetMapsAPI;
use PHPUnit\Framework\TestCase;

final class OpenStreetMapsAPITest extends TestCase
{
    public function testCanBeCreatedFromValidAddress(): void
    {
        $googleMapsAPI = new OpenStreetMapsAPI('България, София');

        $this->assertInstanceOf(
            OpenStreetMapsAPI::class,
            $googleMapsAPI
        );
    }
    public function testCanGenerateSearchAddressUrl(): void
    {
        $mock = $this->getMockBuilder(OpenStreetMapsAPI::class)
            ->setConstructorArgs(['България, София'])
            ->getMock();
        $mock->expects($this->any())
            ->method('generateSearchAddressUrl')
            ->will($this->returnValue('https://fakesearchaddress.com'));

        $response = $mock->generateSearchAddressUrl();

        $this->assertEquals('https://fakesearchaddress.com', $response);
    }
    public function testSearchForLocationByAddress(): void
    {
        $mock = $this->getMockBuilder(OpenStreetMapsAPI::class)
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
}
