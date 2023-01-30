@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center p-12">
    <div class="mx-auto w-full max-w-[550px]">
        <div class="bg-white shadow-md rounded my-6 p-5">
            <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                @csrf
                {{ method_field('PATCH') }}
                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                        <label
                            for="fName"
                            class="mb-3 block text-base font-medium text-[#07074D]"
                        >
                            First Name
                        </label>
                        <input
                            type="text"
                            name="first_name"
                            id="fName"
                            placeholder="First Name"
                            value="{{ $employee->first_name }}"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                        <label
                            for="lName"
                            class="mb-3 block text-base font-medium text-[#07074D]"
                        >
                            Last Name
                        </label>
                        <input
                            type="text"
                            name="last_name"
                            id="lName"
                            placeholder="Last Name"
                            value="{{ $employee->last_name }}"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <label
                        for="guest"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Company
                    </label>
                    <select name="company_id" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}" {{  $employee->company_id === $company->id ? 'selected' : ''}}>{{ $company->name }}</option>
                        @endforeach
                    </select>
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
                            value="{{ $employee->email }}"
                            placeholder="email@gmail.com"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                </div>
                <div class="mb-5">
                    <label
                        for="guest"
                        class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Phone
                    </label>
                    <input
                            type="text"
                            name="phone"
                            id="phone"
                            value="{{ $employee->phone }}"
                            placeholder="Last Name"
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