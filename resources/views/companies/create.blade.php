@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center p-12">
    <div class="mx-auto w-full max-w-[550px]">
        <div class="bg-white shadow-md rounded my-6 p-5">
            <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label
                        for="CName"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Name
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="CName"
                        placeholder="Company Name"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    />
                </div>
                <div class="mb-5">
                    <label
                        for="guest"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Email
                    </label>
                    <input
                            type="email"
                            name="email"
                            id="email"
                            placeholder="email@gmail.com"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                </div>
                <div class="mb-5">
                    <label
                        for="guest"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Logo
                    </label>
                    <input
                            type="file"
                            name="logo"
                            id="logo"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                </div>
                <div class="mb-5">
                    <label
                        for="guest"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Website
                    </label>
                    <input
                            type="text"
                            name="website"
                            id="website"
                            placeholder="https://website.com"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                </div>
                <div class="flex flex-wrap">
                    <div>
                        <button
                            type="submit"
                            class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection