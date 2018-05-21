<?php
/**
 * @author Timur Kasumov (aka XAKEPEHOK)
 * Datetime: 20.05.2018 0:31
 */

namespace XAKEPEHOK\FspGraphQL\Types\Filters;


use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class WildcardFilterType extends InputObjectType
{

    public function __construct()
    {
        $config = [
            'description' => 'Wildcard (mask) filter',
            'fields' => [
                'field' => [
                    'type' => Type::nonNull(Type::string()),
                    'description' => 'Field for filtering',
                ],
                'wildcard' => [
                    'type' => Type::nonNull(Type::string()),
                    'description' => '`*` - matches any number of characters, even zero characters. `?` - matches exactly one character'
                ],
            ],
        ];
        parent::__construct($config);
    }

}