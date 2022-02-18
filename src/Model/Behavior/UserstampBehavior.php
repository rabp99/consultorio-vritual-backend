<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;


/**
 * Userstamp behavior
 */
class UserstampBehavior extends Behavior
{
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options) {
        if ($entity->isNew()) {
            $entity->set('user_created', '70801887');
        } else {
            $entity->set('user_modified', '70801887');
        }
    }

}