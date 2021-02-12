<?php
declare(strict_types=1);

namespace Shorty\Application\Service;

/**
 * Class ConfigService
 *
 * @author Dennis Wandke <dennis.wandke@mainz-allstars.de>
 */
class ConfigService
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getByPath(string $path, $default = null, string $delimiter = '.')
    {
        if (empty($path)) {
            return $default;
        }

        $stages = explode($delimiter, $path);
        $value = $this->config;

        do {
            $next = array_shift($stages);

            if (isset($value[$next]) === false || (empty($stages) === false && is_array($value[$next]) === false)) {
                return $default;
            }

            $value = $value[$next];

        } while (count($stages) > 0);

        return $value;
    }
}