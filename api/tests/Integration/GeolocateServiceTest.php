<?php
include 'helpers.php';

use app\Services\GeolocateService;
use PHPUnit\Framework\TestCase;

final class GeolocateServiceTest extends TestCase
{
    public function testCanBeCreatedFromValidAddress(): void
    {
        $geolocateService = new GeolocateService();

        $this->assertInstanceOf(
            GeolocateService::class,
            $geolocateService
        );
    }
    public function testCanSearchByAddress(): void
    {
        $geolocateService = new GeolocateService();
        $response = $geolocateService->searchByAddress('България, София, бул. България 111');

        $this->assertIsArray($response);
        $this->assertArrayHasKey('lat', $response);
        $this->assertArrayHasKey('lng', $response);
        $this->assertEquals('42.6555462', $response['lat']);
        $this->assertEquals('23.2853125', $response['lng']);
    }
}
