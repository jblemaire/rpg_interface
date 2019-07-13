<?php
namespace App\Service;
use App\Entity\Stat;
use Doctrine\ORM\EntityManagerInterface;

class StatService
{
    public function create(Stat $stat)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($stat);
        $entityManager->flush();
    }
}
?>