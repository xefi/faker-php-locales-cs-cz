<?php

namespace Xefi\Faker\CsCz\Extensions;

use Xefi\Faker\Extensions\FinancialExtension as BaseFinancialExtension;

class FinancialExtension extends BaseFinancialExtension
{
    /**
     * Czech bank codes (kód banky).
     *
     * @var string[]
     */
    protected array $bankCodes = [
        '0100', '0300', '0600', '0710', '0800', '2010', '2700', '3030', '5500', '6210', '6800', '8040',
    ];

    /**
     * Weights of the modulo 11 check applied to the 10-digit account number.
     *
     * @var int[]
     */
    protected array $accountNumberWeights = [6, 3, 7, 9, 10, 5, 8, 4, 2, 1];

    /**
     * Returns the locale handled by this extension.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'cs_CZ';
    }

    /**
     * Generate a Czech IBAN (CZkk + 20 digits). The default BBAN is a 4-digit bank code, a 6-digit
     * account prefix and a 10-digit account number passing the national modulo 11 check.
     *
     * @param string|null $countryCode
     * @param string|null $format      [{d} => digit, {l} => letter, {a} => any]
     *
     * @return string
     */
    public function iban(?string $countryCode = 'CZ', ?string $format = null): string
    {
        if ($format === null) {
            $format = $this->pickArrayRandomElement($this->bankCodes).'000000'.$this->accountNumber();
        }

        return parent::iban($countryCode, $format);
    }

    /**
     * Generate a 10-digit account number whose weighted digit sum is divisible by 11.
     *
     * @return string
     */
    protected function accountNumber(): string
    {
        do {
            $digits = '0'.$this->randomizer->getInt(1, 9).$this->randomizer->getBytesFromString('0123456789', 7);

            $sum = 0;
            for ($i = 0; $i < 9; $i++) {
                $sum += (int) $digits[$i] * $this->accountNumberWeights[$i];
            }

            $checkDigit = (11 - $sum % 11) % 11;
        } while ($checkDigit === 10);

        return $digits.$checkDigit;
    }
}
