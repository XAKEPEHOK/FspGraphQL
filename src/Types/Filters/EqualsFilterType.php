<?php
/**
 * @author Timur Kasumov (aka XAKEPEHOK)
 * Datetime: 20.05.2018 0:26
 */

namespace XAKEPEHOK\FspGraphQL\Types\Filters;


use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class EqualsFilterType extends InputObjectType
{

    public function __construct()
    {
        $config = [
            'fields' => [
                'field' => [
                    'type' => Type::nonNull(Type::string()),
                    'description' => 'Field for filtering',
                ],
                'value' => [
                    'type' => Type::nonNull(Type::string()),
                ],
            ],
        ];
        parent::__construct($config);
    }

}