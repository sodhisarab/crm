<?php

namespace Sourcemash\MagentoCrm\Helper;

use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\User\Model\ResourceModel\User\Collection as AdminUserCollection;

class Data extends AbstractHelper
{

    /**
     * Configuration Const Variable
     */
    const CRM_CONFIGURATION_PATH = 'sm_magentocrm/general/';

    /**
     * @var AdminUserCollection
     */
    private $_adminUserCollection;

    /**
     * @var CustomerSession
     */
    private $_customerSession;

    /**
     * @var ScopeConfigInterface
     */
    private $_scopeConfig;

    /**
     * @var EncryptorInterface
     */
    protected $_encryptor;

    /**
     * Data constructor.
     * @param Context $context
     * @param CustomerSession $customerSession
     * @param ScopeConfigInterface $scopeConfig
     * @param AdminUserCollection $adminUserCollection
     * @param EncryptorInterface $encryptor
     */
    public function __construct(
        Context $context,
        CustomerSession $customerSession,
        ScopeConfigInterface $scopeConfig,
        AdminUserCollection $adminUserCollection,
        EncryptorInterface $encryptor
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_customerSession = $customerSession;
        $this->_adminUserCollection = $adminUserCollection;
        $this->_encryptor = $encryptor;
        return parent::__construct($context);
    }

    /**
     * @param $fieldId
     * @return mixed
     */

    public function getConfig($fieldId, $is_crypt = false)
    {
        $value = $this->_scopeConfig->getValue(self::CRM_CONFIGURATION_PATH . $fieldId, ScopeInterface::SCOPE_STORE);

        if ($is_crypt) {
            return $this->_encryptor->decrypt($value);
        }
        return $value;
    }
}
