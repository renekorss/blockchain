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
