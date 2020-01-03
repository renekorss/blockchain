<?php
/**
 * RKD Blockchain.
 *
 * @link https://github.com/renekorss/blockchain/
 *
 * @author Rene Korss <rene.korss@gmail.com>
 * @copyright 2020 Rene Korss
 * @license MIT
 */

namespace RKD\Blockchain;

use Countable;
use ArrayIterator;
use JsonSerializable;
use IteratorAggregate;

/**
 * Main blockchain class
 *
 * @author Rene Korss <rene.korss@gmail.com>
 */

final class Blockchain implements Countable, JsonSerializable, IteratorAggregate
{
    /**
     * Holds blocks
     *
     * @var array
     */
    private $blocks = [];

    /**
     * Constructor
     *
     * Add genesis block
     *
     * @return void
     */
    public function __construct()
    {
        // Add genesis block
        $this->add(
            Block::genesis()
        );
    }

    /**
     * Add block to blockchain
     *
     * @param \RKD\Blockchain\Block $block Block to add to chain
     *
     * @return self
     */
    public function add(Block $block) : self
    {
        $this->blocks[] = $block;
        return $this;
    }

    /**
     * Detect if blockchain is valid
     */
    public function isValid() : bool
    {
        // No blocks means no genesis block, invalid chain
        if (count($this) === 0) {
            return false;
        }

        // Chain has valid genesis block
        $genesis = reset($this->blocks);
        if (!$genesis->compare(Block::genesis())) {
            return false;
        }

        // Check every block for validity
        foreach ($this as $block) {
            if (!$block->isValid()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get last block in chain
     */
    public function last() : Block
    {
        return end($this->blocks);
    }

    /**
     * Countable
     *
     * @return int Count of block in blockhain
     *
     * @ignore
     */
    public function count() : int
    {
        return count($this->blocks);
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
        return $this->blocks;
    }

    /**
     * Get blocks iterator
     *
     * @return \ArrayIterator
     *
     * @ignore
     */
    public function getIterator() : ArrayIterator
    {
        return new ArrayIterator($this->blocks);
    }
}
