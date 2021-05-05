<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Oms\Communication\Plugin\Condition;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface;


class IsExternalDeliveryPlugin extends AbstractPlugin implements ConditionInterface
{
    /**
     * {@inheritDoc}
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     * @api
     *
     */
    public function check(SpySalesOrderItem $orderItem)
    {
        $requestDate = $orderItem->getSpySalesShipment()->getRequestedDeliveryDate();
        $nextDeliveryDate = date("Y-m-d", strtotime("+1 week"));
        if ($requestDate < $nextDeliveryDate) {
            return false;
        }

        return true;
    }
}
