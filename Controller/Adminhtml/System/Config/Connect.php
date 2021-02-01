<?php

namespace Sourcemash\MagentoCrm\Controller\Adminhtml\System\Config;

use AlexaCRM\CRMToolkit\Client as OrganizationService;
use AlexaCRM\CRMToolkit\Settings;
use Magento\Backend\App\Action\Context;
use Psr\Log\LoggerInterface;
use Sourcemash\MagentoCrm\Helper\Data;

class Connect extends \Magento\Backend\App\Action
{
    protected $_logger;
    protected $helper;

    public function __construct(
        Context $context,
        LoggerInterface $logger,
        Data $helper
    ) {
        $this->_logger = $logger;
        $this->helper = $helper;
        parent::__construct($context);
    }

    public function execute()
    {
        $ApiUrl = $this->helper->getConfig("api_url");
        $ApiUsername = $this->helper->getConfig("api_username");
        $ApiPass = $this->helper->getConfig("api_password", true);
        $ApiMode = $this->helper->getConfig("api_method");

        $options = [
            'serverUrl' => $ApiUrl,
            'username' => $ApiUsername,
            'password' => $ApiPass,
            'authMode' => $ApiMode,
        ];

        $serviceSettings = new Settings($options);
        $service = new OrganizationService($serviceSettings);

        if ($serviceSettings->hasOrganizationData()) {
            echo "Connected";
        } else {
            die('There was an error retrieving organization data for the CRM. Please check connection settings.');
        }
    }
}
