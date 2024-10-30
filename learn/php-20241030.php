<?php
class A
{
    public function T1()
    {
        $memo = [];
        $this->T1_2($memo);
    }
    public function T1_2(&$memo)
    {
        $memo['0'] = 'T1';
        print_r($memo);
    }

    public function T2()
    {
        $this->T2_2($memo);
    }
    public function T2_2(&$memo)
    {
        print_r($memo);
    }
}

$object = new A();

$result = $object->T1();
print_r($result);
print_r("-----------------------------\n");
$result2 = $object->T2();
print_r($result2);
print_r("-------------End------------\n");
class B
{
    private $memo = [];

    public function T1()
    {
        $this->T1_2($this->memo);
    }
    public function T1_2(&$memo)
    {
        $memo['0'] = 'T1';
        print_r($memo);
    }

    public function T2()
    {
        $this->T2_2($this->memo);
    }

    public function T2_2(&$memo)
    {
        print_r($memo);
    }
}

$object2 = new B();

$result3 = $object2->T1();
print_r($result3);
print_r("-----------------------------\n");
$result4 = $object2->T2();
print_r($result4);
