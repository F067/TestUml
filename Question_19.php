<?php

class Technician {
    private ?Technician $superior = null;
    private array $subordinates = [];

    public function setSuperior(?Technician $superior): Technician {
        if ($superior === $this) {
            throw new Exception("A technician cannot be their own superior.");
        }
        if ($this->superior !== null) {
            $this->superior->removeSubordinate($this);
        }
        $this->superior = $superior;
        if ($superior !== null) {
            $superior->addSubordinate($this);
        }
        return $this;
    }

    public function getSuperior(): ?Technician {
        return $this->superior;
    }

    public function addSubordinate(Technician $subordinate): Technician {
        if ($subordinate === $this) {
            throw new Exception("A technician cannot be their own subordinate.");
        }
        if (!in_array($subordinate, $this->subordinates)) {
            $this->subordinates[] = $subordinate;
            $subordinate->setSuperior($this);
        }
        return $this;
    }

    public function removeSubordinate(Technician $subordinate): Technician {
        $key = array_search($subordinate, $this->subordinates, true);
        if ($key !== false) {
            array_splice($this->subordinates, $key, 1);
            $subordinate->setSuperior(null);
        }
        return $this;
    }

    public function getSubordinates(): array {
        return $this->subordinates;
    }
}