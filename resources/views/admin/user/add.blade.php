@extends('layouts.admin.app')

@section('content')
    <div class="my-5">
        <div class="container mx-auto max-w-xl shadow py-4 px-10">
            @if (session()->has('error'))
                <div class="bg-red-500 text-black px-4 py-2">
                    {{ session('error') }}
                </div>
            @endif
            <div class="my-3">
                <h1 class="text-center text-3xl font-bold">Create Product</h1>
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-2 ">
                        <label for="name" class="text-md font-bold">Name</label>
                        <input type="text" name="name"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="email" class="text-md font-bold">Email</label>
                        <input type="email" name="email"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="role" class="text-md font-bold">Role</label>
                        <select name="role"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                            <option value="admin" selected>Admin</option>
                        </select>
                        @error('role')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                        <div class="my-2 ">
                            <label for="password" class="text-md font-bold">Password</label>
                            <input type="password" name="password"
                                class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                                id="">
                            @error('password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                            <button class="px-5 py-1 bg-emerald-500 rounded-md text-black text-lg shadow-md">Save</button>
                            <a href="{{ route('user.index') }}"
                                class="px-5 py-2 bg-red-500 rounded-md text-white text-lg shadow-md">Go
                                Back</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
