<?php
/**
 * @author Timur Kasumov (aka XAKEPEHOK)
 * Datetime: 20.05.2018 0:27
 */

namespace XAKEPEHOK\FspGraphQL\Types\Filters;


use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class FulltextSearchFilterType extends InputObjectType
{

    public function __construct()
    {
        $config = [
            'description' => 'Full-text search filter',
            'fields' => [
                'field' => [
                    'type' => Type::nonNull(Type::string()),
                    'description' => 'Field for filtering',
                ],
                'search' => [
                    'type' => Type::nonNull(Type::string()),
                    'description' => 'Search string'
                ],
            ]
        ];
        parent::__construct($config);
    }

}