<h1 align="center">MODULES</h1>
<h4 align="center">
Модули, компоненты, комплексные компоненты
</h4>

<p align="center">
    <img src="https://img.shields.io/badge/phpstorm-143?style=for-the-badge&logo=phpstorm&logoColor=black&color=black&labelColor=darkorchid">
    <img src="https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white">
    <img src="https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white">
    <img src="https://img.shields.io/badge/1c-bitrix-4479A1.svg?style=for-the-badge&logoColor=red">
</p>

________

## Содержание

- <a href="#О-проекте">О проекте</a>
- <a href="#Настройка">Настройка</a>
  - <a href="#OpenServer">OpenServer</a>
  - <a href="#Git">Git</a>
  - <a href="#База-данных">База данных</a>
- <a href="#Документация">Документация</a>
  - <a href="#Простые-компоненты">Простые компоненты</a> 
  - <a href="#Комплексные-компоненты">Комплексные компоненты</a>
  - <a href="#Модули">Модули</a>
- <a href="#Разработчик">Разработчик</a>

________

## [О проекте](#О-проекте)

Этот проект предназначен в первую очередь для тестирования на 3 этапе в компании _[Consolt Info](https://www.consult-info.ru/)_.

В этом проекте представлены два _простых компонента_, _один комплексный_ и _один простой модуль_.

Все было сделано на одной из старых и популярных _CMS_ _[1С-BITRIX](https://www.1c-bitrix.ru/)_.
________

## [Настройка](#Настройка)
### [OpenServer](#OpenServer)
```
HTTTP: Apache_2.4-PHP_8.0-8.1
PHP: PHP_8.1
MySQL: MySQL-5.7-Win10
```

### [Git](#Git)

```git
git clone https://github.com/URLbug/MODULES.git
cd domains\MODULES
```

### [База данных](#База-данных)
```powershell
mysql -h 127.0.0.1 -p -u root modules < dump.sql 
```

________

## [Документация](#Документация)

### [Простые компоненты](#Простые-компоненты)

#### Группа пользователей (modular.users)

Пример:
```php
$APPLICATION->IncludeComponent(
	"modular:modular.users",
	"",
	Array(
		"CASH_TIME" => "36000",
		"TITLE" => "Группа пользователей"
	)
);
```

Описание:

Протой компонент группа пользователей является простым компонентом, который выводит всю группу пользователей.

Параметры:

 - CASH_TIME - За какое время должно кешироватся компонент. По умолчанию стоит 36000.
 - TITLE - Выводит на страницу заголовок.
 - LINKS - _(Параметр заглушка для второй задачи)_ Является временным параметром, который обрабатывает ЧПУ запросы.

____

#### Детальная страница групп пользователей (modular.detail)

Пример:
```php
$APPLICATION->IncludeComponent(
	"modular:modular.detail",
	"",
	Array(
		"ID" => "1"
	)
);
```

Описание:

Простой компонент, который выводит одну группу пользователей.

Параметры:

- ID - Выводимый ID группы пользователей.

____

### [Комплексные компоненты](#Комплексные-компоненты)

#### Абсолютная группа пользователей (modular)

Пример:
```php
// С ЧПУ
$APPLICATION->IncludeComponent(
	"modular:modular",
	"",
	Array(
		"CASH_TIME" => "36000",
		"SEF_FOLDER" => "/users/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("detail"=>"#ELEMENT_ID#/"),
		"TITLE" => "TEST"
	)
);
```

```php
// Без ЧПУ
$APPLICATION->IncludeComponent(
	"modular:modular",
	"",
	Array(
		"CASH_TIME" => "36000",
		"SEF_MODE" => "N",
		"TITLE" => "TEST"
	)
);
```

Описание:

Простой компонент, который выводит одну группу пользователей.

Параметры:

- CASH_TIME - За какое время должно кешироватся компонент. По умолчанию стоит 36000.
- TITLE - Выводит на страницу заголовок.
- SEF_MODE - ЧПУ режим [(см. больше о ЧПУ в 1C-BITRIX)](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=34&LESSON_ID=10233&ysclid=lufm56e7vl695499335).
- SEF_URL_TEMPLATES - Если чпу вкл. то принимает _**обязательный параметр**_ - "#ELEMENT_ID#/".

____

### [Модули](#Модули)

#### Это модуларе (the_modulare)

Описание:

Простой модуль который выгружает, перечисленные ранее выше, компоненты в папку ```local/components/modular```.

________

## [Разработчик](#Разработчик)

<p align="center">
  <img src="https://avatars.githubusercontent.com/u/79089275?s=400&u=17a1fabcbae6fe4875bf049e57d03a6416b90a22&v=4" style="width: 200px; height: 200px;  border-radius: 50%;">
</p>

<p align="center">
  <a href="https://github.com/URLbug">Rui Carter (Тимур Давыдов)</a>
</p>

________
