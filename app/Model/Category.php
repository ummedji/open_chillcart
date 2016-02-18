<?php
App::uses('Model', 'Model');


class Category extends Model
{
    public $name = "Category";
    var $belongsTo = array(
        'ParentGroup' =>
            array('className' => 'Category',
                'foreignKey' => 'parent_id'
            ),
    );

    var $hasMany = array(
        'ChildGroup' =>
            array('className' => 'Category',
                'foreignKey' => 'parent_id'
            ),
    );

}
