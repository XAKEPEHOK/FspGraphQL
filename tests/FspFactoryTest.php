<?php
/**
 * Created for djin-graphql-fsp.
 * Datetime: 21.05.2018 14:31
 * @author Timur Kasumov aka XAKEPEHOK
 */

namespace XAKEPEHOK\FspGraphQL;

use DjinORM\Components\FilterSortPaginate\Filters\AndFilter;
use DjinORM\Components\FilterSortPaginate\Filters\BetweenFilter;
use DjinORM\Components\FilterSortPaginate\Filters\CompareFilter;
use DjinORM\Components\FilterSortPaginate\Filters\EmptyFilter;
use DjinORM\Components\FilterSortPaginate\Filters\EqualsFilter;
use DjinORM\Components\FilterSortPaginate\Filters\FilterInterface;
use DjinORM\Components\FilterSortPaginate\Filters\FulltextSearchFilter;
use DjinORM\Components\FilterSortPaginate\Filters\InFilter;
use DjinORM\Components\FilterSortPaginate\Filters\NotBetweenFilter;
use DjinORM\Components\FilterSortPaginate\Filters\NotEmptyFilter;
use DjinORM\Components\FilterSortPaginate\Filters\NotEqualsFilter;
use DjinORM\Components\FilterSortPaginate\Filters\NotInFilter;
use DjinORM\Components\FilterSortPaginate\Filters\NotWildcardFilter;
use DjinORM\Components\FilterSortPaginate\Filters\OrFilter;
use DjinORM\Components\FilterSortPaginate\Filters\WildcardFilter;
use DjinORM\Components\FilterSortPaginate\FilterSortPaginate;
use DjinORM\Components\FilterSortPaginate\Paginate;
use DjinORM\Components\FilterSortPaginate\Sort;
use PHPUnit\Framework\TestCase;

class FspFactoryTest extends TestCase
{
    /** @var array */
    private $array;

    /** @var Paginate */
    private $paginate;

    /** @var Sort */
    private $sort;

    /** @var FilterInterface */
    private $filter;

    /** @var FilterSortPaginate */
    private $fsp;

    /** @var FspFactory */
    private $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->array = [
            'sort' => [
                ['by' => 'field_1', 'direction' => -1],
                ['by' => 'field_2', 'direction' => 1],
            ],
            'paginate' => [
                'number' => 10,
                'size' => 50,
            ],
            'filter' => [
                ['or' => [
                    ['or' => [
                        ['and' => [
                            ['between' => ['field' => 'field_1', 'min' => '2018-01-01', 'max' => '2018-12-31']],
                            ['compare' => ['field' => 'field_2', 'comparator' => '>', 'value' => '500']],
                            ['empty' => ['field' => 'field_3', 'empty' => true]],
                            ['empty' => ['field' => 'field_4', 'empty' => false]],
                            ['equals' => ['field' => 'field_5', 'value' => 'value']],
                            ['fulltextSearch' => ['field' => 'field_6', 'search' => 'hello world']],
                            ['in' => ['field' => 'field_7', 'values' => ['1', '2', '3', '4', 'five', 'six']]],
                            ['wildcard' => ['field' => 'field_8', 'wildcard' => '*hello ?????!']],
                            ['notBetween' => ['field' => 'field_9', 'min' => '100', 'max' => '200']],
                            ['notEquals' => ['field' => 'field_10', 'value' => 'not-value']],
                            ['notIn' => ['field' => 'field_11', 'values' => ['9', '8', '7']]],
                            ['notWildcard' => ['field' => 'field_12', 'wildcard' => '*hello ?????!']],
                        ]],
                        ['and' => [
                            ['empty' => ['field' => 'field_1', 'empty' => false]],
                            ['compare' => ['field' => 'field_1', 'comparator' => '<', 'value' => '10000']],
                        ]],
                    ]],
                    ['between' => ['field' => 'datetime', 'min' => '2018-01-01', 'max' => '2018-12-31']],
                ]],
            ],
        ];

        $this->paginate = new Paginate(10, 50);

        $this->sort = new Sort(['field_1' => Sort::SORT_DESC, 'field_2' => Sort::SORT_ASC]);

        $this->filter = new OrFilter([
            new OrFilter([
                new AndFilter([
                    new BetweenFilter('field_1', '2018-01-01', '2018-12-31'),
                    new CompareFilter('field_2', CompareFilter::GREAT_THAN, 500),
                    new EmptyFilter('field_3'),
                    new NotEmptyFilter('field_4'),
                    new EqualsFilter('field_5', 'value'),
                    new FulltextSearchFilter('field_6', 'hello world'),
                    new InFilter('field_7', [1, 2, 3, 4, 'five', 'six']),
                    new WildcardFilter('field_8', '*hello ?????!'),
                    new NotBetweenFilter('field_9', 100, 200),
                    new NotEqualsFilter('field_10', 'not-value'),
                    new NotInFilter('field_11', [9, 8, 7]),
                    new NotWildcardFilter('field_12', '*hello ?????!'),
                ]),
                new AndFilter([
                    new NotEmptyFilter('field_1'),
                    new CompareFilter('field_1', CompareFilter::LESS_THAN, 10000),
                ]),
            ]),
            new BetweenFilter('datetime', '2018-01-01', '2018-12-31')
        ]);

        $this->fsp = new FilterSortPaginate($this->paginate, $this->sort, $this->filter);

        $this->factory = new FspFactory();
    }

    public function testCreate()
    {
        $this->assertEquals(
            $this->fsp,
            $this->factory->create($this->array)
        );
    }
}
