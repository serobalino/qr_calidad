/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     09/10/2018 15:42:21                          */
/*==============================================================*/


drop table if exists calificaciones;

drop table if exists categoria_1;

drop table if exists categoria_2;

drop table if exists categoria_3;

drop table if exists password_resets;

drop table if exists reacciones;

drop table if exists servicios;

drop table if exists users;

/*==============================================================*/
/* Table: calificaciones                                        */
/*==============================================================*/
create table calificaciones
(
   id_re                smallint not null,
   id_se                int not null,
   creado_ca            datetime,
   comentario_ca        text,
   navegador_ca         varchar(300),
   tipo_ca              varchar(100),
   ip_ca                varchar(100),
   os_ca                varchar(100),
   id_ca                varchar(100)
);

/*==============================================================*/
/* Table: categoria_1                                           */
/*==============================================================*/
create table categoria_1
(
   id_c1                int not null auto_increment,
   titulo_c1            varchar(200) not null,
   primary key (id_c1)
);

/*==============================================================*/
/* Table: categoria_2                                           */
/*==============================================================*/
create table categoria_2
(
   id_c1                int,
   id_c2                int not null auto_increment,
   titulo_c2            varchar(200) not null,
   primary key (id_c2)
);

/*==============================================================*/
/* Table: categoria_3                                           */
/*==============================================================*/
create table categoria_3
(
   id_c2                int,
   id_c3                int not null auto_increment,
   titulo_c3            varchar(200) not null,
   primary key (id_c3)
);

/*==============================================================*/
/* Table: password_resets                                       */
/*==============================================================*/
create table password_resets
(
   token                varchar(200),
   email                varchar(200),
   created_at           timestamp
);

/*==============================================================*/
/* Table: reacciones                                            */
/*==============================================================*/
create table reacciones
(
   id_re                smallint not null,
   titulo_re            varchar(20) not null,
   primary key (id_re)
);

/*==============================================================*/
/* Table: servicios                                             */
/*==============================================================*/
create table servicios
(
   id_se                int not null auto_increment,
   id_c3                int not null,
   titulo_se            varchar(100) not null,
   codigo_se            varchar(10),
   descripcion_se       varchar(500),
   primary key (id_se)
);

/*==============================================================*/
/* Table: users                                                 */
/*==============================================================*/
create table users
(
   id                   int not null auto_increment,
   name                 varchar(200),
   email                varchar(200) not null,
   email_verified_at    timestamp,
   password             varchar(200),
   remember_token       varchar(200),
   created_at           timestamp,
   updated_at           timestamp,
   primary key (id)
);

alter table calificaciones add constraint fk_servicios_calificaciones foreign key (id_se)
      references servicios (id_se) on delete restrict on update restrict;

alter table calificaciones add constraint fk_tipo_de_calificaciones foreign key (id_re)
      references reacciones (id_re) on delete restrict on update restrict;

alter table categoria_2 add constraint fk_cat1_cat2 foreign key (id_c1)
      references categoria_1 (id_c1) on delete restrict on update restrict;

alter table categoria_3 add constraint fk_cat2_cat3 foreign key (id_c2)
      references categoria_2 (id_c2) on delete restrict on update restrict;

alter table servicios add constraint fk_caategoria_servicios foreign key (id_c3)
      references categoria_3 (id_c3) on delete restrict on update restrict;

