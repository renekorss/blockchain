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

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * Block class tests
 *
 * @author Rene Korss <rene.korss@gmail.com>
 */

final class BlockTests extends TestCase
{
    public function testCanCreateGenesisBlock() : void
    {
        $testData = 'Custom genesis data';

        // Generate genesis block
        $genesisBlock = Block::genesis($testData);
        $this->assertTrue($genesisBlock->isValid());

        // Can set and retrieve data
        $this->assertEquals($genesisBlock->getData(), $testData);
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
        $this->assertEquals($block->getPreviousHash(), $lastBlock->getHash());

        // Index is incremented
        $this->assertEquals($block->getIndex(), $lastBlock->getIndex() + 1);

        // Can get same data back
        $this->assertEquals($block->getData(), $testData);
    }
}
