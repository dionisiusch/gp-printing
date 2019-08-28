<HTML>
<style>
.login-page {
  width: 360px;
  padding: 2% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
h2 {
  opacity: 0.7;
  font-size: 64px;
  color: white;
    text-shadow: 2px 2px 15px #000000;
}
body {
  background: #ffffff; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #ffffff, #376aed);
  background: -moz-linear-gradient(right, #ffffff, #376aed);
  background: -o-linear-gradient(right, #ffffff, #376aed);
  background: linear-gradient(to left, #ffffff, #376aed);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>
	<HEAD>
	</HEAD>
	<BODY>
    <div style="margin-top:200;">
      <span style="margin-left: 25%;margin-top: 20%;font-weight: bold;font-size: 64px;color: white;text-shadow: 2px 2px 15px #000000;opacity:0.8">GP PRINTING</span>
      <span style="padding-left: 15;margin-left: 15;border-left: 3px solid white;font-weight:100;font-size: 54px;color: white;text-shadow: 2px 2px 15px #000000;opacity:1">  WELCOME</span></h2>
    </div>
	<div class="login-page">
  <div class="form">
    <form method='post' action='../controller/login/logincheck.php'>
      <input type="text" name='user' autocomplete="off" placeholder="username"/>
      <input type="password" name='pass' placeholder="password"/>
      <input style="background-color: orange;"type='submit' name='submit' value='Login'>

    </form>

  </div>
</div>
	</body>
</html>
