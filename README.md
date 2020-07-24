# php-eventstream-sse-chat
A simple and more customizable version of https://alois.xyz 's chat.
> No database, light weight, simple to use.

### Why using server sent events?
Server sent events allow you to save alot of bandwith and simple managment.

## Pre-requisits
* For this code to work, you will need an apache server with php (not php fpm because of buffer issues) enabled.
* The php opcache mod:
```
phpenmod opcache
```
Then edit php.ini (/etc/php/*your php version*/apache2/php.ini) to set ```opcache = 1```.

## Customization
The most important thing to do before deploying this chat is to edit the variables in send.php. Username variable can be set to something like $_SESSION['username'].

## Licensing
You are free to use this code as you wan't but it would be cool to be mentioned (https://github.com/ithirzty/php-eventstream-sse-chat) somewhere :).

## Warning
PHP is not made to keep connections alive. That's why the refresh.php script needs to be as optimized as possible when adding more scripts to it.
