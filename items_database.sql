SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS categories (
  category_id int NOT NULL AUTO_INCREMENT,
  category_description varchar(30) NOT NULL,
  category_level int NOT NULL,
  PRIMARY KEY (category_id)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS units (
  unit_id int NOT NULL AUTO_INCREMENT,
  unit_name varchar(30) NOT NULL,
  PRIMARY KEY (unit_id)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO units (unit_name) VALUES ("metro"),("segundo"),("mol"),("kilogramo"),("kelvin"),("candela"),("amperio"),
									 ("hercio"),("newton"),("pascal"),("julio"),("vatio"),("culombio"),("voltio"),
									 ("ohmio"),("siemens"),("faradio"),("tesla"),("weber"),("henrio"),("radian"),
									 ("estereorradian"),("lumen"),("lux"),("becquerelio"),("gray"),("sievert"),("katal"),
									 ("litro"),("bar"),("grado celsius");

CREATE TABLE IF NOT EXISTS items (
  item_id int NOT NULL AUTO_INCREMENT,
  item_description varchar(30) NOT NULL,
  item_unit_id int(11) NOT NULL,
  item_price int NOT NULL,
  item_picture varchar(255) NOT NULL,
  item_category_id int(11) NOT NULL,
  PRIMARY KEY (item_id)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
