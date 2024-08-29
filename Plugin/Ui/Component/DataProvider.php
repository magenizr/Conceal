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

class DataProvider
{
    protected $helper;
    protected $request;
    
    /**
     * Init Constructor
     *
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
     * @param \Magento\Ui\Component\DataProvider $subject
     * @param array $result
     * @return mixed
     */
    public function afterGetData($subject, $result)
    {
        if (!$this->helper->isEnabled()) {
            return $result;
        }

        if (isset($result['items'])) {

            foreach ($result['items'] as &$item) {

                // Mask customers email address
                if (!empty($item['email'])) {

                    $len = intval(strlen($item['email']) / 2);

                    $item['email'] = substr_replace($item['email'], str_repeat('*', $len), 4, $len);
                }

                // Mask customers phone number
                if (!empty($item['billing_telephone'])) {

                    $item['billing_telephone'] = substr($item['billing_telephone'], 0, -4) . '****';
                }
            }

            return $result;
        }
    }
}
