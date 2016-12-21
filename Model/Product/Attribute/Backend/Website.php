<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Catalog product categories backend attribute model
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
namespace Experius\ProductWebsiteIdsApi\Model\Product\Attribute\Backend;

class Website extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * Set website ids to product data
     *
     * @param \Magento\Catalog\Model\Product $object
     * @return $this
     */
    public function afterLoad($object)
    {
        $object->setData($this->getAttribute()->getAttributeCode(), $object->getWebsiteIds());
        return parent::afterLoad($object);
    }
}
