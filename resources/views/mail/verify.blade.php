<div class="container" style="text-align: center">
    <h1 >WELCOME TO BOOTIE SHOES</h1>
    <h4>-----------***----------- </h4>
    <h2>Hello, {{$user->full_name}}!</h2>
    <p>Thank you for your interest and visit our store. To verify your email and complete your Bootie Shop account, please click the link below!</p>

    <h3>Click Link To Verify:</h3>
    <p><a style="text-align: center" href="{{route('verify', ['verify_token' => $user->verify_token])}}">{{route('verify', ['verify_token' => $user->verify_token])}}</a></p>
    <br>

    <p style="color: #ff422c; font-weight: bold">This link will expire 48 hours after this email was sent.</p><br>
    <p><i>If you have trouble with clicking the link, you can also copy and paste it into your web browser's address bar.</i></p>
</div>
