<?php
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$installer->addAttribute(4, 'top Color', array(
    'group'                       => 'General',
    'type'                        => 'int',
    'input'                       => 'select',
    'label'                       => 'Top Color',
    'global'                      => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'sort_order'                  => '100',
    'required'                    => 0,
    'visible'                     => 1,
    'user_defined'                => 1,
    'searchable'                  => 1,
    'filterable'                  => 1,
    'visible_on_front'            => 1,
    'visible_in_advanced_search'  => 0,
    'is_html_allowed_on_front'    => 1,
    'comparable'                  => '',
    'default' => 'Red',
     'option' => array(
        'values' => array(
            'Red',
            'Blue',
            'Green',
            'Yellow',
            'Black',
            'White',
            'Orange',
            'Purple',
            'Pink',
            'Gray'
        )
    )
));
$installer->addAttribute(4, 'bottom Color', array(
    'group'                       => 'General',
    'type'                        => 'int',
    'input'                       => 'select',
    'label'                       => 'Bottom Color',
    'global'                      => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'sort_order'                  => '101',
    'required'                    => 0,
    'visible'                     => 1,
    'user_defined'                => 1,
    'searchable'                  => 1,
    'filterable'                  => 1,
    'visible_on_front'            => 1,
    'visible_in_advanced_search'  => 0,
    'is_html_allowed_on_front'    => 1,
    'comparable'                  => '',
    'default' => 'White',
     'option' => array(
        'values' => array(
            'Red',
            'Blue',
            'Green',
            'Yellow',
            'Black',
            'White',
            'Orange',
            'Purple',
            'Pink',
            'Gray'
        )
    )
));
$installer->endSetup();