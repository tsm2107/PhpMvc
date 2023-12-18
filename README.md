
## Запуск приложения с использованием этого фреймворка

1. ```git clone https://github.com/tsm2107/phpMVC ```
2. ```composer update```
3. Настройте web сервер
Пример конфигурации Nginx:
```php
location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
```

## Основы маршрутизации
Все маршруты определены в ваших файлах маршрутов, которые расположены в ф [Cms.php](/engine/Cms.php). Эти файлы автоматически загружаются вашим приложением [PublicController](/cms/Controller/PublicController.php).

Например, вы можете получить доступ к следующему маршруту, перейдя к http://example.com/ или http://example.com/1234  в браузере:
```php
$this->router->add('HomePage', '/', 'PublicController:index');
```
Или вы можете добавить **переменные** маршрута, например:
```php
$this->router->add('HomePageVaible', '/(id:int)', 'PublicController:index2');
```
Или вы можете добавить **Тип маршрута**  маршрута, по умолчанию используется GET Можно установить(POST) например:
```php
$this->router->add('[Название контроллера]', '/([переменная]:[тип(int,any,str)])', '[Класс контроллера]:[функция]','[тип запроса (POST,GET)]');
```
## Контроллеры

Контроллеры реагируют на действия пользователя (нажатие на ссылку, отправка формы и т. д.). 
Контроллеры хранятся в папке [cms/Controller](/cms/Controller) 
Образец [HomePage контроллера](/cms/Controller/CrmController.php) включен.

Классы контроллеров должны находиться в пространстве имен namespace Cms\Controller; использовать расширение use Engine\Controller;
Пример:
```php
namespace Cms\Controller;
use Engine\Controller;
class PublicController extends Controller
{
public function __construct($di)
    {
        parent::__construct($di);
    
    }
    public function index(){
        echo "INDEX";
        }
    public function index2($id){
        echo "INDEX-{$id}";
        }
}
```

## Шаблонизатор
[Шаблонизатор] Шаблоны находятся в папке (template). По умолчанию установлен Шаблонизатор Twig, но вы сами можите установить какoй захотите.

Пример:
```php
$this->di->get('templates')->render('index.twig', ['q' => 1]);
```
Это событие вернет шаблон (template/index.twig)

## Расширяемые классы 
MVC поддерживает расширения
Если вам нужно добавить кэширование данных в редис
вы должны установить его в composer require predis/predis
Затем в папке [engine/Service](/engine/Service) создать папку **Cache** в папке **engine/Service/Cache** Создать класс Provider (**Provider.php**). 
Классы Provider должны находиться в пространстве имен **namespace Engine\Service\Cache;**
использовать расширение **use Engine\Service\AbstractProvider;** 
И использовать расширяемый класс для доступа из пакета composer **use Redis;**
Пример:
```php
namespace Engine\Service\Cache;
use Engine\Service\AbstractProvider;
use Redis;//класс для доступа из пакета composer
class Provider extends AbstractProvider
{
    public $serviceName = 'MyСacheRedis';
    public function init()
    {
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $this->di->set($this->serviceName, $redis);//Расширение добавляются методом set.
    }
}
```
 Делее в папке [engine/Service/Config/](/engine/Config/)  в файле [Service.php](/engine/Config/Service.php) есть массив в него добавляем нового провайдера **Engine\Service\Cache\Provider::class**
 Потом в действиях контроллеров через свойство **$this->di->get** можно получить доступ к **MyСacheRedis**
 Пример:
 ```php
 $this->di->get('MyСacheRedis')->set();
 ```
