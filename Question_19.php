<?php
class Technician {
    private string $name;
    private ?Technician $superior = null;
    private array $subordinates = [];

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function setSuperior(?Technician $superior) : void {
        if($superior === $this) {
            throw new InvalidArgumentException("A technician cannot be his own superior.");
        }
        $this->superior = $superior;
        $superior->addSubordinate($this);
    }

    public function addSubordinate(Technician $subordinate) : void {
        if($subordinate === $this) {
            throw new InvalidArgumentException("A technician cannot be his own subordinate.");
        }
        $this->subordinates[] = $subordinate;
        $subordinate->setSuperior($this);
    }

    public function getSuperior() : ?Technician {
        return $this->superior;
    }

    public function getSubordinates() : array {
        return $this->subordinates;
    }
}

// Exemple d'utilisation
$john = new Technician("John");
$jane = new Technician("Jane");
$bob = new Technician("Bob");

$john->setSuperior($jane);
$jane->addSubordinate($bob);

var_dump($john->getSuperior()); // Output: object(Technician)#2 (1) {...}
var_dump($jane->getSubordinates()); // Output: array(1) { [0]=> object(Technician)#3 (1) {...} }