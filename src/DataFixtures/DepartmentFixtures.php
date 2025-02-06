<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\{Country, Department};

class DepartmentFixtures extends Fixture implements DependentFixtureInterface
{    
    public function load(ObjectManager $em): void
    {
        $rpCountry = $em->getRepository(Country::class);
        $rpDepartment = $em->getRepository(Department::class);
        
        $franceEntity = $rpCountry->findOneByCode('FR');
                
        $resultDepartment = json_decode(shell_exec("curl -X 'GET' 'https://geo.api.gouv.fr/departements?fields=nom,code' -H 'accept: application/json'"));
        foreach( $resultDepartment as $rd )
        {
            $entity = (new Department())
                ->setCountry($franceEntity)
                ->setName($rd->nom)
                ->setPostalCode($rd->code)
            ;
        
            $em->persist($entity);
        }
        
        $em->flush();
    }
    
    public function getDependencies(): array
    {
        return [
            CountryFixtures::class,
        ];
    }
}
