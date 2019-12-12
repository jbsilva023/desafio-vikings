<?php


namespace JbSilva\ORM\QueryBuilder;

interface QueryBuilderInterface
{
    public function getvalues() :array;
    public function __toString();
}
