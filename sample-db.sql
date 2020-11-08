
CREATE DATABASE IF NOT EXISTS symfony;
USE symfony;

-- Drop existing tables
DROP TABLE IF EXISTS meter_point_partner;
DROP TABLE IF EXISTS broker;
DROP TABLE IF EXISTS meter_point;

-- Create structure matching spec
CREATE TABLE broker (
    id INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
) ENGINE=InnoDB;
CREATE TABLE meter_point (
    id INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    meterpoint VARCHAR(255) NOT NULL,
    consumption INTEGER(11) NOT NULL,
    uplift INTEGER(11) NOT NULL
) ENGINE=InnoDB;
CREATE TABLE meter_point_partner (
    id INTEGER UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    partner_id INTEGER UNSIGNED NOT NULL,
    meter_point_id INTEGER UNSIGNED NOT NULL,
    FOREIGN KEY (partner_id)
        REFERENCES broker(id)
        ON DELETE CASCADE,
    FOREIGN KEY (meter_point_id)
        REFERENCES meter_point(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;


INSERT INTO broker (id, name)
VALUES
    (1,'Bill'),
    (2,'Fred'),
    (3,'Amanda'),
    (4,'Karen'),
    (5,'Jane'),
    (6,'Sayad'),
    (7,'Ameel'),
    (8,'Jason'),
    (9,'Phil'),
    (10,'Susan')
;
INSERT INTO meter_point (id, meterpoint, consumption, uplift)
VALUES
    (1,'100023457678',789,1),
    (2,'158124565795',20146,1),
    (3,'132456478964',5899,2),
    (4,'106354689332',23,2),
    (5,'235544576575',103576,5),
    (6,'154357890977',23456,1),
    (7,'173345089323',4324,1),
    (8,'192235768686',34343,2),
    (9,'142389808776',465678,2),
    (10,'100003225456',2224,2),
    (11,'234565576565',3454,2),
    (12,'143657576544',34543,2),
    (13,'145465756556',453544,3),
    (14,'132457657567',34454,2),
    (15,'124334354545',876,1),
    (16,'194534545345',124,3),
    (17,'103433434252',356,1),
    (18,'103432542354',3234,1),
    (19,'123676567434',7655,2),
    (20,'185464456543',975,1),
    (21,'109565465645',3467,1),
    (22,'176456469453',3478,1),
    (23,'134432554544',333,2),
    (24,'133453453453',222,2),
    (25,'179879783453',143,2),
    (26,'144543563453',12454,2),
    (27,'154765467555',25678,1),
    (28,'197897894564',2323,1),
    (29,'189867567674',8778,1),
    (30,'194563453454',6544,1),
    (31,'108567546546',879,2),
    (32,'105653656454',3457,2),
    (33,'104554545453',5456,3),
    (34,'103433243442',83456,1),
    (35,'213454535334',1834,1),
    (36,'125654656546',23456,1),
    (37,'178565654656',4545,1),
    (38,'103432433433',4544,1),
    (39,'103243542543',9687,2),
    (40,'130000045454',34567,1),
    (41,'134368900055',3454,2),
    (42,'188554633454',23456,2),
    (43,'143234546589',235,2),
    (44,'103432434233',222,2),
    (45,'103454543543',5465,2),
    (46,'185463546546',676,1),
    (47,'123434324323',997,1),
    (48,'104453453454',444,1),
    (49,'194543453433',2354,2),
    (50,'143433243243',3556,2)
;

INSERT INTO meter_point_partner (id, partner_id, meter_point_id)
VALUES
    (1,1,1),
    (2,1,24),
    (3,1,25),
    (4,1,37),
    (5,2,38),
    (6,2,45),
    (7,3,2),
    (8,3,26),
    (9,3,27),
    (10,3,28),
    (11,3,39),
    (12,3,40),
    (13,3,41),
    (14,3,46),
    (15,4,3),
    (16,4,4),
    (17,4,5),
    (18,4,11),
    (19,4,18),
    (20,4,19),
    (21,4,29),
    (22,4,30),
    (23,4,47),
    (24,4,48),
    (25,4,49),
    (26,4,50),
    (27,5,6),
    (28,5,7),
    (29,5,12),
    (30,5,17),
    (31,5,20),
    (32,5,21),
    (33,5,31),
    (34,5,32),
    (35,5,33),
    (36,6,8),
    (37,6,13),
    (38,6,15),
    (39,7,9),
    (40,7,22),
    (41,8,10),
    (42,8,14),
    (43,8,16),
    (44,8,23),
    (45,8,34),
    (46,9,44),
    (47,10,35),
    (48,10,36),
    (49,10,42),
    (50,10,43)
;
