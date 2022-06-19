INSERT INTO `device` (`id`, `name_device`, `mac`, `ip`, `power_consumption`, `create_date`) VALUES ('1', 'TV', '12:2b:b2:b3', '123456', '50', '2022-06-18');
INSERT INTO `device` (`id`, `name_device`, `mac`, `ip`, `power_consumption`, `create_date`) VALUES ('2', 'TV1', '13:1b:b2:b3', '1234678', '40', '2022-06-18');
INSERT INTO `device` (`id`, `name_device`, `mac`, `ip`, `power_consumption`, `create_date`) VALUES ('3', 'TV2', '12:1b:b2:b3', '125678', '30', '2022-06-18');
INSERT INTO `device` (`id`, `name_device`, `mac`, `ip`, `power_consumption`, `create_date`) VALUES ('4', 'TV3', '12:3b:b2:b3', '1345678', '60', '2022-06-18');
INSERT INTO `device` (`id`, `name_device`, `mac`, `ip`, `power_consumption`, `create_date`) VALUES ('5', 'Washer', '02:2b:b2:b3', '1234567', '50', '2022-06-18');
INSERT INTO `device` (`id`, `name_device`, `mac`, `ip`, `power_consumption`, `create_date`) VALUES ('6', 'Washer1', '12:2b:b1:b3', '123456', '10', '2022-06-18');
INSERT INTO `device` (`id`, `name_device`, `mac`, `ip`, `power_consumption`, `create_date`) VALUES ('7', 'Washer2', '12:2b:b3:b3', '12378', '20', '2022-06-18');
INSERT INTO `device` (`id`, `name_device`, `mac`, `ip`, `power_consumption`, `create_date`) VALUES ('8', 'Washer3', '12:2b:b4:b3', '45678', '70', '2022-06-18');



CREATE TABLE `bss_exercise1`.`log` (
`id` INT NOT NULL AUTO_INCREMENT ,
`action` VARCHAR(256) NOT NULL ,
`date` INT NOT NULL ,
foreign key(id) references device(id) ) ENGINE = InnoDB;

INSERT into log(id, action, date) VALUES(1, "turn on", 1 );
INSERT into log(id, action, date) VALUES(2, "sleep", 2 );
INSERT into log(id, action, date) VALUES(1, "turn off", 1 );
INSERT into log(id, action, date) VALUES(3, "turn on", 3 );
INSERT into log(id, action, date) VALUES(4, "sleep", 2 );
INSERT into log(id, action, date) VALUES(5, "turn on", 1 );
INSERT into log(id, action, date) VALUES(6, "sleep", 5 );
INSERT into log(id, action, date) VALUES(7, "turn on", 4 );
INSERT into log(id, action, date) VALUES(1, "sleep", 3 );
INSERT into log(id, action, date) VALUES(2, "turn off", 5 );
INSERT into log(id, action, date) VALUES(3, "sleep", 2 );
INSERT into log(id, action, date) VALUES(4, "turn on", 2 );
INSERT into log(id, action, date) VALUES(1, "turn off", 4 );
INSERT into log(id, action, date) VALUES(4, "sleep", 1 );
INSERT into log(id, action, date) VALUES(3, "turn on", 1 );
INSERT into log(id, action, date) VALUES(5, "turn off", 3 );
INSERT into log(id, action, date) VALUES(6, "turn on", 1 );
INSERT into log(id, action, date) VALUES(7, "sleep", 1 );
INSERT into log(id, action, date) VALUES(1, "sleep", 3 );
INSERT into log(id, action, date) VALUES(1, "turn on", 4 );
INSERT into log(id, action, date) VALUES(2, "turn off", 5 );


CREATE TABLE 'bss_exercise1'.'image'(
    `id` INT NOT NULL AUTO_INCREMENT ,
    `url` TEXT NOT NULL ,
    `person_id` INT NOT NULL ,
    foreign key(person_id) references person(id) ) ENGINE = InnoDB;