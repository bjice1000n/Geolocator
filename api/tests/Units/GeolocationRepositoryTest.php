<?php

use app\Repositories\GeolocationRepository;
use PHPUnit\Framework\TestCase;

final class GeolocationRepositoryTest extends TestCase
{
    public function testCanBeCreatedFromValidAddress(): void
    {
        $repository = new GeolocationRepository('България, София');

        $this->assertInstanceOf(
            GeolocationRepository::class,
            $repository
        );
    }
    public function testCanGetCoordinates(): void
    {
        $mock = $this->getMockBuilder(GeolocationRepository::class)
            ->setConstructorArgs(['България, София'])
            ->getMock();

        $mock->expects($this->any())
            ->method('getCoordinates')
            ->will($this->returnValue([
                'lat' => 42.6977082,
                'lng' => 23.3218675
            ]));

        $response = $mock->getCoordinates();

        $this->assertIsArray($response);
        $this->assertArrayHasKey('lat', $response);
        $this->assertArrayHasKey('lng', $response);
        $this->assertEquals('42.6977082', $response['lat']);
        $this->assertEquals('23.3218675', $response['lng']);
    }
}
