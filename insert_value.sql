insert into AirCrafts values (1,'SP-111A',100,'Alenia Aeronotica',NOW(),'Spicejet');
insert into AirCrafts values (2,'SP-112A',100,'Alenia Aeronotica',NOW(),'Spicejet');
insert into AirCrafts values (3,'IN-111A',100,'Alenia Aeronotica',NOW(),'Indigo');
insert into AirCrafts values (4,'IN-112A',100,'Alenia Aeronotica',NOW(),'Indigo');
insert into AirCrafts values (5,'AI-113A',100,'Alenia Aeronotica',NOW(),'Indigo');
insert into AirCrafts values (6,'AI-113A',100,'Alenia Aeronotica',NOW(),'Spicejet');
insert into AirCrafts values (7,'AI-111A',100,'Alenia Aeronotica',NOW(),'Air India');
insert into AirCrafts values (8,'AI-112A',100,'Alenia Aeronotica',NOW(),'Air India');
insert into AirCrafts values (9,'AI-113A',100,'Alenia Aeronotica',NOW(),'Air India');
insert into AirCrafts values (10,'AI-114A',100,'Alenia Aeronotica',NOW(),'Air India');
insert into AirCrafts values (11,'AI-115A',100,'Alenia Aeronotica',NOW(),'Air India');

insert into Route values (1,'Kolkata','Chennai','CCU-MMA');
insert into Route values (2,'Kolkata','Delhi','CCU-DEL');
insert into Route values (3,'Kolkata','Bangalore','CCU-BLR');
insert into Route values (4,'Kolkata','Mumbai','CCU-BOM');
insert into Route values (5,'Delhi','Chennai','DEL-MMA');
insert into Route values (6,'Delhi','Kolkata','DEL-CCU');
insert into Route values (7,'Delhi','Bangalore','DEL-BLR');
insert into Route values (8,'Delhi','Mumbai','DEL-BOM');
insert into Route values (9,'Mumbai','Chennai','BOM-MMA');
insert into Route values (10,'Mumbai','Delhi','BOM-DEL');
insert into Route values (11,'Mumbai','Bangalore','BOM-BLR');
insert into Route values (12,'Mumbai','Kolkata','BOM-CCU');
insert into Route values (13,'Bangalore','Chennai','BLR-MMA');
insert into Route values (14,'Bangalore','Delhi','BLR-DEL');
insert into Route values (15,'Bangalore','Bangalore','BLR-CCU');
insert into Route values (16,'Bangalore','Mumbai','BLR-BOM');
insert into Route values (17,'Chennai','Kolkata','MMA-CCU');
insert into Route values (18,'Chennai','Delhi','MMA-DEL');
insert into Route values (19,'Chennai','Bangalore','MMA-BLR');
insert into Route values (20,'Chennai','Mumbai','MMA-BOM');

insert into AirFare values (1,1,2999), (2,2,2999), (3,3,2999), (4,4,2999), (5,5,2999), (6,6,2999), (7,7,2999), (8,8,2999), (9,9,2999), (10,10,2999), (11,11,2999), (12,12,2999), (13,13,2999), (14,14,2999), (15,15,2999), (16,16,2999), (17,17,2999), (18,18,2999), (19,19,2999), (20,20,2999);

insert into Flight_Schedule values (1,'2018-07-10','12:00:00','14:00:00',1,1,100);
insert into Flight_Schedule values (2,'2018-07-10','13:00:00','15:00:00',2,2,100);
insert into Flight_Schedule values (3,'2018-07-10','14:00:00','16:00:00',3,3,100);
insert into Flight_Schedule values (4,'2018-07-10','15:00:00','17:00:00',4,4,100);
insert into Flight_Schedule values (5,'2018-07-10','16:00:00','18:00:00',5,5,100);
insert into Flight_Schedule values (7,'2018-07-10','17:00:00','19:00:00',6,6,100);
insert into Flight_Schedule values (8,'2018-07-10','18:00:00','20:00:00',7,7,100);
insert into Flight_Schedule values (9,'2018-07-10','19:00:00','21:00:00',8,8,100);
insert into Flight_Schedule values (10,'2018-07-10','20:00:00','22:00:00',9,9,100);
insert into Flight_Schedule values (11,'2018-07-10','21:00:00','23:00:00',10,10,100);
insert into Flight_Schedule values (12,'2018-07-10','21:00:00','23:00:00',1,11,100);
insert into Flight_Schedule values (13,'2018-07-10','20:00:00','22:00:00',2,12,100);
insert into Flight_Schedule values (14,'2018-07-10','19:00:00','21:00:00',3,13,100);
insert into Flight_Schedule values (15,'2018-07-10','18:00:00','20:00:00',4,14,100);
insert into Flight_Schedule values (16,'2018-07-10','17:00:00','19:00:00',5,15,100);
insert into Flight_Schedule values (17,'2018-07-10','16:00:00','18:00:00',6,16,100);
insert into Flight_Schedule values (18,'2018-07-10','15:00:00','17:00:00',7,17,100);
insert into Flight_Schedule values (19,'2018-07-10','14:00:00','16:00:00',8,18,100);
insert into Flight_Schedule values (20,'2018-07-10','13:00:00','15:00:00',9,19,100);
insert into Flight_Schedule values (6,'2018-07-10','12:00:00','14:00:00',10,20,100);

insert into Contact_Details values (1,'rit97bha@gmail.com','9840291060','Addr1');
insert into Passengers values (1,'Ritwik Bhattacharya',21,'Indian',1,SHA1('ritwik'));

