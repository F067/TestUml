<?php

class Waiter {
    private array $tables = [];

    public function addTable(Table $table): Waiter {
        $this->tables[] = $table;
        return $this;
    }

    public function getTables(): array {
        return $this->tables;
    }
}

class Table {
    private ?Waiter $waiter = null;

    public function setWaiter(Waiter $waiter): Table {
        $this->waiter = $waiter;
        return $this;
    }

    public function getWaiter(): ?Waiter {
        return $this->waiter;
    }
}


$waiter1 = new Waiter();
$waiter2 = new Waiter();

$table1 = new Table();
$table2 = new Table();
$table3 = new Table();

$waiter1->addTable($table1)->addTable($table2);
$table2->setWaiter($waiter2);
$table3->setWaiter($waiter1);

// Vérifier que chaque table a un serveur
if ($table1->getWaiter() === null || $table2->getWaiter() === null || $table3->getWaiter() === null) {
    throw new Exception('Erreur: une table n\'a pas de serveur associé.');
}

// Vérifier que chaque serveur a les bonnes tables associées
if (count($waiter1->getTables()) !== 2 || count($waiter2->getTables()) !== 1) {
    throw new Exception('Erreur: un serveur n\'a pas le bon nombre de tables associées.');
}