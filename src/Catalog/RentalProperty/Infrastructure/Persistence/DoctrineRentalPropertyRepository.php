<?php

namespace App\Catalog\RentalProperty\Infrastructure\Persistence;

use App\Catalog\RentalProperty\Domain\RentalProperty;
use App\Catalog\RentalProperty\Domain\RentalPropertyRepository;
use App\Catalog\Shared\Domain\Property\PropertyGallery;
use App\Catalog\Shared\Domain\Property\PropertyId;
use App\Catalog\Shared\Domain\Property\PropertyTitle;
use App\Shared\Domain\ValueObject\BoolValueObject;
use App\Tests\Catalog\Shared\Domain\Property\PropertyCommonCharacteristicsMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyDescriptionMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyLocationMother;
use App\Tests\Catalog\Shared\Domain\Property\PropertyPriceMother;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Persistence\ManagerRegistry;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;

final class DoctrineRentalPropertyRepository extends DoctrineRepository implements RentalPropertyRepository
{
    public function __construct(private ManagerRegistry $manager_registry, protected Connection $connection)
    {
        parent::__construct($manager_registry,$connection);
    }

    protected static function entityClass(): string
    {
        return RentalProperty::class;
    }

    public function save(RentalProperty $property): void
    {
        $this->saveEntity($property);
    }

    public function findById(PropertyId $id): ?RentalProperty
    {
        return $this->findWithORM($id);
        return $this->findWithQueryBuilder($id);
        return $this->findWithDQL($id);
        return $this->findWithNativeQuery($id);
        return $this->findWithSQL($id);
    }

    private function findWithORM(PropertyId $id): ?RentalProperty
    {
        return $this->object_repository->find($id);
    }
    private function findWithQueryBuilder(PropertyId $id): ?RentalProperty
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $query = $qb->select(['rp'])
            ->from('App\Catalog\RentalProperty\Domain\RentalProperty', 'rp')
            ->where($qb->expr()->eq('rp.id', ':id'))
            ->setParameter('id', $id)
            ->getQuery();
        return $query->getOneOrNullResult();
    }

    private function findWithDQL(PropertyId $id): ?RentalProperty
    {
        $query = $this->getEntityManager()->createQuery('SELECT rp FROM App\Catalog\RentalProperty\Domain\RentalProperty rp WHERE rp.id = :id');
        $query->setParameter('id', $id);
        return $query->getOneOrNullResult();
    }

    private function findWithNativeQuery(PropertyId $id): ?RentalProperty
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata(RentalProperty::class, 'rp');

        $query = $this->getEntityManager()->createNativeQuery(
            'SELECT * FROM rental_properties rp WHERE rp.id = :id',
            $rsm
        );
        $query->setParameter('id', $id);
        return $query->getOneOrNullResult();
    }

    private function findWithSQL(PropertyId $id): ?RentalProperty
    {
        // TODO refactor with correct params (remove create mothers)
        $params = [
            ':id' => $this->getEntityManager()->getConnection()->quote($id),
        ];
        $sql = 'SELECT rp.* FROM rental_properties rp WHERE rp.id = :id';

        $result = $this->getEntityManager()->getConnection()->executeQuery(\strtr($sql, $params))->fetchAllAssociative();

        if (!isset($result[0])) {
            return null;
        }

        $rentalId = new PropertyId($result[0]['id']);
        $title = new PropertyTitle($result[0]['title']);
        $description = PropertyDescriptionMother::create();
        $characteristics = PropertyCommonCharacteristicsMother::create();
        $location = PropertyLocationMother::create();
        $gallery = new PropertyGallery();
        $price = PropertyPriceMother::create();
        $petsAllowed = new BoolValueObject(false);

        $property = new RentalProperty(
            $rentalId,
            $title,
            $description,
            $characteristics,
            $location,
            $gallery,
            $price,
            $petsAllowed
        );

        return $property;
    }
}
