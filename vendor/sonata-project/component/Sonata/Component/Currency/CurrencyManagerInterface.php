<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\Component\Currency;

use Sonata\CoreBundle\Model\ManagerInterface;

/**
 * @author Hugo Briand <briand@ekino.com>
 */
interface CurrencyManagerInterface extends ManagerInterface
{
    /**
     * Finds the currency matching $currencyLabel.
     *
     * @param string $currencyLabel
     *
     * @return CurrencyInterface|null
     */
    public function findOneByLabel($currencyLabel);
}
