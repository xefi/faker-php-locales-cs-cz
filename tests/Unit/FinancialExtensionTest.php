<?php

namespace Xefi\Faker\CsCz\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\Calculators\Iban;
use Xefi\Faker\CsCz\Extensions\FinancialExtension;

final class FinancialExtensionTest extends TestCase
{
    protected array $bankCodes = [];

    protected function setUp(): void
    {
        parent::setUp();

        $financialExtension = new FinancialExtension(new Randomizer());
        $this->bankCodes = (new ReflectionClass($financialExtension))->getProperty('bankCodes')->getValue($financialExtension);
    }

    public function testIban(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $iban = $this->faker->iban();

            $this->assertMatchesRegularExpression('/^CZ\d{22}$/', $iban);
            $this->assertTrue(Iban::isValid($iban));
            $this->assertContains(substr($iban, 4, 4), $this->bankCodes);

            $prefix = substr($iban, 8, 6);
            $accountNumber = substr($iban, 14, 10);

            $this->assertSame(0, $this->weightedSum($prefix, [10, 5, 8, 4, 2, 1]) % 11);
            $this->assertSame(0, $this->weightedSum($accountNumber, [6, 3, 7, 9, 10, 5, 8, 4, 2, 1]) % 11);
        }
    }

    private function weightedSum(string $digits, array $weights): int
    {
        $sum = 0;
        foreach ($weights as $index => $weight) {
            $sum += (int) $digits[$index] * $weight;
        }

        return $sum;
    }
}
