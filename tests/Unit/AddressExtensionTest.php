<?php

namespace Xefi\Faker\CsCz\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\CsCz\Extensions\AddressExtension;

final class AddressExtensionTest extends TestCase
{
    protected AddressExtension $extension;
    protected array $regions = [];
    protected array $cities = [];
    protected array $streetNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->extension = new AddressExtension(new Randomizer());
        $reflection = new ReflectionClass($this->extension);

        $this->regions = $reflection->getProperty('regions')->getValue($this->extension);
        $this->cities = $reflection->getProperty('cities')->getValue($this->extension);
        $this->streetNames = $reflection->getProperty('streetNames')->getValue($this->extension);
    }

    public function testRegion(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->regions); $i++) {
            $results[] = $this->faker->unique()->region();
        }

        $this->assertEqualsCanonicalizing(
            $this->regions,
            $results
        );
    }

    public function testCity(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->cities); $i++) {
            $results[] = $this->faker->unique()->city();
        }

        $this->assertEqualsCanonicalizing(
            $this->cities,
            $results
        );
    }

    public function testStreetName(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->streetNames); $i++) {
            $results[] = $this->faker->unique()->streetName();
        }

        $this->assertEqualsCanonicalizing(
            $this->streetNames,
            $results
        );
    }

    public function testPostcode(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^[1-7]\d{2} \d{2}$/', $this->faker->postcode());
        }
    }

    public function testHouseNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->houseNumber();

            $this->assertMatchesRegularExpression('/^\d{1,4}(\/\d{1,3})?$/', $result);
            $this->assertGreaterThanOrEqual(1, (int) $result);
            $this->assertLessThanOrEqual(3500, (int) $result);
        }
    }

    public function testStreetAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->streetAddress();

            $this->assertMatchesRegularExpression('/^[\p{L} ]+ \d{1,4}(\/\d{1,3})?$/u', $result);
            $this->assertContains(preg_replace('/ [\d\/]+$/', '', $result), $this->streetNames);
        }
    }

    public function testFullAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->fullAddress();

            $this->assertMatchesRegularExpression('/^[\p{L} ]+ \d{1,4}(\/\d{1,3})?, [1-7]\d{2} \d{2} [\p{L}\- ]+$/u', $result);
            $this->assertContains(preg_replace('/^.*, \d{3} \d{2} /', '', $result), $this->cities);
        }
    }
}
