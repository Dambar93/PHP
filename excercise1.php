<?php

/*
    Exercise #1
    Sukurkite klasių hierarchiją. Cart, CartItem, CartDiscount, Customer.
    Cart:
    metodai:
    __construct(Customer $customer)
    addItem(CartItem $cartItem) - turi leisti pridėti CartItem objektą. Galite saugoti CartItem'us masyve, klasės Cart viduje
    addDiscount(CartDiscount $cartDiscount) - turi leisti pridėti CartDiscount objektus
    getTotal() - turi grąžinti visą krepšelio sumą su pritaikytomis nuolaidomis. Suapvalinkite iki 2 skaičių po kablelio
    Skaičiuojant total nuolaidos sumuojasi. Turi būti pritaikomos tik tos nuolaidos, kurių customerLevel sutampa su krepšelio
    kliento leveliu,
    CartDiscount
    metodai:
    __construct(int $percent, string $userLevel)
    getDiscountPercent() - nuolaidos procentas pvz.: 15
    getCustomerLevel() - gali būti 'A', 'B' arba 'C'
    CartItem
    metodai:
    __construct(string $name, int $price)
    getName() - prekės pavadinimas pvz.: 'Iphone 13'
    getPrice() - prekė kaina pvz.: 1300 (naudokite int)
    Customer
    metodai:
    __construct(string $name, string $surname, string $level)
    getFullName()
    getLevel() - gali būti 'A', 'B' arba 'C'
    Kaip turėtų būti kviečiamas kodas:
    <?php
    $customer = new Customer('John', 'Smith', 'A');
    $cart = new Cart($customer);
    $iphone = new CartItem('Iphone 13', 1300);
    $airpods = new CartItem('Airpods Pro', 200);
    $cart->addItem($iphone);
    $cart->addItem($airpods);
    $cartDiscount1 = new CartDiscount(15, 'A');
    $cart->addDiscount($cartDiscount1);
    $cartDiscount2 = new CartDiscount(2, 'A');
    $cart->addDiscount($cartDiscount2);
    $cartDiscount3 = new CartDiscount(20, 'B');
    $cart->addDiscount($cartDiscount2);
    $total = $cart->getTotal();
    var_dump($total); // 1249.5
 */
class Cart 
{

    private array $cartItem;
    private array $cartDiscount;
    private Customer $customer;
    private string $customerLevel;
    private CartDiscount $discount;

    public function __construct(Customer $customer)
    {
        $this->customerLevel=$customer->getLevel();
    }
    
    public function addItem(CartItem $cartItem)
    {
            
        //$this->cart[ $cartItem->getName()]=$cartItem->getPrice();
        $this->cartItem[]=$cartItem;
     

    }

    public function addDiscount(CartDiscount $cartDiscount)
    {
        

        return $this->cartDiscount[]=$cartDiscount;
        
    }
    public function returnDiscount()
    {
        $sum=0;
         //var_dump($this->cartDiscount);
        //var_dump($this->customerLevel);
        //$this->customer=$this->getLevel(); 
        $discount= array_filter($this->cartDiscount,
        function (CartDiscount $discount){
            return $discount->getCustomerLevel() == $this->customerLevel;
        }
        );
        foreach($discount as $discount)
        {
            $sum+=$discount->getDiscountPercent();
        }

        return $sum;


    }

    public function getTotal()
    {
        // var_dump($this->cartDiscount);
        // var_dump($this->cartItem);
        // $discountArray=$this->cartDiscount;
        // $level=$customer->getLevel();
        // $key=array_search($level,$discountArray);
        // $discount=$discountArray[$key]['precent'];


        return array_reduce(
            $this->cartItem,
            function (?int $totalPrice, CartItem $item){

                $totalPrice += $item->getPrice()*(100-$this->returnDiscount())/100;
                return $totalPrice;
            }
        );

    }

}

class CartDiscount
{
    private int $percent;
    private string $customerLevel;

    public function __construct(int $percent, string $customerLevel)
    {
        $this->percent=$percent;
        $this->customerLevel=$customerLevel;
    }
    
    public function getDiscountPercent()
    {
        return $this->percent;
    }

    public function getCustomerLevel()
    {
        return $this->customerLevel;
    }

}

class CartItem
{
    public string $name;
    public int $price;

    public function __construct(string $name, int $price)
    {
        $this->name=$name;
        $this->price=$price;

    }

    public function getName():string
    {
        
        return $this->name;
    }

    public function getPrice():int
    {
        
        return $this->price;
    }

}

class Customer 
{
    public string $name;
    public string $surname;
    public string $level;

    public function __construct(string $name, string $surname, string $level)
    {
        $this->name=$name;
        $this->surname=$surname;
        $this->level=$level;
    }

    public function getFullName()
    {

    }

    public function getLevel()
    {
        
        return $this->level;
    }
}

