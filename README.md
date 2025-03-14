# SDK_PHP
Uso del SDK de PHP para Mercado Pago

--------------
PRIMERO PASOS

1. Instalar Homebrew desde este sitio: https://brew.sh/es/
2. Next steps:
       - Run these commands in your terminal to add Homebrew to your PATH:
	echo >> /Users/[user_computer]/.bash_profile
	echo 'eval "$(/opt/homebrew/bin/brew shellenv)"' >> /Users/[user_computer]/.bash_profile
	eval "$(/opt/homebrew/bin/brew shellenv)”
3. Ejecuta el comando “brew - -version” para verificar que se muestre la versión de brew instalada.
4. Instalar PHP, ejecuta el comando: “brew install php”
5. Validar que PHP se instalo, ejecuta el comando “php -v” debería mostrarte la versión instalada.
6. Instalar composer
    a) Creamos una parte de nombre "composer" dentro de nuestro proyecto.
    b) En la terminal cambiamos al directorio de la carpeta de nombre "composer".
    c) Dentro de la carpeta en la terminal, ejecutamos los comandos que vienen en la siguiente guia: https://getcomposer.org/download/
    d) Nos creara un archivo dentro de la carpeta "composer" de nombre "composer.phar"
7. Ahora bien, para instalar composer de manera global usaremos el comando: sudo mv composer.phar /usr/local/bin/composer     
7. Estamos listos para usar e instalar la librería de Mercado Pago en la carpeta composer.
8. Dentro de la carpeta composer en la terminal, vamos a instalar la libreria de Mercado Pago como lo vemos en el GitHub: https://github.com/mercadopago/sdk-php
9. Instalar "dotenv" para el uso de variable de entorno: ejecuta el siguiente comando en la terminal dentro de la carpeta composer -> "composer require vlucas/phpdotenv" (https://github.com/vlucas/phpdotenv)


