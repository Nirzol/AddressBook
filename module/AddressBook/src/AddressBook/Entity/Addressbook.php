<?php

namespace AddressBook\Entity;

class Addressbook
{
    public function toArray($hydrator)
    {
        $resultArray = $hydrator->extract($this);
        foreach ($resultArray as $key => $value) {
            if (is_object($value)) {
                $resultArray[$key] = $value->toArray($hydrator);
            }
        }

        return $resultArray;
    }
}