// $customer = new Customer('John', 'Smith', 'A');
// $cart = new Cart($customer);
// $iphone = new CartItem('Iphone 13', 1300);
// $airpods = new CartItem('Airpods Pro', 200);
// $cartDiscount1 = new CartDiscount(10, 'A');
// $cart->addDiscount($cartDiscount1);
// $cartDiscount2 = new CartDiscount(15, 'C');
// $cart->addDiscount($cartDiscount2);
// $cartDiscount3 = new CartDiscount(20, 'C');
// $cart->addDiscount($cartDiscount3);
// $cart->addItem($iphone);
// $cart->addItem($airpods);
// var_dump($cart->returnDiscount());
// var_dump($cart->getTotal());

/*
 * Exercise #2
 *
 * Sukurti programa, kuri moketu paduotą objektą Car konvertuoti į json, csv ir išsaugoti į failą.
 *
 * class Car
 * properties:
 * - string $name
 * - DateTime $year
 * - string $color
 * - int $power
 *
 * metodai:
 * - __construct(* all properties *)
 * - getData
 *
 * JsonConverter, CsvConverter, FileProcessing
 *
 * $status = new FileProcessing(new Car, new JsonConverter);
 */

// class Car
// {

//     public string $name;
//     public DateTime $year;
//     public string $color;
//     public int $power;

//     public function __construct($name, $year, $color, $power)
//     {
//         $this-> name = $name;
        
//         $this-> year = new DateTime($year);
        
//         $this-> color = $color;
//         $this-> power = $power;

//     }

//     public function getData():array
//     {
//         $array=[$this-> name,  $this-> year->format('Y'), $this-> color, $this-> power];
//         return $array;
//     }
// }

// class JsonConverter
// {
//     public Car $car;
//     public $json;
    
//     public function getJson(Car $car)
//     {
//         $this->car=$car;
//         $this-> json=json_encode( $this->car->getData());
//         return $this->json;
//     }

// }

// class CsvConverter
// {
//     public Car $car;

    
//     public function getCsv(Car $car)
//     {
//         $this->car=$car;
//         $myfile = fopen("newfile.txt", "a");     
//         fputcsv($myfile, $this->car->getData());
//         fclose($myfile);
//     }
        

// }

// class FileProcessing
// {
//     public Car $car;
//     public JsonConverter $json;
//     public CsvConverter $csv;


//     public function __construct(Car $car, $class )
//     {
//         if($class==new JsonConverter)
//         {
        
//             $this-> json=$class;
//             $this-> car=$car;
            
//             $myfile = fopen("newfile.txt", "a");
//             fwrite($myfile, $this-> json->getJson($this-> car)."\n");
//             fclose($myfile);

//         }else
//         if($class==new CsvConverter)
//         {

//             $this-> csv=$class;
//             $this-> car=$car;           
//             $this-> csv->getCsv($this-> car);            

//         }

//         //return $this-> json;

//     }
// }


// $car = new Car('Toyota','1993','Red',220);
//var_dump($car->getData());
//var_dump(new JsonConverter($car));
// var_dump(new FileProcessing($car,new CsvConverter()));
// var_dump(new FileProcessing($car,new JsonConverter()));
//var_dump($car);


/*
 * Exercise #3
 * Sukurkite programą skirtą valdyti parkingą. Naudokite objektinį programavimą t.y. klases.
 * Turbūt pakaks dviejų klasių - Parking ir Car. Duomenys turi būti saugomi faile.
 * ---------------------------------------------
 * php -f parking.php park_car NKA_123
 * Car ABC_123 parked!
 * ---------------------------------------------
 * php -f parking.php park_car FTA_122
 * Car FTA_122 parked!
 * ---------------------------------------------
 * php -f parking.php list_cars
 * Parked cars:
 * NKA_123
 * FTA_122
 *
 */
 //echo $argv[0];

 class Car {

    private string $numberPlate;

    public function __construct($numberPlate)
    {
        $this-> numberPlate=$numberPlate;

    }

    public function getPlate()
    {
        return $this-> numberPlate;
    }
 }

 class  Parking
 {

    private Car $car;
   

    public function park_car(Car $car)
    {
        $this->car=$car;
        $myfile = fopen("newfile.txt", "a");
        fwrite($myfile, $this-> car->getPlate()."\n");
        fclose($myfile);

    }

    public function list_cars()
    {
        $myfile = fopen("newfile.txt", "r");
        echo 'Parked Cars:';
        while(!feof($myfile)) {
            echo fgets($myfile) ;
          }
          fclose($myfile);

    }

    
 }

// $toyota=new Car('KOC_376');
// (new Parking())->park_car($toyota);
// (new Parking())->list_cars();

if ($argv[1]==='park_car')
{

    (new Parking())->park_car(new Car($argv[2]));    

}elseif($argv[1]==='list_cars')
{
    (new Parking())->list_cars();

}