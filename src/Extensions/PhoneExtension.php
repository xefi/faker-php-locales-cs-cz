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
}
