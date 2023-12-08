<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="gambar/logoku.png">
    <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <div class="signup-form">
        <img src="gambar/logonama.png" alt="">
            <h2>Sign Up</h2>
            <form action="{{ route('auth.store') }}" method="post">
        @csrf
                <div class="form-group">
                    <input type="text" id="username" name="name" required placeholder="Username">
                </div>
                @error('name')
          <div class="alert">{{ $message }}</div>
        @enderror
                <div class="form-group">
                    <input type="email" id="email" name="email" required placeholder="Email">
                </div>
                @error('email')
          <div class="alert">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <select name="status"  required>
        <option value="Bapak/Admin">Bapak/Admin</option>   
        <option value="Ibu/Anggota">Ibu/Anggota</option>
        <option value="Anak">Anak</option>
        </select> 
                </div>
                <div class="form-group">
                  <input type="password" id="password" name="password" required  placeholder="Password">
              </div>
              @error('password')
          <div class="alert">{{ $message }}</div>
        @enderror
              <div class="form-group"> 
                  <input type="password" id="confirm-password" name="password_confirmation" required  placeholder="Confirm Password">
              </div>
              <button type="submit">Sign Up</button>
          </form>
          <p>Already have an account? <a href="login">Log in</a></p>
      </div>
  </div>
</body>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    background-size: cover;
    margin: 0;
    padding: 0;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
img {
    height: 5rem;
    border-radius: 210px;
}
.signup-form {
    background-color: black;
    border-radius: 18px;
    border: solid 1rem #ffff;
    box-shadow: 0 2px 41px rgba(0, 0, 0, 0.5);
    padding: 20px;
    text-align: center;
    width: 35rem;
}

.alert{
    color: red;
}

h2 {
    margin-bottom: 20px;
    color: #fff;
}

.form-group {
    margin-bottom: 15px;
    display: flex;
    align-items:center;
    justify-content: center;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 80%;
    padding: 10px;
    border: 1px solid #ffff;
    border-radius: 10px;
    font-size: 16px;
    /* margin-left : 2rem; */

}

select {
    width: 84%;
    padding: 10px;
    border: 1px solid #ffff;
    border-radius: 10px;
    font-size: 16px;
}
button {
    background-color: #19eefd;
    border: none;
    border-radius: 4px;
    color: black;
    cursor: pointer;
    font-size: 16px;
    padding: 10px 20px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #267b81;
    color: white;
}

p {
    margin-top: 20px;
    color: #fff;
}

a {
    text-decoration: none;
    color: aqua;
}

/* a:hover {
    text-decoration: underline;
} */
</style>
</html>