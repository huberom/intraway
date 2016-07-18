# Intraway Test

Web application implemented in Symfony 2.8.
Solution for the Hackerrank challenge https://www.hackerrank.com/challenges/subsequence-weighting

### Installing

First you need to run composer in order to get the required dependencies

```
php composer.phar install
```

Then you have to create a virtual host pointing to the web/ folder

If your are using apache then it would be something like

```
<VirtualHost *:80>
    ServerName your.local.name
    DocumentRoot "/path/to/project/web"
    <Directory "/path/to/project/web">
       AllowOverride all
    </Directory>
</VirtualHost>
```
