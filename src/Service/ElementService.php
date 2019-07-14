<?php
namespace App\Service;
use App\Entity\Element;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;

class ElementService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function create(Element $element)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($element);

        $entityManager->flush();

    }
    public function link($p_idTag , $p_idElement)
    {

        $conn = $this->em->getConnection();
        $sql = "Select * from   element_tag
                where element_id = $p_idElement and  tag_id = $p_idTag ";
        $stmt = $conn->prepare($sql);

         $stmt->execute();
         $isLinked = count($stmt->fetchAll());

        if ( $isLinked == 0  ){

            $sql = "INSERT INTO  element_tag (element_id,tag_id) values ($p_idElement,$p_idTag)";
            $stmt = $conn->prepare($sql);

            $stmt->execute();
        }
    }
    public function getTags($p_idElement)
    {
        $conn = $this->em->getConnection();
        $sql = "Select tag.* from element_tag LEFT JOIN tag on tag.id = element_tag.tag_id where element_id = $p_idElement";
        $stmt = $conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }
    public function removeLink($p_idTag , $p_idElement)
    {
        $conn = $this->em->getConnection();
        $sql = "DELETE FROM element_tag WHERE element_id = $p_idElement AND tag_id = $p_idTag ";
        $stmt = $conn->prepare($sql);

        $result = $stmt->execute();


        return $result;
    }
}
?>