# PHP Pagination
`A package to facilitate pagination`
## install
```bash
composer require mahmoud-abdelfadeil/php-pagination
```
`Full EX`

```php
<?php

use PhpPagination\Pagination;

include 'vendor/autoload.php';
$config_db=[
    "db_host"=>"localhost",
    "db_name"=>"pagination_test",
    "db_user"=>"root",
    "db_password"=>""
];
$pagination = new Pagination($config_db,2);

$users = $pagination->table('users')->column(['*'])->get();
echo "<pre>";
var_dump($users);
?>

<a href="<?php echo $pagination->prevPage() ?>">prev</a><br>

<a href="<?php echo $pagination->nextPage() ?>">next</a><br>

<a href="<?php echo $pagination->firstPage() ?>">first</a><br>

<a href="<?php echo $pagination->lastPage() ?>">last</a><br>

<p>page : <?php echo $pagination->currentPage()  ?> of <?php echo $pagination->countPages()  ?></p>


```

## use
`1 - include vendor autoload`

```php
include 'vendor/autoload.php';
```

`2 - use class  Pagination`

```php
use PhpPagination\Pagination;
```

`3 - database config (array keys static)`

```php
$config_db=[
    "db_host"=>"localhost",
    "db_name"=>"pagination_test",
    "db_user"=>"root",
    "db_password"=>""
];
```

`4 - instans object Pagination (param 1 , param 2)`

```php

// param 1 (required)=>array config database
// param 2 (optional)=>int count items [default 20]

$count_items=10; //  optional (default 20 items in 1 page)
$pagination = new Pagination($config_db , $count_item);
```

`5 - EX `

```php
$users = $pagination->table('users')->column(['*'])->get();
// tabel (table name)
// column (select column in table ) 
// column array | string 
// ex string
$users = $pagination->table('users')->column('*')->get();
$users = $pagination->table('users')->column('name , email')->get();

// ex array 
$users = $pagination->table('users')->column(['*'])->get();
$users = $pagination->table('users')->column(['name' , 'email'])->get();
```

`5 -  Helper function : `
<br><br>

`prevPage() previous page`
<br><br>
`nextPage() next page `
<br><br>
`firstPage() first page` 
<br><br>
`lastPage() last page`
<br><br>
`currentPage() current page`
<br><br>
`countPages() count pages`

```php
<a href="<?php echo $pagination->prevPage() ?>">prev</a><br>

<a href="<?php echo $pagination->nextPage() ?>">next</a><br>

<a href="<?php echo $pagination->firstPage() ?>">first</a><br>

<a href="<?php echo $pagination->lastPage() ?>">last</a><br>

<p>page : <?php echo $pagination->currentPage()  ?> of <?php echo $pagination->countPages()  ?> </p> // output page : 49 of 53

```



