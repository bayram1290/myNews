1. git clone -b master https://github.com/bayram1290/myNews.git

2. Войдите в папку «myNews»

3. Введите команду
-> composer install

4. Продублируйте файл «.env.example» с именем «.env».

5. Создайте базу данных с именем «myNews» и создайте пользователя базы данных. Кроме того, дайте необходимое разрешение для этого пользователя

6. Войдите в файл «.env» и измените его с помощью операторов, показанных ниже.

APP_NAME="Мои новости"

APP_ENV=local

APP_KEY=

APP_DEBUG=true

APP_TIMEZONE='Asia/Ashgabat'

APP_URL=http://localhost

APP_LOCALE=ru

APP_FALLBACK_LOCALE=en

APP_FAKER_LOCALE=en_US


……………..

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=myNews

DB_USERNAME=test // измените требуемое имя пользователя, созданное выше в MySQL

DB_PASSWORD=test // измените пароль пользователя, созданное выше в MySQL


7. Введите команду
-> php artisan key:generate
-> php artisan migrate && php artisan db:seed

8. Введите команду (требуется node версии 20 или выше)
-> npm install 
-> npm fund
-> npm run build
-> php artisan serve

9. Вставьте URL-адрес в браузер, который отобразится в консоли, например:

=> http://127.0.0.1:8000



Учетные данные пользователя для страницы входа:

логин: superadmin,
password: superpassword

login: admin,
password: adminpassword

login: manager,
password: managerpassword
