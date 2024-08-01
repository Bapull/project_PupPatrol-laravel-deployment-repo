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

## S3 버킷 연결하는 법
1. aws 회원가입을 한다.
2. S3 버킷을 만들고, 만들때 퍼블릭 엑세스 차단은 전부 해제한다.
3. iam 사용자를 생성한다. 생성할때 권한정책은 AmazonS3FullAccess를 선택한다.
4. 엑세스키는 저장해둔다.
5. 아까 만들어둔 S3 버킷의 권한 탭으로 가서 버킷정책과 cors를 설정해주어야한다.
- 버킷정책: {
    "Version": "2012-10-17",
    "Statement": [
        {
            "Sid": "Statement1",
            "Effect": "Allow",
            "Principal": {
                "AWS": (아까 만든 iam 사용자의 arn)
            },
            "Action": [
                "s3:PutObject",
                "s3:GetObject",
                "s3:DeleteObject"
            ],
            "Resource": "arn:aws:s3:::(s3버킷이름)/*"
        }
    ]}
  - cors [
    {
        "AllowedHeaders": [
            "*"
        ],
        "AllowedMethods": [
            "GET",
            "POST",
            "PUT",
            "DELETE",
            "HEAD"
        ],
        "AllowedOrigins": [
            "http://localhost:3000/*",
            "http://localhost:8000/*",
            "http://www.bapul.store/*",
            "https://localhost:3000/*",
            "https://localhost:8000/*",
            "https://www.bapul.store/*"
        ],
        "ExposeHeaders": []
    }
] 
이렇게 설정을 하면 된다.
6. 시작하는 법의 1~7번까지 실행한다.
7. .env 파일에가서 AWS 가 붙은 것들을 입력해주어야한다.
    - AWS_ACCESS_KEY_ID=(IAM 사용자의 access키)
    - AWS_SECRET_ACCESS_KEY=(IAM 사용자의 secret_access 키)
    - AWS_DEFAULT_REGION=ap-northeast-2
    - AWS_BUCKET=(내가 만든 버킷 이름 arn말고 그냥 이름입력)
    - AWS_URL= https://s3.ap-northeast-2.amazonaws.com/(버킷이름)/
    - AWS_USE_PATH_STYLE_ENDPOINT=false
8. php artisan serve로 실행한다.
9. 리액트 프로젝트 파일도 다운받는다.
10. npm start로 실행후, /image로 이동한다.
11. 테스트 해본다.
