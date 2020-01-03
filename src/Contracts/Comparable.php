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
 * Comparable interface
 */
interface Comparable
{
    /**
     * Compare object to another
     *
     * @param mixed $compare Comparable object
     *
     * @return bool
     */
    public function compare($compare) : bool;
}
