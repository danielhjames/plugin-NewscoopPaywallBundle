<?php

/**
 * @author Rafał Muszyński <rafal.muszynski@sourcefabric.org>
 * @copyright 2015 Sourcefabric z.ú.
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 */

namespace Newscoop\PaywallBundle\Discount;

use Newscoop\PaywallBundle\Entity\DiscountInterface;

/**
 * Percentage discount.
 */
class PercentageDiscount extends Discount
{
    /**
     * {@inheritdoc}
     */
    public function applyTo(DiscountableInterface $object, DiscountInterface $discount)
    {
        $modification = $this->createModification($discount);
        $discountAmount = $discount->getValue() * $object->getToPay();
        $modificationAmount = (float) ($object->getToPay() * $discount->getValue());
        $object->setToPay(round($object->getToPay() - $discountAmount, 2));
        $modification->setAmount(-$modificationAmount);
        $object->addModification($modification);
        $object->addDiscount($discount);
    }
}
