<?php

namespace App\Database;

class Equipment() {
    enum Types : string{
        case Tension = 'Tensão';
        case Current = 'Corrente';
        case Oil = 'Óleo';
    }
    static function all() {
        $cnn = Connection::connection();
        return $cnn->query("SELECT * FROM Equipments")->fetchAll(PDO::FETCH_ASSOC);
    }

    static function insert(string $name, string $serialNumber, Types $type) {
        $cnn = Connection::connection();
        $stmt = $cnn->prepare("INSERT INTO Equipments (name, serial_numer, type) VALUES (:name, :serial_number, :type)");
        $stmt->bindValue('name', $name);
        $stmt->bindValue('serial_number', $serialNumber);
        $stmt->bindValue('type', $type);
        $stmt->execute();
        return (int) $cnn->lastInsertId();
    }

    static function update(int $id, ?string $name, ?string $serialNumer, ?Type $type) {
        $storedEquipment = self::get($id);
        if (!$storedEquipment) { 
            return null;
        }
        $equipment = [];
        $equipment[':name'] = $name ?? $storedEquipment['name'];
        $equipment[':serial_number']  = $serialNumber ?? $storedEquipment['serial_number'];
        $equipment[':type'] = $type ?? $storedEquipment['type'];
        $cnn = Connection::connection();
        $stmt = $cnn->prepare("INSERT INTO Equipments (name, serial_numer, type) VALUES (:name, :serial_number, :type)");
        return $stmt->execute($equipment);
    }
    
    static function get(int $id){
        $cnn = Connection::connection();
        return $cnn->query("SELECT * FROM Equipments WHERE id=:id")
                   ->execute([":id" => $id])
                   ->fetch(PDO::FETCH_ASSOC);
    }
}
