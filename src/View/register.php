<form action="/MVC_PiePHP/registerRequest" method="post">
    <div class="container mx-auto">
        <div class="grid grid-cols-6">
            <label for="email"><b>Email</b>
                <input  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="text" placeholder="Enter Email" name="email" required>
            </label>
            <label for="password"><b>Password</b>
                <input pattern="{6,}$" type="password" placeholder="Enter Password" name="password" required>
            </label>
            <label for="passwordConf"><b>Password Confirmation</b>
                <input pattern="{6,}$" type="password" placeholder="Retype Password" name="passwordConf" required>
            </label>
            <button class="bg-orange-500 hover:bg-orange-400  text-white font-bold py-2 px-4 rounded-full" type="submit">register</button>
        </div>
    </div>
</form>
