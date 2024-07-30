# feature/google-login
## 진행과정

2. api에 하니까 보내는건 되는데 이거 다시 web.php에서 해보고 csrf토큰을 넣어서 보내보자 
3. 아니면 일단 api 백엔드에서 구글토큰 처리하는거 해보자 
4. POST는 잘 가진다 다만 여기서 처리하는 과정에서 문제가 생겨서 405인가 오류가 나는 것 
5. userFromToken 메소드가 안먹힌다 
6. https://laravel.com/docs/11.x/providers
https://www.youtube.com/watch?v=j-lVevL_72E&t=1109s

# 구글 로그인의 구조 (https://velog.io/@nuri00/Google-OAuth-%EB%A1%9C%EA%B7%B8%EC%9D%B8-%EA%B5%AC%ED%98%84)
1.  프론트엔드에서 구글 로그인을하고 인가코드를 받아온다
2.  받아온 인가코드를 다시 POST로 구글로그인 서버에 보낸다 (이 때 'Content-Type': 'application/x-www-form-urlencoded'과 body:params.toString()) 형식으로 보내주어야한다 body는 params 매개변수 형태로 보내야한다 
3.  무사히 서버에 보냈으면 redirect_uri를 설정한 주소로 토큰 데이터들이 날아온다 
4.  토큰 데이터는 access_token, expires_in, id_token 등이 있는데 이 중 access_token을 백엔드로 POST로 보내준다 
5.  백엔드에서 POST로 access_token을 받았으면 이걸 다시 구글로그인 서버와 통신한다 
6.  통신이 완료된 경우 유저 정보를 백엔드로 받는다 (이 때 기존 유저가 존재하지 않을시 DB에 유저 정보를 입력한다) -> 여기까지 완료 
7.  프론트엔드로 로그인완료 정보와 유저 정보를 보낸다(아직 완료 못함)

## 구현하며 알아본 라라벨의 특징 
1.  이유는 모르겠지만 라우터와 컨트롤러를 수정하였을 때 실시간으로 수정이 안되고 서버를 끄고 캐시를 클리어해야 수정되는 경우가 종종있다
2.  하나의 모델에는 하나의 테이블을 주는것이 바람직 한 것 같다 (https://m.blog.naver.com/rkttndk/221822341130)
3.  프론트에서 POST로 보냈을 때 500에러가 뜨는 경우가 있다 이때에는 백엔드에서 뭔가 잘못되었다는 것이다 
4.  간혹 라라벨측에서 route경로가 get인데 post가 왔다고 오류를 띄우는 경우가 있는데 이유는 모르겠지만 그냥 무시하고 구현해도 작동한다

## 공통된 특징 
1.  env 파일에 구글 API와 통신하는데 필요한 URI, CLIENT_ID 등을 정확하게 적는것이 중요하고 안전하다 