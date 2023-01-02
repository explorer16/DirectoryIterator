<?php

namespace Classs;

class MyIterator implements \Iterator, \ArrayAccess
{
    private $rows;
    private $position;
    public function __construct($filename)
    {
        $path='tables/'.$filename;

        if(!file_exists($path)){
            die('error 404');
        }

        $rows=file_get_contents($path);
        $rows=explode("\n",$rows);

        foreach ($rows as $value){
            $value=str_getcsv($value);
            $value=$value[0];
            $row=explode(';',$value);
            $this->rows[array_shift($row)]=$row;
        }

    }
    public function rewind()
    {
        $this->position=1;
    }
    public function valid():bool
    {
        return isset($this->rows[$this->position]);
    }
    public function key()
    {
        return $this->position;
    }
    public function current()
    {
        return $this->rows[$this->position];
    }
    public function next()
    {
        ++$this->position;
    }

    public function offsetExists(mixed $offset)
    {
        return isset($this->rows[$offset]);
    }
    public function offsetGet(mixed $offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
    public function offsetSet(mixed $offset, mixed $value)
    {
        if(is_null($offset)){
            $this->rows[]=$value;
        } else {
            $this->rows[$offset]=$value;
        }
    }
    public function offsetUnset(mixed $offset)
    {
        unset($this->rows[$offset]);
    }
}