<?php
/**
 * RKD Blockchain.
 *
 * @link https://github.com/renekorss/Blockchain/
 *
 * @author Rene Korss <rene.korss@gmail.com>
 * @copyright 2018 Rene Korss
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

final class BlockchainTests extends TestCase
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
        $this->assertEquals(1, count($blockchain));
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
