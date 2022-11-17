<?php
declare(strict_types=1);

/**
 * Magenizr Conceal
 * @copyright   Copyright (c) 2018 - 2022 Magenizr (https://www.magenizr.com)
 * @license     https://www.magenizr.com/license Magenizr EULA
 */

namespace Magenizr\Conceal\Plugin\Export;

use Magenizr\Conceal\Helper\Data as HelperData;

class Entity
{
    /**
     * @var HelperData
     */
    private $helper;

    /**
     * Init Constructor
     *
     * @param \Magento\ImportExport\Model\Export\ConfigInterface $exportConfig
     * @param HelperData $helper
     */
    public function __construct(
        \Magento\ImportExport\Model\Export\ConfigInterface $exportConfig,
        HelperData $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * Remove items from option array
     *
     * @param \Magento\ImportExport\Model\Source\Export\Entity $subject
     * @param array $result
     * @return mixed
     */
    public function afterToOptionArray(\Magento\ImportExport\Model\Source\Export\Entity $subject, $result)
    {

        if (!$this->helper->isEnabled()) {
            return $result;
        }

        foreach ($result as $entityName => $entityConfig) {

            if (in_array($entityConfig['value'], ['customer', 'customer_address'])) {

                unset($result[$entityName]);
            }
        }

        return $result;
    }
}
