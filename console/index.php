<?php
// ���������� ������������ ���� ��� ����� �������
namespace Transport;

require_once __DIR__ . '/autoload.php';

// ������� ����� ��� ������������� ��������
class Vehicle
{
    protected $name;            // ������������ ��������
    protected $passengerCount;  // ���������� ����������
    protected $maxCargoWeight;  // ������������ ��� ������
    protected $fuelConsumption; // ������ ������� �� 100 ��
    protected $maxTripDistance; // ��������� �������
    protected $depreciationCoefficient; // ����������� �����������

    // ����������� ��� ������������� �������
    public function __construct($name, $passengerCount, $maxCargoWeight, $fuelConsumption, $maxTripDistance, $depreciationCoefficient)
    {
        $this->name = $name;
        $this->passengerCount = $passengerCount;
        $this->maxCargoWeight = $maxCargoWeight;
        $this->fuelConsumption = $fuelConsumption;
        $this->maxTripDistance = $maxTripDistance;
        $this->depreciationCoefficient = $depreciationCoefficient;
    }

    // ����� ��� ������� ��������� �������
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

        // ������ �� ��������
        $driverSalary = 3 * 5 * $driverCategory; // �����������, ��� ������ �������� 5 UAN �� �������� �� �������

        // ������ ��������� �������
        $fuelCost = ($this->fuelConsumption * $distance / 100) * $fuelPrice;

        // ������ ��������� �������

        //�� ������ ������� ��� ��������� ������� ��������� ������� � ������ ���������� ���������
        //�� ���� ���� ��������� ����� ��������� � ������ ���������� ���������? ����� ��� =>
        //$totalCost = $driverSalary + ($fuelCost * $this->depreciationCoefficient) * $passengerCount;

        //���� �������� �� ������� �� ������� �������� ��� �����
        //������� ������� ��������� �������:
        //�� �������� + (��������� ������� * ���������� ����������� ������������� ��������)
        //����� ����� ��������� �� ������� ������
        $totalCost = $driverSalary + ($fuelCost * $this->depreciationCoefficient);

        return $totalCost;
    }
}

try {
    // ������� ������ ������
    $bus = new Bus('Bus', 32, 300, 20, 200, 2);
    $truck = new Truck('Bus', 32, 300, 20, 200, 2);

    // ��������� ������ ��������� �������
    $bustripCost = $bus->calculateTripCost(10, 100, 170, 1, 25); // �����������, ��� ��������� �������� 1 � ���� �� ���� ������� 25 UAN
    $trucktripCost = $truck->calculateTripCost(10, 100, 170, 2, 35); // �����������, ��� ��������� �������� 2 � ���� �� ���� ������� 35 UAN

    // ������� ���������
    echo "Trip cost: $bustripCost UAN\n";
    echo "Trip cost: $trucktripCost UAN\n";

} catch (\InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
} catch (\Exception $e) {
    echo "An unexpected error occurred: " . $e->getMessage() . "\n";
}

?>
