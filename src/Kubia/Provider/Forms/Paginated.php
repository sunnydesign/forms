<?php

namespace Kubia\Provider\Forms;

trait Paginated
{
   public function getPaginated($object, $parameters)
   {
       $result = (object)[];

       // Set limit and offset
       $page = $parameters->page ?? 1;
       $limit = $parameters->limit ?? self::LIMIT;
       $offset = $limit * ($page - 1);

       // Get forms from DB considering client id
       $object = $object->take($limit)->skip($offset);

       $result->data = $object->get();

       // count
       $count = $object->count();
       $result->pagination->page = $page;
       $result->pagination->limit = $limit;
       $result->pagination->count = $count;
       $result->pagination->pages = ceil($count / $limit);

       return $result;
   }

}