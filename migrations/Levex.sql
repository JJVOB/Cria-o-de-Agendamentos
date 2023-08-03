CREATE SCHEMA levex;
USE levex;

CREATE TABLE consultoria(
    ID              bigint unsigned auto_increment primary key,
    data_inicial    datetime,
    data_final      datetime,
    titulo          varchar(255),
    descricao       varchar(255),
    cliente         varchar(255)
);