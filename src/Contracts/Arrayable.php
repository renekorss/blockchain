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

namespace RKD\Blockchain\Contracts;

/**
 * Arrayable interface
 */
interface Arrayable
{
    /**
     * Get object as array
     *
     * @return array
     */
    public function toArray() : array;
}
