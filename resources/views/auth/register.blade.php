@extends('layouts.app')

@section('login')
    <div class="flex flex-col justify-center items-center h-full">
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-1/6 mb-8" />
        <div class="bg-white rounded-md w-1/2 h-3/4 m-5 p-5">
            <form method="POST" action="{{ route('register') }}" class="flex flex-col justify-around h-full">
                @csrf

                <div class="flex flex-col items-center justify-evenly w-full mb-4">
                    <div class="flex flex-col items-center mb-4 w-full">
                        <input type="name" class="bg-slate-200 rounded border-none w-1/2 p-3" id="name"
                            name="name" placeholder="Nombre" required />
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col items-center mb-4 w-full">
                        <input type="email" class="bg-slate-200 rounded border-none w-1/2 p-3" id="email"
                            name="email" placeholder="Email" required />
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col items-center mb-4 w-full">
                        <input type="password" class="bg-slate-200 rounded border-none w-1/2 p-3" id="password"
                            name="password" placeholder="Contraseña" required />
                        @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col items-center mb-4 w-full">
                        <input type="password" class="bg-slate-200 rounded border-none w-1/2 p-3"
                            id="password-confirmation" name="password_confirmation" placeholder="Confirmar contraseña"
                            required />
                        @error('password_confirmation')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit"
                        class="primary-button rounded text-white text-pretty p-2 w-1/5">Registrarse</button>
                </div>
                <div class="flex flex-col items-center text-primary">
                    <span class="text-xl">¿Ya tienes cuenta?</span>
                    <a href="{{ route('login') }}" class="font-bold text-xl mb-5 hover:text-blue-500 hover:underline">Inicia
                        Sesión</a>
                </div>
            </form>
        </div>
    </div>
@endsection
