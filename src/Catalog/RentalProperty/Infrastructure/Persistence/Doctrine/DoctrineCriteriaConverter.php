<?

declare(strict_types=1);

namespace App\Catalog\RentalProperty\Infrastructure\Persistence\Doctrine;

use App\Catalog\Shared\Domain\Criteria\Criteria;
use Doctrine\Common\Collections\Criteria as CollectionsCriteria;

final class DoctrineCriteriaConverter
{
    private function __construct(private Criteria $criteria)
    {
    }

    public static function convert(Criteria $criteria): CollectionsCriteria
    {
        $criteria = new self($criteria);

        return $criteria->convertToDoctrineCriteria();
    }

    private function convertToDoctrineCriteria(): CollectionsCriteria
    {
        $order = $this->criteria->order();


        $criteria = CollectionsCriteria::create()
            ->orderBy([$order->orderBy()->value() => $order->orderType()->value]);

        foreach ($this->criteria->filters() as $filter) {

            $criteria->where(
                CollectionsCriteria::expr()->eq($filter->field()->value(), $filter->value()->value())
            );
        }

        //dd($criteria);

        return $criteria;
    }
}
