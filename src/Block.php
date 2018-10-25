<?php
/**
 * RKD Blockchain.
 *
 * @link https://github.com/renekorss/blockchain/
 *
 * @author Rene Korss <rene.korss@gmail.com>
 * @copyright 2018 Rene Korss
 * @license MIT
 */

namespace RKD\Blockchain;

use ReflectionClass;
use JsonSerializable;
use DateTimeImmutable;
use RKD\Blockchain\Contracts\Arrayable;
use RKD\Blockchain\Contracts\Comparable;

/**
 * Hashing algorithm
 */
define('HASH_ALGORITHM', 'sha256');

/**
 * Block class
 *
 * @author Rene Korss <rene.korss@gmail.com>
 */
final class Block implements JsonSerializable, Arrayable, Comparable
{
    /**
     * Block index
     *
     * @var int
     */
    private $index;

    /**
     * Block hash
     *
     * @var string
     */
    private $hash;

    /**
     * Previous block hash
     *
     * @var string
     */
    private $previousHash;

    /**
     * Block creation date and time
     *
     * @var \DateTimeImmutable
     */
    private $createdDatetime;

    /**
     * Block data
     *
     * @var string
     */
    private $data;

    /**
     * Previous block
     *
     * @var \RKD\Blockchain\Block
     */
    private $previousBlock;

    /**
     * Constructor
     *
     * @param \RKD\Blockchain\Block $previousBlock Previous block in chain
     * @param string $data Data to store in block
     *
     * @return void
     */
    public function __construct(Block $previousBlock, string $data)
    {
        $this->index = $previousBlock->getIndex() + 1;
        $this->previousHash = $previousBlock->getHash();
        $this->createdDatetime = new DateTimeImmutable();
        $this->data = $data;

        // Generate hash
        $this->hash = $this->generateHash();
        $this->previousBlock = $previousBlock;
    }

    /**
     * Generate genesis block
     *
     * @param string $data Data to store in block
     *
     * @return self
     */
    public static function genesis($data = 'Genesis block') : self
    {
        $genesis = (new ReflectionClass(__CLASS__))->newInstanceWithoutConstructor();

        $genesis->index = 0;
        $genesis->previousHash = '';
        $genesis->createdDatetime = new DateTimeImmutable();
        $genesis->data = $data;
        $genesis->hash = $genesis->generateHash();

        return $genesis;
    }

    /**
     * Get block index
     *
     * @return int Block index
     */
    public function getIndex() : int
    {
        return $this->index;
    }

    /**
     * Get block hash
     *
     * @return string Block hash
     */
    public function getHash() : string
    {
        return $this->hash;
    }

    /**
     * Get previous block hash
     *
     * @return string Previous block hash
     */
    public function getPreviousHash() : string
    {
        return $this->previousHash;
    }

    /**
     * Get block data
     *
     * @return string Block data
     */
    public function getData() : string
    {
        return $this->data;
    }

    /**
     * Detect if block is valid
     *
     * @return bool True if block is valid, false otherwise
     */
    public function isValid() : bool
    {
        // If is Genesis block, compare to our genesis block
        if ($this->getIndex() === 0) {
            return $this->compare(
                Block::genesis($this->getData())
            );
        }

        // Previous block index match
        if ($this->getIndex() !== $this->previousBlock->getIndex() + 1) {
            return false;
        }

        // Previous block hash match
        if ($this->getPreviousHash() !== $this->previousBlock->gethash()) {
            return false;
        }

        // Block hash is valid
        if ($this->getHash() !== $this->generateHash()) {
            return false;
        }

        return true;
    }

    /**
     * Generate hash for block
     *
     * @return string Generated hash
     */
    public function generateHash() : string
    {
        return hash(
            HASH_ALGORITHM,
            $this->index.
            $this->previousHash.
            $this->createdDatetime->getTimestamp().
            $this->data
        );
    }

    /**
     * Get block as array
     *
     * @return array
     *
     */
    public function toArray() : array
    {
        return [
            'index' => $this->index,
            'hash' => $this->hash,
            'previousHash' => $this->previousHash,
            'createdTime' => $this->createdDatetime->getTimestamp(),
            'data' => $this->data,
        ];
    }

    /**
     * Compare Block to another for equalness
     *
     * @param mixed $compare Comparable object
     *
     * @return bool
     */
    public function compare($compare) : bool
    {
        if (!($compare instanceof Arrayable)) {
            return false;
        }

        if (!($compare instanceof Block)) {
            return false;
        }

        return $this->toArray() === $compare->toArray();
    }

    /**
     * JsonSerializable
     *
     * @return array Blocks
     *
     * @ignore
     */
    public function jsonSerialize() : array
    {
        return $this->toArray();
    }
}
