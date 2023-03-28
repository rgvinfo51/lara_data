<DOCTYPE html>
   <html lang="en-US">
     <head>
     <meta charset="utf-8">
     </head>
     <body>
     <strong> Hi {{$data['name']}},<br>  <strong>
	 <p>Your account has been created, Please use below detail for login</p>
  
<p><strong>Username: </strong> {{$data['email']}}</p><br>
<p><strong>Password: </strong> {{$data['password']}}</p><br>

<p><a href="{{route('home')}}">Click Here for Login</a></p>

<p>Tnanks & regards</p><br>
<span>CGWB</span>
</body>
</html>