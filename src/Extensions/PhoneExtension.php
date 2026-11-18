<?php

namespace Xefi\Faker\CsCz\Extensions;

use Xefi\Faker\Extensions\PhoneExtension as BasePhoneExtension;

class PhoneExtension extends BasePhoneExtension
{
    public string $indicator = '+420';

    protected array $landlineFormats = [
        '2{d}{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '3{d}{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '4{d}{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '5{d}{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
    ];

    protected array $cellFormats = [
        '60{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '70{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '72{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '73{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '77{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '79{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
    ];

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
     * Generate a phone number, keeping a separator between the indicator and the number.
     *
     * @param string|null $format
     * @param string      $separator
     * @param string|null $prefix
     *
     * @return string
     */
    public function phoneNumber(?string $format = null, string $separator = '', ?string $prefix = null): string
    {
        if ($prefix === $this->indicator) {
            $prefix .= $separator;
        }

        return parent::phoneNumber($format, $separator, $prefix);
    }
}
