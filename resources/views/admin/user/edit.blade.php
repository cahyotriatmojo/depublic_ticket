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
                <h1 class="text-center text-3xl font-bold">Update User</h1>
                <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                    <div class="mb-2">
                        <label for="name" class="font-medium text-sm text-slate-600 dark:text-slate-400">Name</label>
                        <input type="text" id="name" name="name"
                            class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                            required="" value="{{ $user->name }}">
                    </div>
                    <div class="mb-2">
                        <label for="email" class="font-medium text-sm text-slate-600 dark:text-slate-400">Email</label>
                        <input type="email" id="email" name="email"
                            class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                            required="" value="{{ $user->email }}">
                    </div>
                    <div class="mb-2">
                        <label for="role" class="font-medium text-sm text-slate-600 dark:text-slate-400">Role</label>
                        <select id="role" name="role"
                            class="form-select w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700"
                            required="">
                            <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                            {{-- <option value="user" @if ($user->role == 'user') selected @endif>User</option> --}}
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="password"
                            class="font-medium text-sm text-slate-600 dark:text-slate-400">Password</label>
                        <input type="password" id="password" name="password"
                            class="form-input w-full rounded-md mt-1 border border-slate-300/60 dark:border-slate-700 dark:text-slate-300 bg-transparent px-3 py-1 focus:outline-none focus:ring-0 placeholder:text-slate-400/70 placeholder:font-normal placeholder:text-sm hover:border-slate-400 focus:border-primary-500 dark:focus:border-primary-500  dark:hover:border-slate-700">
                    </div>
                    <button class="px-5 py-1 bg-emerald-500 rounded-md text-black text-lg shadow-md">Save</button>
                            <a href="{{ route('user.index') }}"
                                class="px-5 py-2 bg-red-500 rounded-md text-white text-lg shadow-md">Go
                                Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
