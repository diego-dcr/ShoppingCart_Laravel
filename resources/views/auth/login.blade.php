@extends('layouts.app')

@section('login')
    <div class="flex flex-col justify-center items-center h-full">
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-1/6 mb-8" />
        <div class="bg-white rounded-md w-1/2 h-3/4 m-5 p-5">
            <form method="POST" action="{{ route('login') }}" class="flex flex-col justify-around h-full">
                @csrf

                <div class="flex flex-col items-center justify-evenly w-full mb-4">
                    <input type="email" class="bg-slate-200 rounded border-none w-1/2 p-3 mb-4" id="email"
                        name="email" placeholder="Email" required/>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    <input type="password" class="bg-slate-200 rounded border-none w-1/2 p-3 mb-4" id="password"
                        name="password" placeholder="Contraseña" required />
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="primary-button rounded text-white p-2 w-1/5">Ingresar</button>
                </div>
                <div class="flex flex-col items-center text-primary">
                    <span class="text-xl">¿Aún no tienes cuenta?</span>
                    <a href="{{ route('register') }}" class="font-bold text-xl mb-5 hover:text-blue-500 hover:underline">Regístrate</a>
                    <span>Diego Domingo Chacon Rivera | diego.dchaconr@gmail.com</span>
                </div>
            </form>
        </div>
    </div>
@endsection
