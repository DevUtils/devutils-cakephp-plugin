devutils-cakephp-plugin
=======================

CakePHP Plugin with common Helpers and Controllers facilities

## UrlHelper
Pagina: http://plugin.devutils.com.br/pages/url-helper/

```php
Command: <?php echo $this->Url->here(); ?>
Result : /pages/url-helper
```

```php
Command: <?php echo $this->Url->url('/test-page'); ?>
Result : http://plugin.devutils.com.br/test-page</pre>
```

```php
Command: <?php echo $this->Url->here('/pages/url-helper'); ?>
Result : bool(true)

Command: <?php echo $this->Url->here('/pages/url-helper/'); ?>
Result : bool(true)

Command: <?php echo $this->Url->here('/pages/other-page/'); ?>
Result : bool(false)
```

```php
Command: <?php echo $this->Url->slug(); ?>
Result : pages-url-helper	

Command: <?php echo $this->Url->slug('pages-url-helper'); ?>
Result : bool(true)

Command: <?php echo $this->Url->slug('pages-other-page'); ?>
Result : bool(false)
```

```php
Command: <?php echo $this->Url->nocache('/test-page'); ?>
Result : http://plugin.devutils.com.br/test-page?nc=PQ5874

Command: <?php echo $this->Url->nocache('/js/scripts.js'); ?>
Result : http://plugin.devutils.com.br/js/scripts.js?nc=YQ9184
```

```php
Command: <?php echo $this->Url->version('/test-page', '2.0.5'); ?>
Result : http://plugin.devutils.com.br/test-page?v=2.0.5

Command: <?php echo $this->Url->version('/test-page', 'time'); ?>
Result : http://plugin.devutils.com.br/test-page?v=20141102171135

Command: <?php echo $this->Url->version('/test-page'); ?>
Result : http://plugin.devutils.com.br/test-page?v=WD5046
```

```php
Command: <?php echo $this->Url->add('another-section'); ?>
Result : http://plugin.devutils.com.br/pages/url-helper/another-section

Command: <?php echo $this->Url->add('another-section', 'another-sub-section'); ?>
Result : http://plugin.devutils.com.br/pages/url-helper/another-section/another-sub-section
```

```php
Command: <?php echo $this->Url->count(); ?>
Result : 2
1 - pages
2 - url-helper

Command: <?php echo $this->Url->count(1); ?>
Result : bool(false)

Command: <?php echo $this->Url->count(2); ?>
Result : bool(true)

Command: <?php echo $this->Url->count(3); ?>
Result : bool(false)
```

```php
Command: <?php echo $this->Url->firstLevel(); ?>
Result : pages

Command: <?php echo $this->Url->lastLevel(); ?>
Result : url-helper

Command: <?php echo $this->Url->level(1); ?>
Result : pages

Command: <?php echo $this->Url->level(2); ?>
Result : url-helper

Command: <?php echo $this->Url->level(3); ?>
Result : 

Command: <?php echo $this->Url->level('first'); ?>
Result : pages

Command: <?php echo $this->Url->level('last'); ?>
Result : url-helper
```

## BrDateHelper
```php
Command: <?php echo $this->BrDate->date(); ?>
Result : 30/10/2014

Command: <?php echo $this->BrDate->time(); ?>
Result : 18:10:39

Command: <?php echo $this->BrDate->dateTime(); ?>
Result : 30/10/2014 18:10:39
```

```php
Command: <?php echo $this->BrDate->longDate(); ?>
Result : 30 de Outubro de 2014

Command: <?php echo $this->BrDate->longDate('30/10/2014'); ?>
Result : 30 de Outubro de 2014

Command: <?php echo $this->BrDate->longDate('30/10/2014 18:10:39'); ?>
Result : 30 de Outubro de 2014

Command: <?php echo $this->BrDate->longDate('2014-10-30'); ?>
Result : 30 de Outubro de 2014

Command: <?php echo $this->BrDate->longDate('2014-10-30 18:10:39'); ?>
Result : 30 de Outubro de 2014
```

```php
Command: <?php echo $this->BrDate->sqlDate(); ?>
Result : 2014-10-30

Command: <?php echo $this->BrDate->sqlDate('2014-10-30'); ?>
Result : 30/10/2014

Command: <?php echo $this->BrDate->sqlDate('2014-10-30 18:10:39'); ?>
Result : 30/10/2014

```

```php
Command: <?php echo $this->BrDate->sqlDateTime(); ?>
Result : 2014-10-30 18:10:39

```php
Command: <?php echo $this->BrDate->fromSql('2014-10-30'); ?>
Result : 30/10/2014

Command: <?php echo $this->BrDate->fromSql('2014-10-30 18:10:39'); ?>
Result : 30/10/2014 18:10:39

Command: <?php echo $this->BrDate->fromSqlToLong('2014-10-30'); ?>
Result : 30/10/2014
```

```php
Command: <?php echo $this->BrDate->toSql('30/10/2014'); ?>
Result : 2014-10-30

Command: <?php echo $this->BrDate->toSql('30/10/2014 18:10:39'); ?>
Result : 2014-10-30 18:10:39
```

## BrCepHelper
```php
Command: <?php echo $this->BrCep->mask('01310909'); ?>
Result : 01310-909
```

```php
Command: <?php echo $this->BrCep->mask('01310909', true); ?>
Result : 01.310-909
```

## CpfHelper
```php
Command: <?php echo $this->Cpf->validate('727.396.389-57'); ?>
Result : bool(true)
```

```php
Command: <?php echo $this->Cpf->validate('72739638957'); ?>
Result : bool(true)
```

```php
Command: <?php echo $this->Cpf->validate('12345678909'); ?>
Result : bool(false)
```

```php
Command: <?php echo $this->Cpf->validate('15837534718'); ?>
Result : bool(false)
```

## CnpjHelper
```php
Command: <?php echo $this->Cnpj->validate('78.004.106/0001-50'); ?>
Result : bool(true)
```

```php
Command: <?php echo $this->Cnpj->validate('78004106000150'); ?>
Result : bool(true)
```

```php
Command: <?php echo $this->Cnpj->validate('45463355436445'); ?>
Result : bool(false)
```
