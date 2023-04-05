<?php

class Waiter {
    private $tables = [];

    public function addTable(Table $table) : Waiter {
        if (!in_array($table, $this->tables)) {
            $this->tables[] = $table;
            $table->addWaiter($this);
        }
        return $this;
    }

    public function removeTable(Table $table) : Waiter {
        if (($key = array_search($table, $this->tables)) !== false) {
            unset($this->tables[$key]);
            $table->removeWaiter($this);
        }
        return $this;
    }

    public function getTables() : array {
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
    $table1 = new Table();
    $waiter1 = new Waiter();
    $waiter2 = new Waiter();

    // Ajouter des serveurs à une table
    $table1->addWaiter($waiter1);
    $table1->addWaiter($waiter2);

    // Afficher les serveurs d'une table
    var_dump($table1->getWaiters());

    // Supprimer un serveur d'une table
    $table1->removeWaiter($waiter1);

    // Afficher les serveurs d'une table
    var_dump($table1->getWaiters());

    // Essayer de créer une table sans serveurs (lève une exception)
    $table2 = new Table();

} catch (Exception $e) {
    echo 'Exception: ' . $e->getMessage();
}