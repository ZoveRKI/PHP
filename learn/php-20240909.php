<?php
// class MyClass {
//     public $a = 'public属性';
//     private $b = 'private属性';
//     protected $myVar = '初始值';

//     private function privateMethod() {
//         return '这是私有方法';
//     }

//     public function getMyVar() {
//         return $this->myVar;
//     }

//     public function setMyVar($value) {
//         $this->myVar = $value;
//     }

//     public function getPrivateVar() {
//         return $this->b;
//     }

//     public function callPrivateMethod() {
//         return $this->privateMethod();
//     }
// }

// class ChildClass extends MyClass {
//     public function getMyVar2() {
//         return $this->myVar.'ChildClass';
//     }

//     public function setMyVar2($value) {
//         $this->myVar = $value;
//     }
// }

// $obj = new MyClass();
// echo $obj->getMyVar()."\n"; // 输出: 初始值
// $obj->setMyVar('新值');
// echo $obj->getMyVar()."\n"; // 输出: 新值
// echo '---------------'."\n";

// $obj2 = new ChildClass();
// echo $obj2->getMyVar2()."\n";
// $obj2->setMyVar2('子类新值')."\n";
// echo $obj2->getMyVar2()."\n";
// echo '---------------'."\n";

// echo $obj->a."\n";
// echo $obj->getPrivateVar()."\n";
// echo $obj->callPrivateMethod()."\n";

// abstract class school {
//     public $z = 100;
// }

// class A extends school {
//     //空的都行
// }

// $xxxx = new A();
// echo $xxxx->z;

// class MyClass {
//     public static $staticVar = '这是静态变量';
// }
// echo MyClass::$staticVar; // 输出: 这是静态变量

// class Counter {
//     public static $count = 0;

//     public function __construct() {
//         self::$count++;
//     }

//     public static function getCount() {
//         return self::$count;
//     }
// }

// $obj1 = new Counter();
// $obj2 = new Counter();
// echo Counter::getCount(); // 输出: 2

// final class B extends Counter {
//     //final class 不能再继续被继承；当前class可以继承，但是最后一次
// }

// interface T {
//     public function talk();
// }

// class Y implements T {
//     public function talk() {
//         echo "hi,xxx";
//     }
// }

// // $testY = new Y();
// // $testY->talk();

// interface T2 extends T {
//     public function eat();
// }

// class Y2 extends Y implements T2 {
//     public function eat() {
//         echo "eat photo";
//     }
// }

// $testY2 = new Y2();
// $testY2->talk();

// trait talk {
//     public function talk() {
//         echo "hi,xxx";
//     }
// }

// trait eat {
//     public function eat() {
//         echo "eat photo";
//     }
// }

// class person1 {
//     public $id = 0;
//     use talk;
//     use eat;
//     public function eat() {
//         echo "eat eat fish";    //同名函数时，当前覆盖引进的函数
//     }
// }

// $peter = new person1();
// echo $peter->id."\n";
// $peter->talk();             //这个不能用."\n"是因为echo是在函数里
// echo "\n";
// $peter->eat();
// echo "\n";

// $tom = clone $peter;        //完全复制了一个新空间，如果只是赋值的话，默认是引用，是相同空间，只是改了一个名字而已
// echo $tom->id."\n";
// $tom->id = 1;
// echo $tom->id."\n";
// echo $peter->id."\n";       //原始值并不改变

// //序列化
// $data = serialize($tom);
// $tim = unserialize($data);
// echo $tim->id."\n";
// $tim->id = 5;
// echo $tim->id."\n";

// include 'php-20240909_1.php';
// echo \php20240909\datetime\xxxtime()."\n";

// use \php20240909\datetime as DT ;
// echo DT\xxxtime()."\n";

try {
    // 尝试打开文件
    $file = fopen("file.txt", "r");
    if (!$file) {
        throw new Exception("无法打开文件");
    }
} catch (Exception $e) {
    // 捕获并处理异常
    echo "捕获到异常: " . $e->getMessage()."\n";
} finally {
    // 无论是否有异常都执行
    echo "执行清理操作";
}





