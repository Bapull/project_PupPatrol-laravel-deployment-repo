# project_PupPatrol-laravel-deployment-repo
## 시작하는 법
1. 레파지토리 연결한 후에 pull로 파일을 전부 가져온다.
2. composer i 로 라이브러리를 설치한다.
3. cp .env.example .env     명령어를 사용해서 환경설정 파일을 만든다.
4. .env 파일에
    - DB_CONNECTION=mysql
    - DB_HOST=127.0.0.1
    - DB_PORT=3306
    - DB_DATABASE=pup_patrol
    - DB_USERNAME=root
    - DB_PASSWORD=1234
   이 부분들을 알맞게 수정하면 된다. 로컬 호스트이고, mysql로 작업하고 있으면 다른건 안 건드리고 비밀번호만 수정하면 된다.
5. 4번에서 수정한 부분에 DB_DATABASE = 뒤에 부분에 있는 이름으로 데이터베이스를 생성해야한다.
   - 5-1. mysql workbench 실행
   - 5-2. 데이터베이스 연결
   - 5-3. 쿼리 열고 create database 뒤에있는이름; 으로 데이터베이스를 생성한다.
6. php artisan jwt:sevret     명령어로 jwt 시크릿 키를 생성한다.
7. php artisan migrate:fresh --seed     명령어로 테이블을 생성하고 초기데이터를 입력한다.
8. php artisan serve 로 서버를 실행한다.
