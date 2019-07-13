<?php
namespace App\Service;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;

class TagService
{
    public function create(Tag $tag)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($tag);

        $entityManager->flush();

    }
}
?>