<?php
declare(strict_types=1);

/**
 * Magenizr Conceal
 * @copyright   Copyright (c) 2018 - 2022 Magenizr (https://www.magenizr.com)
 * @license     https://www.magenizr.com/license Magenizr EULA
 */

namespace Magenizr\Conceal\Plugin\Ui\Component;

use Magento\Framework\App\Request\Http;
use Magenizr\Conceal\Helper\Data as HelperData;

class ExportButton
{

    /**
     * @param HelperData $helper
     * @param Http $request
     */
    public function __construct(
        HelperData $helper,
        Http $request
    ) {
        $this->helper = $helper;
        $this->request = $request;
    }

    /**
     * Hook into UI component data
     *
     * @param \Magento\Ui\Component\MassAction $subject
     * @param array $result
     * @return mixed
     */
    public function afterPrepare(\Magento\Ui\Component\ExportButton $subject, $result)
    {
        $controllers = ['index'];
        $modules = ['Magento_Customer'];

        if ($this->helper->isEnabled()
            && in_array($this->request->getControllerModule(), $modules)
            && in_array($this->request->getControllerName(), $controllers)) {

            $config = $subject->getConfiguration();

            if (isset($config['options'])) {

                foreach ($config['options'] as $id => $option) {

                    if (in_array($option['value'], ['xml', 'csv'])) {

                        unset($config['options'][$id]);
                    }
                }

                $subject->setData('config', $config);
            }
        }

        return $result;
    }
}
