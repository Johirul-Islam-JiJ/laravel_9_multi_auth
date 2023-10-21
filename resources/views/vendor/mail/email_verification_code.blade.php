@extends('layouts.mail')

@section('content')
    <p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">hey,</p>
    <p style="font-weight: 700; font-size: 20px; margin-top: 0; --text-opacity: 1; color: #7367f0; ">{{ $name }}</p>
    <p style="margin: 0 0 24px;">
        a request to verify your
        <span style="font-weight: 600;">Seller Advertise</span> account -
        <a href="#" class="hover-underline" style="--text-opacity: 1; color: #7367f0;  text-decoration: none;">{{ $email }}</a></p>
    <h4 style="color: #002752">verification code: {{ $verification_code }}</h4>

    <table style="font-family: 'Montserrat',Arial,sans-serif;" role="presentation">
        <tr>
            <td style="mso-padding-alt: 16px 24px; --bg-opacity: 1; background-color: #7367f0;  border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;" bgcolor="rgba(115, 103, 240, var(--bg-opacity))">
                <a type="button" style="display: block; font-weight: 600; font-size: 14px; line-height: 100%; padding: 16px 24px; --text-opacity: 1; color: #ffffff; text-decoration: none;">{{ $verification_code }}</a>
            </td>
        </tr>
    </table>
    <p style="margin: 24px 0;">
        <span style="font-weight: 600;">note:</span> this code are valid for 1 hour from the time it was sent to you and can be used for verifying your account.
    </p>
@endsection
