-- organization_graph
-- Copyright © 2012 Shanghai GM. All rights reserved.
-- License: GNU/GPL
--
-- organization_graph table(s) definition
--
--
drop table if exists `#__orgraph_proj_user`;
drop table if exists `#__orgraph_user`;
drop table if exists `#__orgraph_proj`;
drop table if exists `#__orgraph_dept`;

create table `#__orgraph_dept` (
	id int auto_increment primary key,
	name varchar(255) not null,
	description varchar(255) null,
	parent_id int null,
	ts timestamp default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
	)
	engine=innodb
	character set utf8;

create table `#__orgraph_proj` (
		id int auto_increment primary key,
		name varchar(255) not null,
		description varchar(255) null,
		parent_id int null,
		ts timestamp default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
	)
	engine=innodb
	character set utf8;

create table `#__orgraph_user` (
	id int auto_increment primary key,
	dept_id int not null,
	user_id int not null unique,
	employee_no varchar(16) not null unique,
	position varchar(255) not null,
	supervisor_id int null,
	tel varchar(16) null,
	mobile varchar(16) null,
	computer_id varchar(16) null,
	location varchar(8) null,
	birthday date null,
	avatar varchar(255) null,
	index (dept_id, user_id),
	foreign key (dept_id)
		references `#__orgraph_dept`(id)
		on update cascade on delete cascade,
	foreign key (user_id)
		references `#__users`(id)
		on update cascade on delete cascade
	)
	engine=innodb
	character set utf8;

create table `#__orgraph_proj_user` (
	id int auto_increment primary key,
	user_id int not null,
	proj_id int not null,
	index (user_id, proj_id),
	unique index (user_id,proj_id),
	foreign key (user_id)
		references `#__orgraph_user`(user_id)
		on update cascade on delete cascade,
	foreign key (proj_id)
		references `#__orgraph_proj`(id)
		on update cascade on delete cascade
	)
	engine=innodb
	character set utf8;