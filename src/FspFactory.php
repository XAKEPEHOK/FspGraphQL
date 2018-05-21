<?php
/**
 * Created for djin-graphql-fsp.
 * Datetime: 21.05.2018 13:47
 * @author Timur Kasumov aka XAKEPEHOK
 */

namespace XAKEPEHOK\FspGraphQL;


use Adbar\Dot;
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
use DjinORM\Components\FilterSortPaginate\FilterSortPaginateFactory;
use DjinORM\Components\FilterSortPaginate\Sort;

class FspFactory extends FilterSortPaginateFactory
{

    public function __construct(int $defaultPageSize = 20)
    {
        parent::__construct($defaultPageSize);
        $filters = [
            '$between' => function(string $field, array $params) {
                return new BetweenFilter($field, $params['min'], $params['max']);
            },
            '$compare' => function(string $field, array $params) {
                return new CompareFilter($field, $params['comparator'], $params['value']);
            },
            '$empty' => function(string $field, array $params) {
                return $params['empty'] ? new EmptyFilter($field) : new NotEmptyFilter($field);
            },
            '$equals' => function(string $field, array $params) {
                return new EqualsFilter($field, $params['value']);
            },
            '$fulltextSearch' => function(string $field, array $params) {
                return new FulltextSearchFilter($field, $params['search']);
            },
            '$in' => function(string $field, array $params) {
                return new InFilter($field, $params['values']);
            },
            '$wildcard' => function(string $field, array $params) {
                return new WildcardFilter($field, $params['wildcard']);
            },
            '$notBetween' => function(string $field, array $params) {
                return new NotBetweenFilter($field, $params['min'], $params['max']);
            },
            '$notEquals' => function(string $field, array $params) {
                return new NotEqualsFilter($field, $params['value']);
            },
            '$notIn' => function(string $field, array $params) {
                return new NotInFilter($field, $params['values']);
            },
            '$notWildcard' => function(string $field, array $params) {
                return new NotWildcardFilter($field, $params['wildcard']);
            },
        ];
        foreach ($filters as $alias => $callback) {
            $this->addFilter($alias, $callback);
        }
    }

    protected function parseSort(Dot $data): ?Sort
    {
        $sort = null;
        if ($data->has('sort')) {
            $sort = new Sort();
            foreach ($data->get('sort') as $sortData) {
                $sortBy = $sortData['by'];
                if ($this->canUseField($sortBy)) {
                    $sort->add($sortBy, (int) $sortData['direction']);
                }
            }
            if (empty($sort->get())) {
                $sort = null;
            }
        }
        return $sort;
    }

    protected function parseFilters(Dot $data): ?FilterInterface
    {
        if ($data->has('filters')) {
            return $this->parse(['and' => $data->get('filters')]);
        } else {
            return null;
        }
    }

    /**
     * @param array $filters
     * @return FilterInterface|null
     * @throws \DjinORM\Components\FilterSortPaginate\Exceptions\UnsupportedFilterException
     */
    private function parse(array $filters): ?FilterInterface
    {
        foreach ($filters as $filterOrOperation => $conditions) {
            if (in_array($filterOrOperation, ['or', 'and'])) {
                $operation = $filterOrOperation;
                $filters = [];
                foreach ($conditions as $condition) {
                    if ($filter = $this->parse($condition)) {
                        $filters[] = $filter;
                    }
                }

                if (empty($filters)) {
                    return null;
                }

                if (count($filters) == 1) {
                    return current($filters);
                }

                return $operation == 'and' ? new AndFilter($filters) : new OrFilter($filters);
            } else {
                $filter = '$' . $filterOrOperation;
                $field = $conditions['field'];
                return $this->createFilter($field, $filter, $conditions);
            }
        }
        return null;
    }

}