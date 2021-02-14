<?php
declare(strict_types=1);

namespace Shorty\Application\Config;

use MyCLabs\Enum\Enum;

/**
 * Class EnvironmentsEnum
 *
 * @author Dennis Wandke <dennis.wandke@mainz-allstars.de>
 *
 * @method self DEVELOP() Develop Environment
 * @method self PRODUCTION() Production Environment
 */
class EnvironmentsEnum extends Enum
{
    public const DEVELOP = 'develop';
    public const PRODUCTION = 'production';
}