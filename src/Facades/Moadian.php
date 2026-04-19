<?php

namespace Shahkochaki\Moadian\Facades;

/**
 * @method static string getNonce(int $validity = 30) 
 * @method static \Shahkochaki\Moadian\Http\Response getServerInfo()
 * @method static \Shahkochaki\Moadian\Http\Response getFiscalInfo()
 * @method static \Shahkochaki\Moadian\Http\Response inquiryByUid(string $uid, string $start = '', string $end = '')
 * @method static \Shahkochaki\Moadian\Http\Response inquiryByReferenceNumbers(string $referenceId, string $start = '', string $end = '')
 * @method static \Shahkochaki\Moadian\Http\Response getRegistrationCodeInformation(string $taxID)
 * @method static \Shahkochaki\Moadian\Http\Response sendInvoice(\Shahkochaki\Moadian\Invoice $invoice)
 * 
 * @see \Shahkochaki\Moadian\Moadian
 */

use Illuminate\Support\Facades\Facade;

class Moadian extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Shahkochaki\Moadian\Moadian';
    }
}
