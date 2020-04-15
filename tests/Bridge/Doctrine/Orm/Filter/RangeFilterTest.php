<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Core\Tests\Bridge\Doctrine\Orm\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Test\DoctrineOrmFilterTestCase;
use ApiPlatform\Core\Tests\Bridge\Doctrine\Common\Filter\RangeFilterTestTrait;
use ApiPlatform\Core\Tests\Fixtures\TestBundle\Entity\Dummy;

/**
 * @author Lee Siong Chan <ahlee2326@me.com>
 */
class RangeFilterTest extends DoctrineOrmFilterTestCase
{
    use RangeFilterTestTrait;

    protected $filterClass = RangeFilter::class;

    public function testGetDescriptionDefaultFields()
    {
        $filter = $this->buildFilter();

        $this->assertEquals([
            'range[id]' => [
                'property' => 'id',
                'type' => 'array',
                'required' => false,
                'is_collection' => true,
            ],
            'range[name]' => [
                'property' => 'name',
                'type' => 'array',
                'required' => false,
                'is_collection' => true,
            ],
            'range[alias]' => [
                'property' => 'alias',
                'type' => 'array',
                'required' => false,
                'is_collection' => true,
            ],
            'range[description]' => [
                'property' => 'description',
                'type' => 'array',
                'required' => false,
                'is_collection' => true,
            ],
            'range[dummy]' => [
                'property' => 'dummy',
                'type' => 'array',
                'required' => false,
                'is_collection' => true,
            ],
            'range[dummyDate]' => [
                'property' => 'dummyDate',
                'type' => 'array',
                'required' => false,
                'is_collection' => true,
            ],
            'range[dummyFloat]' => [
                'property' => 'dummyFloat',
                'type' => 'array',
                'required' => false,
                'is_collection' => true,
            ],
            'range[dummyPrice]' => [
                'property' => 'dummyPrice',
                'type' => 'array',
                'required' => false,
                'is_collection' => true,
            ],
            'range[jsonData]' => [
                'property' => 'jsonData',
                'type' => 'array',
                'required' => false,
                'is_collection' => true,
            ],
            'range[arrayData]' => [
                'property' => 'arrayData',
                'type' => 'array',
                'required' => false,
                'is_collection' => true,
            ],
            'range[nameConverted]' => [
                'property' => 'nameConverted',
                'type' => 'array',
                'required' => false,
                'is_collection' => true,
            ],
            'range[dummyBoolean]' => [
                'property' => 'dummyBoolean',
                'type' => 'array',
                'required' => false,
                'is_collection' => true,
            ],
        ], $filter->getDescription($this->resourceClass));
    }

    public function provideApplyTestData(): array
    {
        return array_merge_recursive(
            $this->provideApplyTestArguments(),
            [
                'between' => [
                    sprintf('SELECT o FROM %s o WHERE o.dummyPrice BETWEEN :dummyPrice_p1_1 AND :dummyPrice_p1_2', Dummy::class),
                ],
                'between (same values)' => [
                    sprintf('SELECT o FROM %s o WHERE o.dummyPrice = :dummyPrice_p1', Dummy::class),
                ],
                'between (too many operands)' => [
                    sprintf('SELECT o FROM %s o', Dummy::class),
                ],
                'between (too few operands)' => [
                    sprintf('SELECT o FROM %s o', Dummy::class),
                ],
                'between (non-numeric operands)' => [
                    sprintf('SELECT o FROM %s o', Dummy::class),
                ],
                'lt' => [
                    sprintf('SELECT o FROM %s o WHERE o.dummyPrice < :dummyPrice_p1', Dummy::class),
                ],
                'lt (non-numeric)' => [
                    sprintf('SELECT o FROM %s o', Dummy::class),
                ],
                'lte' => [
                    sprintf('SELECT o FROM %s o WHERE o.dummyPrice <= :dummyPrice_p1', Dummy::class),
                ],
                'lte (non-numeric)' => [
                    sprintf('SELECT o FROM %s o', Dummy::class),
                ],
                'gt' => [
                    sprintf('SELECT o FROM %s o WHERE o.dummyPrice > :dummyPrice_p1', Dummy::class),
                ],
                'gt (non-numeric)' => [
                    sprintf('SELECT o FROM %s o', Dummy::class),
                ],
                'gte' => [
                    sprintf('SELECT o FROM %s o WHERE o.dummyPrice >= :dummyPrice_p1', Dummy::class),
                ],
                'gte (non-numeric)' => [
                    sprintf('SELECT o FROM %s o', Dummy::class),
                ],
                'lte + gte' => [
                    sprintf('SELECT o FROM %s o WHERE o.dummyPrice >= :dummyPrice_p1 AND o.dummyPrice <= :dummyPrice_p2', Dummy::class),
                ],
            ]
        );
    }
}
