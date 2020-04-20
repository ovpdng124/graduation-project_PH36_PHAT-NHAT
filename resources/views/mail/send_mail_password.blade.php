<div class="container" style="text-align: center">
    <h3>Hi, {{$user->full_name}}</h3>
    <p>It seems you forgot your login details. A request to reset your password has been received. For security reasons the initial password cannot be sent over email, you must reset it.</p>
    <p><a href="{{route('password-reset-form', ['email' => $user->email])}}">Please click here to reset your password</a></p>
    <br>

    <p>If you did not initiate this password request, please ignore the message. It's often a good security measure to change your password often and avoid using the same password on several accounts. Why you received this notification? It's possible another user entered your email address or username by mistake. If you have a company account, you might want to check if one of your colleagues did not reset the password.</p>
</div>
