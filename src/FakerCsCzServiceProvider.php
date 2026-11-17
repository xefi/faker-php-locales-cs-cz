<?php

namespace Xefi\Faker\CsCz;

use Xefi\Faker\CsCz\Extensions\AddressExtension;
use Xefi\Faker\CsCz\Extensions\ColorsExtension;
use Xefi\Faker\CsCz\Extensions\CompanyExtension;
use Xefi\Faker\CsCz\Extensions\FinancialExtension;
use Xefi\Faker\CsCz\Extensions\PersonExtension;
use Xefi\Faker\CsCz\Extensions\PhoneExtension;
use Xefi\Faker\CsCz\Extensions\TextExtension;
use Xefi\Faker\Providers\Provider;

class FakerCsCzServiceProvider extends Provider
{
    /**
     * Register the cs_CZ extensions.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->extensions([
            AddressExtension::class,
            ColorsExtension::class,
            CompanyExtension::class,
            FinancialExtension::class,
            PersonExtension::class,
            PhoneExtension::class,
            TextExtension::class,
        ]);
    }
}
