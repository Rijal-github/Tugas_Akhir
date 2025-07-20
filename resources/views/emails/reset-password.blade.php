<p>Halo,</p>

<p>Kami menerima permintaan untuk reset password Anda.</p>

<p>Silakan klik link di bawah ini untuk mengganti password:</p>

<p>
    <a href="{{ url('/change-password-email?email=' . urlencode($email) . '&token=' . $token) }}">
        Reset Password
    </a>
</p>

<p>Link ini berlaku selama 30 menit.</p>

<p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
