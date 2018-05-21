<?php
/**
 * @author Timur Kasumov (aka XAKEPEHOK)
 * Datetime: 19.05.2018 21:26
 */

namespace XAKEPEHOK\FspGraphQL\Types;


use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class FspInputType extends InputObjectType
{

    public function __construct()
    {
        $config = [
            'description' => 'Filter, Sort and Paginate',
            'fields' => function() {
                return [
                    'sort' => [
                        'type' => Type::listOf(new SortType()),
                    ],
                    'paginate' => [
                        'type' => new PaginateType()
                    ],
                    'filter' => [
                        'type' => FspTypes::andGroup()
                    ],
                ];
            }
        ];
        parent::__construct($config);
    }

}