<?php
// Определяем пространство имен для наших классов
namespace Transport;

require_once __DIR__ . '/autoload.php';

// Базовый класс для транспортного средства
class Vehicle
{
    protected $name;            // транспортное средство
    protected $passengerCount;  // количество пассажиров
    protected $maxCargoWeight;  // максимальный вес багажа
    protected $fuelConsumption; // расход топлива на 100 км
    protected $maxTripDistance; // дальность поездки
    protected $depreciationCoefficient; // Коэффициент амортизации

    // Конструктор для инициализации свойств
    public function __construct($name, $passengerCount, $maxCargoWeight, $fuelConsumption, $maxTripDistance, $depreciationCoefficient)
    {
        $this->name = $name;
        $this->passengerCount = $passengerCount;
        $this->maxCargoWeight = $maxCargoWeight;
        $this->fuelConsumption = $fuelConsumption;
        $this->maxTripDistance = $maxTripDistance;
        $this->depreciationCoefficient = $depreciationCoefficient;
    }

    // Метод для расчета стоимости поездки
    public function calculateTripCost($passengerCount, $cargoWeight, $distance, $driverCategory, $fuelPrice)
    {

        if ($cargoWeight > $this->maxCargoWeight || $distance > $this->maxTripDistance || $passengerCount > $this->passengerCount) {
            if ($cargoWeight > $this->maxCargoWeight) {
                echo 'Weight exceeds the maximum allowed ' . $cargoWeight . ' acceptable ' . $this->maxCargoWeight;
            }
            if ($distance > $this->maxTripDistance) {
                echo 'Distance exceeds the maximum allowed '. $distance . ' acceptable ' . $this->maxTripDistance;
            }
            if ($passengerCount > $this->passengerCount) {
                echo 'Passengers exceeds the maximum allowed '. $passengerCount . ' acceptable ' . $this->passengerCount;
            }
            exit;
        }

        // Расчет ЗП водителя
        $driverSalary = 3 * 5 * $driverCategory; // Предположим, что ставка водителя 5 UAN за километр из задания

        // Расчет стоимости топлива
        $fuelCost = ($this->fuelConsumption * $distance / 100) * $fuelPrice;

        // Расчет стоимости поездки

        //не совсем понимаю как правильно считать стоимость поездки с учётом количества пасажиров
        //то есть надо посчитать общую стоимость с учётом количества пасажиров? тогда так =>
        //$totalCost = $driverSalary + ($fuelCost * $this->depreciationCoefficient) * $passengerCount;

        //если исходить из задания то формула написано что такая
        //Формула расчета стоимости поездки:
        //ЗП водителя + (Стоимость топлива * коэфициент амортизации транспортного средства)
        //здесь тогда пасажиров не трогаем вообще
        $totalCost = $driverSalary + ($fuelCost * $this->depreciationCoefficient);

        return $totalCost;
    }
}

try {
    // Создаем объект класса
    $bus = new Bus('Bus', 32, 300, 20, 200, 2);
    $truck = new Truck('Bus', 32, 300, 20, 200, 2);

    // Выполняем расчет стоимости поездки
    $bustripCost = $bus->calculateTripCost(10, 100, 170, 1, 25); // Предположим, что категория водителя 1 и цена за литр бензина 25 UAN
    $trucktripCost = $truck->calculateTripCost(10, 100, 170, 2, 35); // Предположим, что категория водителя 2 и цена за литр бензина 35 UAN

    // Выводим результат
    echo "Trip cost: $bustripCost UAN\n";
    echo "Trip cost: $trucktripCost UAN\n";

} catch (\InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
} catch (\Exception $e) {
    echo "An unexpected error occurred: " . $e->getMessage() . "\n";
}

?>
