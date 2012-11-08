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
	dept_id int not null,
	user_id int not null unique,
	employee_no bigint not null unique,
	position varchar(255) not null,
	supervisor_id int null,
	tel varchar(16) null,
	mobile varchar(16) null,
	computer_id varchar(16) null,
	location varchar(8) null,
	birthday date null,
	index (dept_id, user_id, supervisor_id),
	foreign key (dept_id)
		references #__orgraph_dept(id)
		on update cascade on delete cascade,
	foreign key (user_id)
		references #__users(id)
		on update cascade on delete cascade,
	foreign key (supervisor_id)
		references #__users(id)
		on update cascade on delete set null
	) engine=innodb;