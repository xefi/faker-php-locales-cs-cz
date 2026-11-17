<?php

namespace Xefi\Faker\CsCz\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\CsCz\Extensions\CompanyExtension;

final class CompanyExtensionTest extends TestCase
{
    protected array $companies = [];

    protected function setUp(): void
    {
        parent::setUp();

        $companyExtension = new CompanyExtension(new Randomizer());
        $this->companies = (new ReflectionClass($companyExtension))->getProperty('companies')->getValue($companyExtension);
    }

    public function testCompany(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->companies); $i++) {
            $results[] = $this->faker->unique()->company();
        }

        $this->assertEqualsCanonicalizing(
            $this->companies,
            $results
        );
    }

    public function testIco(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $ico = $this->faker->ico();

            $this->assertMatchesRegularExpression('/^\d{8}$/', $ico);
            $this->assertIcoIsValid($ico);
        }
    }

    public function testVat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $vat = $this->faker->vat();

            $this->assertMatchesRegularExpression('/^CZ\d{8}$/', $vat);
            $this->assertIcoIsValid(substr($vat, 2));
        }
    }

    private function assertIcoIsValid(string $ico): void
    {
        $sum = 0;
        foreach ([8, 7, 6, 5, 4, 3, 2] as $index => $weight) {
            $sum += (int) $ico[$index] * $weight;
        }

        $remainder = $sum % 11;
        $expected = match ($remainder) {
            0 => 1,
            1 => 0,
            default => 11 - $remainder,
        };

        $this->assertSame($expected, (int) $ico[7]);
    }
}
