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
