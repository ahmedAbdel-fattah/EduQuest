<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100" style="background: linear-gradient(45deg, #6e17ac, #f30e97);">
    <div>
        {{ $logo }}
        {{-- <img src="{{asset('img/icon/register.png')}}" alt="" style="width: 100px;"> --}}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" >

        {{ $slot }}
    </div>
    <div>
        <a href="{{route('home')}}">
            <img src="{{asset('img/hero/logo.png')}}" alt="" style="width:250px;">
        </a>
    </div>
</div>
