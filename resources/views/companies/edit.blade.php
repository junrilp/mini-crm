@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center p-12">
    <div class="mx-auto w-full max-w-[550px]">
        <div class="bg-white shadow-md rounded my-6 p-5">
            <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
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
                        value="{{ $company->name }}"
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
                            value="{{ $company->email }}"
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
                    @if(file_exists( public_path() . '/images/'.$company->logo))
                        <img src="{{ URL::asset('/images/'.$company->logo) }}"  class="h-20" />
                    @endif
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
                            value="{{ $company->website }}"
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