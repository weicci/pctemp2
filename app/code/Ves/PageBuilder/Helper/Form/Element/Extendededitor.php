<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Form text element
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace Ves\PageBuilder\Helper\Form\Element;

use Magento\Framework\View\LayoutInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Factory;
use Magento\Framework\Data\Form\Element\CollectionFactory;

class Extendededitor extends AbstractElement
{
    /**
     * Block factory
     * @var \Magento\Framework\View\Element\BlockFactory
     */
    protected $_layout;
    /**
     * @param Factory $factoryElement
     * @param CollectionFactory $factoryCollection
     * @param Escaper $escaper
     * @param array $data
     */
    public function __construct(
        Factory $factoryElement,
        LayoutInterface $_layout,
        CollectionFactory $factoryCollection,
        Escaper $escaper,
        $data = []
    ) {
        parent::__construct($factoryElement, $factoryCollection, $escaper, $data);

        $this->_layout = $_layout;
        $this->setType('hidden');
        $this->setExtType('hiddenfield');
    }

    /**
     * Get the HTML
     *
     * @return mixed
     */
    public function getHtml()
    {
        $this->addClass('input-text admin__control-text');
        return parent::getHtml();
    }

    public function getElementHtml()
    {
        $class = 'Ves\BaseWidget\Block\Adminhtml\Editor';
        if (!class_exists($class)) {
            throw new \InvalidArgumentException(
                (string)new \Magento\Framework\Phrase('Invalid Block class name: %1', [$class])
            );
        }
        $params = array();
        $params['value'] = $this->getEscapedValue();
        $params['model'] = $this->getModelData();
        $id = $this->getBlockId();
        
        $html = '<div class="admin__field field field-prefix_class "><div id="'.$id.'" class="container-fluid editor_wrapper">';

        $html .= $this->_layout->createBlock(
            $class, 'pagebuilder.editor', $params
            )->toHtml();

        $html.= '</div></div>';
        $html.= $this->getAfterElementHtml();
        return $html;
    }

    public function getLabelHtml($idSuffix = ''){
        if (!is_null($this->getLabel())) {
            $html = '<label for="'.$this->getHtmlId() . $idSuffix . '" style="'.$this->getLabelStyle().'">'.$this->getLabel()
                . ( $this->getRequired() ? ' <span class="required">*</span>' : '' ).'</label>'."\n";
        }
        else {
            $html = '';
        }
        return $html;
    }
   
}