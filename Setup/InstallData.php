<?php


namespace Experius\ProductWebsiteIdsApi\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * phpcs:ignoreFile
 */
class InstallData implements InstallDataInterface {

	private $eavSetupFactory;


	public function __construct(EavSetupFactory $eavSetupFactory){
		$this->eavSetupFactory = $eavSetupFactory;
	}

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
	public function install(
		ModuleDataSetupInterface $setup,
		ModuleContextInterface $context
	){
		$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'website_ids',
            [
                'type' => 'static',
                'label' => 'Websites',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'backend' => 'Experius\ProductWebsiteIdsApi\Model\Product\Attribute\Backend\Website',
                'required' => false,
                'sort_order' => 9,
                'visible' => false,
                'group' => 'General',
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
            ]
        );

	}
}
