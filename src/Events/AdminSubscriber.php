<?php
namespace App\EventSubscriber;

use App\Entity\Emploi;
use App\Entity\Seance;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
        ];
    }

    public function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        // $entity = $event->getEntityInstance();

        // if (!$entity instanceof Emploi) return;

        // $entity->setDateCreation(new \DateTimeImmutable);
        dd($event);
    
    }
}