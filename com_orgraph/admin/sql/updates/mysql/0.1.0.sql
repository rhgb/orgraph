-- organization_graph
-- Copyright © 2012 Shanghai GM. All rights reserved.
-- License: GNU/GPL
--
-- organization_graph table(s) definition
--
--
drop table if exists `#__orgraph_user`;
drop table if exists `#__orgraph_dept`;
create table `#__orgraph_dept` (
	id int auto_increment primary key,
	name varchar(255) not null,
	description varchar(255) null,
	parent_id int null,
	ts timestamp default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
	) engine=innodb;
create table `#__orgraph_user` (
	id int auto_increment primary key,
	position varchar(255) not null,
	dept_id int not null,
	user_id int not null,
	index (dept_id, user_id),
	foreign key (dept_id)
		references #__orgraph_dept(id)
		on update cascade on delete cascade,
	foreign key (user_id)
		references #__users(id)
		on update cascade on delete cascade
	) engine=innodb;
	
-- generate example data
insert into `#__orgraph_dept` (name,description,parent_id) values
	('headquater','The headquater of ptme',null),
	('hr','Human resources',1),
	('finance','Finance dept',1),
	('tech','Technical dept',1),
	('EE','EE section',4),
	('Mech','Mechanical section',4);
insert into `#__orgraph_user` (position,dept_id,user_id) values
	('manager',1,48),
	('engineer',4,42),
	('engineer',4,44),
	('assistant',5,45);