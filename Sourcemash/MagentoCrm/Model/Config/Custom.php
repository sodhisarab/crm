<?php
namespace Sourcemash\MagentoCrm\Model\Config;
 
class Custom implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'OnlineFederation', 'label' => __('Online')],
            ['value' => 'Federation', 'label' => __('On Premise')]
            
        ];
    }
}