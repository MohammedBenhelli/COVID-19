<div class="max-w-xs">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="http://localhost/MVC_PiePHP/cinema/modifyRequest">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="mail">
                New Mail
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-red-700 leading-tight focus:outline-none focus:shadow-outline" name="mail" type="text" placeholder="{{ $mail }}">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                New Password
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-red-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" type="password">
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Confirm Password
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-red-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="passwordConf" type="password">
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Modify
            </button>
        </div>
    </form>
</div>
