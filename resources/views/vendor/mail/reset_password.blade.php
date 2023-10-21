@extends('layouts.mail')
@section('content')
<p style="font-weight: 600; font-size: 18px; margin-bottom: 0;">Hey,</p>
<p style="font-weight: 700; font-size: 20px; margin-top: 0; --text-opacity: 1; color: #7367f0; ">{{ $name }}</p>
<p style="margin: 0 0 24px;">
    A request to reset password was received from your
    <span style="font-weight: 600;">Sources</span> Account .</p>
<p style="margin: 0 0 24px;">Use this link to reset your password and login.</p>
<a href="{{$link}}" style="display: block; font-size: 14px; line-height: 100%; margin-bottom: 24px; --text-opacity: 1; color: #7367f0; text-decoration: none;">{{$link}}</a>
<table style="font-family: 'Montserrat',Arial,sans-serif;" role="presentation">
    <tr>
        <td style="mso-padding-alt: 16px 24px; --bg-opacity: 1; background-color: #7367f0;  border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;" bgcolor="rgba(115, 103, 240, var(--bg-opacity))">
            <a href="{{$link}}" style="display: block; font-weight: 600; font-size: 14px; line-height: 100%; padding: 16px 24px; --text-opacity: 1; color: #ffffff; text-decoration: none;">Reset Password &rarr;</a>
        </td>
    </tr>
</table>
<p style="margin: 24px 0;">
    <span style="font-weight: 600;">Note:</span> This link is valid for 1 hour from the time it was sent to you and can be used to change your password only once.
</p>
@endsection
