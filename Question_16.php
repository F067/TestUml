<?php

class Waiter {
    private array $tables = [];

    public function addTable(Table $table): void {
        $this->tables[] = $table;
    }

    public function removeTable(Table $table): void {
        $key = array_search($table, $this->tables);
        if ($key !== false) {
            unset($this->tables[$key]);
        }
    }

    public function getTables(): array {
        return $this->tables;
    }
}

class Table {
    private $waiters = [];

    public function addWaiter(Waiter $waiter) : Table {
        if (!in_array($waiter, $this->waiters)) {
            $this->waiters[] = $waiter;
            $waiter->addTable($this);
        }
        return $this;
    }

    public function removeWaiter(Waiter $waiter) : Table {
        if (($key = array_search($waiter, $this->waiters)) !== false) {
            unset($this->waiters[$key]);
            $waiter->removeTable($this);
        }
        return $this;
    }

    public function getWaiters() : array {
        return $this->waiters;
    }
}

try {
    $waiter1 = new Waiter();
    $waiter2 = new Waiter();
    $table1 = new Table();
    $table2 = new Table();

    // Un waiter peut avoir 0 à n tables
    $waiter1->addTable($table1);
    $waiter1->addTable($table2);
    $waiter2->addTable($table1);

    // Exception: une table peut seulement être associée à un seul waiter
    $waiter2->addTable($table2);
} catch (Exception $e) {
    echo 'Erreur: ' . $e->getMessage();
}