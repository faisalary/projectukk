{{-- <x-mail::message>
    <h1> </h1>
    <div style="text-align: center;">
        <img src="">
    </div>
</x-mail::message> --}}


<!DOCTYPE html>
<html>
<head>
    <title>websitepercobaan.com</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <img class="image" style="border-radius: 0%; margin-left: 400px; width:430px;" src="{{ asset('front/assets/img/email_tahap.png')}}" alt="admin.upload">
    <p>{{ $details['body'] }}</p>
   
    <p>Thank you</p>
</body>
</html>


{{-- <x-mail::message>
  <div style="text-align: center;">
    <img src="{{ $message->embed($pathToFile) }}">
  </div>
  
  <h1 style="text-align: center; font-size:24px; color: #222;">Grace Period</h1>
  
  <p style="color: #222;">Hello <span style="color: #222; font-weight: 600;">{{ $user }}</span>, your user license have been inactive and now you are working within a grace period. There are <span style="color: #222; font-weight: 600;">7 days remaining</span> before the application will be closed permanently.</p>
  
  <p style="color: #4B465C;">To continue using the product, you must renew your license in order to continue work with Harmonie.</p>

  <p style="color: #4B465C;"><a href="#">Click Here</a> to renew your license or submit a ticket. </p>

<p style="color: #222; font-weight: 600;">Regards, <br>
Harmonie</p>

<x-mail::subcopy>
  <div style="text-align: center;">
    <a href="https://www.instagram.com/techno_infinity/"><img src="{{ $message->embed(public_path() . '/assets/app/img/icons/brands/instagram.png') }}" style="margin-right: 8px;"></a>
    <a href="https://www.linkedin.com/company/techno-infinity/"><img src="{{ $message->embed(public_path() . '/assets/app/img/icons/brands/linkedin.png') }}"></a>
  </div>
  <p style="text-align: center; color: #4B465C;">Copyright by PT Teknologi Nirmala Olah Daya Informasi (Techno Infinity)</p>  
</x-mail::subcopy>

</x-mail::message> --}}