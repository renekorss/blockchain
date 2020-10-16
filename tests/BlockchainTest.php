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

use IteratorAggregate;
use PHPUnit\Framework\TestCase;

/**
 * Main blockchain class tests
 *
 * @author Rene Korss <rene.korss@gmail.com>
 */

final class BlockchainTest extends TestCase
{
    public function testCanCreateBlockchain() : void
    {
        $blockchain = new Blockchain();
        $this->assertTrue($blockchain->isValid());
    }

    public function testCanGetBlocksCount() : void
    {
        $blockchain = new Blockchain();

        // Only has genesis block, so result should be 1
        $this->assertCount(1, $blockchain);
    }

    public function testBlockchainIsTraversable() : void
    {
        $blockchain = new Blockchain();

        // Is traversable
        $this->assertInstanceOf(IteratorAggregate::class, $blockchain);

        foreach ($blockchain as $i => $block) {
            $this->assertInstanceOf(Block::class, $block);
            $this->assertEquals($block->getIndex(), $i, 'Block index dosen\'t match.');
        }
    }
}
