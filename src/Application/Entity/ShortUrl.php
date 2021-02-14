<?php
declare(strict_types=1);

namespace Shorty\Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Shorty\Application\Entity\ShortUrlsEntityListener;

/**
 * Class ShortUrl
 *
 * @author Dennis Wandke <dennis.wandke@mainz-allstars.de>
 *
 * @Entity
 * @EntityListeners({"Shorty\Application\Entity\ShortUrlsEntityListener"})
 * @Table(name="shorturls")
 */
class ShortUrl
{
    public const COL_HASH = 'hash';

    /**
     * @Id()
     * @Column(type="integer")
     * @GeneratedValue()
     */
    protected int $id;

    /**
     * @Column(type="string")
     */
    protected string $hash;

    /**
     * @Column(type="string")
     */
    protected string $target;

    /**
     * @Column(type="integer")
     */
    protected int $requests = 0;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $short
     */
    public function applyHash(string $short): void
    {
        if (empty($this->hash) === false) {
            throw new \DomainException('ShortUrls Short Property could not be updated.');
        }

        $this->hash = $short;
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string $target
     */
    public function setTarget(string $target): void
    {
        $this->target = $target;
    }

    /**
     * @return int
     */
    public function getRequests(): int
    {
        return $this->requests;
    }

    /**
     * @param int $requests
     */
    public function setRequests(int $requests): void
    {
        $this->requests = $requests;
    }
}