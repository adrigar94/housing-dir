<?php

declare(strict_types=1);

namespace App\Catalog\RentalProperty\Application\Create;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\DomainEventSubscriber;

class RentalPropertyCreatedSubscriber implements DomainEventSubscriber
{
    public static function subscribedTo(): array
    {
        return [RentalPropertyCreatedEvent::class];
    }

    public function __invoke(DomainEvent $event): void
    {
        if($event instanceof RentalPropertyCreatedEvent){
            //dd('RentalPropertyCreatedEvent triggered', $event);
            echo "RentalPropertyCreatedEvent triggered\n";
        }
        //dd('other RentalPropertyCreatedEvent triggered', $event);
    }
}
