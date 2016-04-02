<?php
App::uses('Model', 'Model');

class Product extends Model
{
    public $name = "Product";
    public $belongsTo = array(
        'Store' => array(
            'className' => 'Store',
            'foreignKey' => 'store_id',
            'dependent' => true),
        'MainCategory' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id',
            'dependent' => true),
        'SubCategory' => array(
            'className' => 'Category',
            'foreignKey' => 'sub_category_id',
            'dependent' => true),
        /*'Brand' => array(
            'className' => 'Brand',
            'foreignKey' => 'brand_id',
            'dependent' => true)*/);
    public $hasMany = array(
        'ProductDetail' => array('className' => 'ProductDetail',
            'foreignKey' => 'product_id',
            'dependent' => true),
        'ProductImage' => array('className' => 'ProductImage',
            'foreignKey' => 'product_id',
            'dependent' => true));
    public $hasOne = array(
        'Deal' => array('className' => 'Deal',
            'foreignKey' => 'main_product',
            'dependent' => true));

    var $validate = array(
        'store_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please Select the store'
            )
        ),
        'product_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please Enter the Product Name'
            )
        ),
        'category_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please Select the category'
            )
        ),
        'sub_category_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please Select the sub category'
            )
        ),
        'price_option' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select the city'
            )
        )
    );

}
