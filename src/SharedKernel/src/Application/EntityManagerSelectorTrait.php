<?php

namespace SharedKernel\Application;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

trait EntityManagerSelectorTrait
{
    protected ManagerRegistry $doctrine;
    
    public function getDomainEntityManager(object $object): EntityManagerInterface
    {
        $domainNamespace = get_class($object);
        $explodedNamespace = explode("\\", $domainNamespace);
        $domain = strtolower(array_shift($explodedNamespace));

        return $this->doctrine->getManager($domain);
    }
}