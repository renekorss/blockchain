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

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * Block class tests
 *
 * @author Rene Korss <rene.korss@gmail.com>
 */

final class BlockTest extends TestCase
{
    public function testCanCreateGenesisBlock() : void
    {
        $testData = 'Custom genesis data';

        // Generate genesis block
        $genesisBlock = Block::genesis($testData);
        $this->assertTrue($genesisBlock->isValid());

        // Can set and retrieve data
        $this->assertSame($testData, $genesisBlock->getData());
    }

    public function testCanCreateBlock() : void
    {
        $blockchain = new Blockchain();
        $lastBlock = $blockchain->last();

        $testData = 'Sample data';

        // Generate next block
        $block = new Block($lastBlock, $testData);
        $this->assertTrue($block->isValid());

        // Previous hash matches
        $this->assertSame($lastBlock->getHash(), $block->getPreviousHash());

        // Index is incremented
        $this->assertSame($lastBlock->getIndex() + 1, $block->getIndex());

        // Can get same data back
        $this->assertSame($testData, $block->getData());
    }
}
