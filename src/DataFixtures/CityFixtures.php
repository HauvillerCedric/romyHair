<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\{Department, City};

class CityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $em): void
    {
        ini_set('memory_limit', '2048M'); //On augmente la taille de de la mémoire qui est bridée par le serveur et n'étant pas assez haute pour gérer autant de données
        
        $rpCity = $em->getRepository(City::class);
        $rpDepartment = $em->getRepository(Department::class);
        $departments = $rpDepartment->findAll();
        
        foreach( $departments as $d )
        {        
            $resultCity = json_decode(shell_exec("curl -X 'GET' 'https://geo.api.gouv.fr/communes?codeDepartement=".$d->getPostalCode()."&fields=nom,codesPostaux,centre&format=json&geometry=centre' -H 'accept: application/json'"));
            foreach( $resultCity as $rc )
            {
                foreach( $rc->codesPostaux as $cp )
                {
                    $entity = (new City())
                        ->setDepartment($d)
                        ->setName($rc->nom)
                        ->setPostalCode($cp)
                        ->setLatitude($rc->centre->coordinates[1])
                        ->setLongitude($rc->centre->coordinates[0])
                    ;
                
                    $em->persist($entity);
                }
            }
        }
        
        $em->flush();
    }
    
    public function getDependencies(): array
    {
        return [
            DepartmentFixtures::class,
        ];
    }
}
