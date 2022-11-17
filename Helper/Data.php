<?php
declare(strict_types=1);

/**
 * Magenizr Conceal
 * @copyright   Copyright (c) 2018 - 2022 Magenizr (https://www.magenizr.com)
 * @license     https://www.magenizr.com/license Magenizr EULA
 */

namespace Magenizr\Conceal\Helper;

use Magento\Backend\Model\Auth\Session as AuthSession;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var string
     */
    private const SECTION = 'admin/magenizr_conceal';

    /**
     * @var AuthSession
     */
    private $authSession;

    /**
     * Init Constructor
     *
     * @param AuthSession $authSession
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        AuthSession $authSession,
        \Magento\Framework\App\Helper\Context $context
    ) {
        $this->authSession = $authSession;

        parent::__construct($context);
    }

    /**
     * Return status of the module
     *
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->isSetFlag('enabled');
    }

    /**
     * Use isSetFlag to check boolean fields
     *
     * @param string $field
     * @return mixed
     */
    public function isSetFlag($field)
    {
        return $this->scopeConfig->isSetFlag(
            self::SECTION . '/' . $field,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get module configuration values from core_config_data
     *
     * @param string $field
     * @return mixed
     */
    public function getConfig($field)
    {
        return $this->scopeConfig->getValue(
            self::SECTION . '/' . $field,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
