<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="gambar/logoku.png">
    <title>Login Page</title>
    
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="{{route('auth.authentication') }}" method="post">
            {{ csrf_field() }}
            <div class="input-container">
                <label for=" username">Email </label>
                <input type="text" id="username" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            @error('email')
          <div class="al">{{ $message }}</div>
        @enderror
            <div class="input-container">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password">
            </div>
            <p>or</p><br>
            <div class="log"><a href="">
                <img src="gambar/icon google.png" alt="">
                <p> Lanjut dengan akun google</p></a>
            </div><br>
            <div class="log"><a href="">
                <img src="gambar/iconFB.png" alt="">
                <p> Lanjut dengan akun fecebook</p></a>
            </div><br><br>
            <button type="submit">Login</button>          
        </form>
        <p>don't have an account yet ? <a href="/register">Sign Up</a></p>
    </div>
</body>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #ffff;
    background-size: cover;
    margin: 0;
    padding: 0;
}

.login-container {
    background-color: black;
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    /* box-shadow: 0px 0px 100px rgba(0, 0, 8, 0.2); */
    box-shadow: 0 2px 41px rgba(0, 0, 0, 0.5);
    border-radius: 15px;
    text-align: center;
}
.login-container a{
    text-decoration: none;
}
h2 {
    color: #ffff;
}
p {
    color: #ffff;
}

p a {
    color: aqua;
}
.input-container {
    margin: 20px 0;
    text-align: left;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #ffff;
}

input[type="text"],
input[type="password"] {
    width: 90%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 10px;
}
button {
    background-color: #19eefd;
    color: black;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #267b81;
    color: white;
}
.log {
    height: 2rem;
    box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.2);
    width: 80%;
    text-decoration: none;
    background-color: white;
    margin-left: 2.5rem;
    border-radius: 3rem;
    display: flex;
    align-items:center;
    justify-content: center;

}
.log img {
    height: 1.2rem;
    border-radius: 80rem:
    
}
.log a {
    display: flex;
    align-items:center;
    justify-content: center;
    text-decoration: none; 
    font-size: 0.8rem;
}
.log p {
    color: #000;
}
.al{
    color: red;
}

</style>
</html>