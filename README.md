 <h1 align="center">Сервис ChessBase</h1>
  <p>Этот проект реализован с помощью PHP 8.0 , фреймворка Slim 4, doctrine, PostgreSql и Nginx.


<h2>API:</h2>
<ul>

- POST/signUp - регистрация пользователя

- POST/signIn - аутентификация и выдача токена в заголовке Token

- GET/user/info - получить данные о пользователе

- GET/user/edit - редактирование свойств пользователя

- DELETE/user/delete - удалить пользователя

- GET/user/signOut - выйти из профиля

- POST/user/subscription/add - добавить подписку на пользователя

- POST/user/subscription/delete - отписаться от пользователя

- GET/user/subscribers/show - список подписчиков

- GET/user/subscriptions/show - список подписок
  
- GET/game/show - список партий, берет партии из LiChess.org (Нужно вести имя профиля lichess_name)
  
- POST/message/send - отправить сообщение пользователю  
  
- GET/message/show - показать сообщения диалога    
</ul>

<h2>Чтобы запустить проект, выполните:</h2>

 1. Создайте контейнеры:

```docker compose build```
2. Запустите их:
```docker compose up -d```
3. Проверьте созданные docker-контейнеры:
```docker ps```
4. Готово 😊
