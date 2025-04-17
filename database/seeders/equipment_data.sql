-- Очистка таблиц
DELETE FROM equipment;
DELETE FROM equipment_types;

-- Вставка типов оборудования
INSERT INTO equipment_types (id, name, serial_number_mask, created_at, updated_at) VALUES
(1, 'TP-Link model 1', 'XXAAAAAXAA', NOW(), NOW()),
(2, 'D-Link model 2', 'NXXAAXZXaa', NOW(), NOW()),
(3, 'D-Link model 4', 'NAAAAXZXXX', NOW(), NOW());

-- Примеры оборудования с корректными серийными номерами согласно маскам
INSERT INTO equipment (equipment_type_id, serial_number, notes, created_at, updated_at) VALUES
(1, '12ABCDE3AA', 'Роутер для тестирования', NOW(), NOW()),
(2, '5XX1AX-Xaa', 'Коммутатор в серверной', NOW(), NOW()),
(3, '9ABCDX@XXX', 'Сетевое хранилище', NOW(), NOW());
