<?php
/**
 * Venustheme
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Venustheme.com license that is
 * available through the world-wide-web at this URL:
 * http://www.venustheme.com/license-agreement.html
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   Venustheme
 * @package    Ves_BaseWidget
 * @copyright  Copyright (c) 2014 Venustheme (http://www.venustheme.com/)
 * @license    http://www.venustheme.com/LICENSE-1.0.html
 */
namespace Ves\BaseWidget\Block\Widget;
use Ves\BaseWidget\Block\AbstractProductWidget;
use Magento\Framework\Url;

class Singleproduct extends AbstractProductWidget{

    /** @var UrlBuilder */
    protected $actionUrlBuilder;


    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \Magento\Cms\Model\Block $blockModel,
        \Ves\BaseWidget\Helper\Data $dataHelper,
        \Magento\Catalog\Model\Product $productModel,
        Url $actionUrlBuilder,
        array $data = []
        ) {
        parent::__construct($context, $urlHelper, $blockModel, $dataHelper, $productModel, $data);
        $this->actionUrlBuilder = $actionUrlBuilder;
        if($this->hasData("template")) {
            $my_template = $this->getData("template");
        } elseif(isset($data['template']) && $data['template']) {
            $my_template = $data['template'];
        } else{
            $my_template = "widget/single_product.phtml";
        }

        $this->setTemplate($my_template);


    }

}