-- organization_graph
-- Copyright © 2012 Shanghai GM. All rights reserved.
-- License: GNU/GPL
--
-- organization_graph table(s) definition
--
--
drop table if exists `#__orgraph_dept`;
drop table if exists `#__orgraph_user`;
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