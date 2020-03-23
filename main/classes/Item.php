<?php
abstract class Item
{

    abstract public function toString();

    public function generate_id(){
        return 1000;
    }

}
