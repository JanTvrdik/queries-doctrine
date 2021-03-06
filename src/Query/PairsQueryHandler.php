<?php

declare(strict_types=1);

namespace UselessSoft\Queries\Doctrine\Query;

use Kdyby\Doctrine\EntityRepository;
use Kdyby\StrictObjects\Scream;
use UselessSoft\Queries\Doctrine\Queryable;
use UselessSoft\Queries\Doctrine\QueryHandlerInterface;
use UselessSoft\Queries\QueryInterface;

class PairsQueryHandler implements QueryHandlerInterface
{
    use Scream;

    /** @var Queryable */
    private $queryable;

    public function __construct(Queryable $queryable)
    {
        $this->queryable = $queryable;
    }

    public function handle(QueryInterface $query)
    {
        assert($query instanceof PairsQuery);

        $repository = $this->queryable->getEntityManager()
            ->getRepository($query->getEntityName());

        assert($repository instanceof EntityRepository);

        return $repository->findPairs($query->getFilter(), $query->getValue(), $query->getOrderBy(), $query->getKey());
    }

    public function supports(QueryInterface $query) : bool
    {
        return $query instanceof PairsQuery;
    }

}
