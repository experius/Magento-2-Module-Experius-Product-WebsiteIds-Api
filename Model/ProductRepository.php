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
        } else {
            if ($product->isObjectNew()) {
                /** Objectmanager because extending the whole constructor of core ProductRepository will be too complex to maintain */
                $scopeConfig = \Magento\Framework\App\ObjectManager::getInstance()->get(\Magento\Framework\App\Config\ScopeConfigInterface::class);
                $websiteIds = $scopeConfig->getValue('webapi/experius_api_extend/product_store_autoassign');
                $websiteArray = ( $websiteIds ? explode(',', $websiteIds) : [] );
                $product->setWebsiteIds($websiteArray);
            }
        }
        return $product;
    }
}
