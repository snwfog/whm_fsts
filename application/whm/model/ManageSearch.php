<?php

namespace WHM\Model;

use \WHM\Application;

class ManageSearch
{
    private $em;

    public function __construct()
    {
        $this->em = Application::em();
    }

    public function searchMemberByName($arg)
    {
        $query = "SELECT partial m.{id, first_name, last_name, mcare_number}
        FROM WHM\Model\HouseholdMember m JOIN m.household h
        WHERE
          UPPER(m.first_name) LIKE UPPER('{$arg}%') OR
          UPPER(m.last_name) LIKE UPPER('{$arg}%') OR
          UPPER(m.first_name) LIKE UPPER('%{$arg}%') OR
          UPPER(m.last_name) LIKE UPPER('%{$arg}%')";

        $result = $this->em->createQuery($query)
            ->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true)->setMaxResults(5);

        return $result->getArrayResult();
    }

    public function searchMemberByMcare($arg)
    {
        $query = "SELECT partial m.{id, first_name, last_name, mcare_number}
        FROM WHM\Model\HouseholdMember m JOIN m.household h
        WHERE
          UPPER(m.mcare_number) LIKE UPPER('{$arg}%')";

        $result = $this->em->createQuery($query)
            ->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true)->setMaxResults(5);

        return $result->getArrayResult();
    }

    public function searchMemberByHouseholdID($arg)
    {

        $query = "SELECT partial m.{id, first_name, last_name, mcare_number}
        FROM WHM\Model\HouseholdMember m JOIN m.household h
        WHERE h.id LIKE '{$arg}%'";

        $result = $this->em->createQuery($query)
            ->setHint(\Doctrine\ORM\Query::HINT_INCLUDE_META_COLUMNS, true)->setMaxResults(5);

        return $result->getArrayResult();
    }
}