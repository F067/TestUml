<?php
class Technician {

private string $name;
private array $vehicules = [];

public function __construct(string $name) {
    $this->name = $name;
}

public function addVehicule(Vehicule $vehicule): Technician {
    if (!in_array($vehicule, $this->vehicules)) {
        $this->vehicules[] = $vehicule;
        $vehicule->addTechnician($this);
    }
    return $this;
}

public function removeVehicule(Vehicule $vehicule): Technician {
    $key = array_search($vehicule, $this->vehicules);
    if ($key !== false) {
        unset($this->vehicules[$key]);
        $vehicule->removeTechnician($this);
    }
    return $this;
}

public function getVehicules(): array {
    return $this->vehicules;
}

public function getName(): string {
    return $this->name;
}
}

class Vehicule {

private string $registerNumber;
private array $technicians = [];

public function __construct(string $registerNumber) {
    $this->registerNumber = $registerNumber;
}

public function addTechnician(Technician $technician): Vehicule {
    if (!in_array($technician, $this->technicians)) {
        $this->technicians[] = $technician;
        $technician->addVehicule($this);
    }
    return $this;
}

public function removeTechnician(Technician $technician): Vehicule {
    $key = array_search($technician, $this->technicians);
    if ($key !== false) {
        unset($this->technicians[$key]);
        $technician->removeVehicule($this);
    }
    return $this;
}

public function getTechnicians(): array {
    return $this->technicians;
}

public function getRegisterNumber(): string {
    return $this->registerNumber;
}
}

$vA = new Vehicule('AA-666-AA');
$vB = new Vehicule('BB-666-BB');
$paul = new Technician('Paul');
$juliette = new Technician('Juliette');
$jalila = new Technician('Jalila');
$paul->addVehicule($vA);
$juliette->addVehicule($vA);
$jalila->addVehicule($vB);
$paul->addVehicule($vB);
var_dump($paul->getVehicules());
var_dump($juliette->getVehicules());
var_dump($jalila->getVehicules());
var_dump($vA->getTechnicians());
var_dump($vB->getTechnicians());