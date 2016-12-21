<?php

namespace Experius\ProductWebsiteIdsApi\Model;

class ProductRepository extends \Magento\Catalog\Model\ProductRepository
{
    
    /**
     * Merge data from DB and updates from request
     *
     * @param array $productData
     * @param bool $createNew
     * @return \Magento\Catalog\Api\Data\ProductInterface|Product
     * @throws NoSuchEntityException
     */
    protected function initializeProductData(array $productData, $createNew)
    {
        $websiteIds = null;
        if (isset($productData['website_ids'])){
            $websiteIds = $productData['website_ids'];
        }
        $product = parent::initializeProductData($productData, $createNew);
        if ($websiteIds){
            if (!$this->storeManager->hasSingleStore()) {
                $product->setWebsiteIds(array_unique($websiteIds));
            }
        }
        return $product;
    }
}
