@extends('layouts.app')

@section('title', 'All Files')

@section('content')
    @include('components.alert.AlertMessages')

    <div class="p-3 bg-sky-500 w-16 h-16 rounded-full mb-5 ms-5
            shadow-lg flex items-center justify-center
            cursor-pointer hover:bg-sky-700 active:bg-sky-700
            transition duration-200 ms-1
            fixed bottom-2 "
         onclick="openForm()">
        <p class="text-center text-3xl font-bold text-slate-50">
            <i class="fa-solid fa-arrow-up-from-bracket"></i>
        </p>
    </div>

    <div id="backdrop" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-md z-5"></div>

    <div id="fileModal"
         class="p-8 bg-sky-700 rounded-md mt-36 mx-auto
    md:w-1/2 md:h-1/2 lg:w-96 lg:h-96 xl:w-2/4 xl:h-4/6
    fixed inset-0 flex items-center justify-between shadow-lg
    transform scale-0 opacity-0 transition-all duration-300 z-10"
    >
        <div class="p-3 bg-sky-500 w-16 h-16 rounded-full
        shadow-lg flex items-center justify-center
        cursor-pointer hover:bg-red-700 active:bg-sky-700
        transition duration-200 ms-1
        fixed top-2 right-2"
             onclick="openForm()">
            <p class="text-center text-3xl font-bold text-slate-50">
                <i class="fa-solid fa-xmark"></i>
            </p>
        </div>
        <div class="flex flex-col items-center">
            <i class="fa-solid fa-upload text-white text-9xl p-5"></i>
            <p class="font-mono font-semibold text-xl" style="color: white">Upload File</p>
        </div>

        <form action="{{route('file.store')}}" method="POST" enctype="multipart/form-data" class="w-2/3 flex flex-col space-y-4" id="fileForm">
            @csrf

            <label class="text-white font-bold" for="file">Upload Your File Here:</label>
            <input
                type="file"
                id="file"
                name="file"
                class="p-2 rounded bg-white text-gray-700"
            >
            @error('file')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <label class="text-white font-bold" for="file_name">File Name:</label>
            <input
                type="text"
                id="file_name"
                name="name"
                placeholder="Enter file name"
                class="p-2 rounded bg-white text-gray-700"
            >
            @error('name')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <label class="text-white font-bold" for="group">Choose The Group:</label>
            <select
                id="group"
                name="group_id"
                class="p-2 rounded bg-white text-gray-700"
            >
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
            @error('group_id')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <label class="text-white font-bold">File Status:</label>
            <div class="flex items-center space-x-4">
                <span class="text-white">Free</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input
                        type="checkbox"
                        id="statusSwitch"
                        class="sr-only peer"
                    >
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:bg-green-500 transition duration-200"></div>
                    <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition peer-checked:translate-x-full"></span>
                </label>
                <span class="text-white">Reserved</span>
            </div>
            <input type="hidden" name="status" id="statusInput" value="free">
            @error('status')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

            <div class="d-flex justify-content-center mt-5">
                <button
                    type="submit"
                    class="w-20 bg-green-500 hover:bg-green-600 text-white p-2 rounded"
                >
                    Upload
                </button>
            </div>
        </form>
    </div>



    <script>
        document.getElementById('statusSwitch').addEventListener('change', function () {
            const statusInput = document.getElementById('statusInput');
            if (this.checked) {
                statusInput.value = 'reserved';
            } else {
                statusInput.value = 'free';
            }
        });
    </script>



    <script>
        function openForm() {
            const modal = document.getElementById('fileModal');
            const backdrop = document.getElementById('backdrop');

            // Check if the modal is hidden or visible
            if (modal.classList.contains('scale-0')) {
                modal.classList.remove('scale-0', 'opacity-0');
                modal.classList.add('scale-100', 'opacity-100');
                backdrop.classList.remove('hidden');
            } else {
                modal.classList.remove('scale-100', 'opacity-100');
                modal.classList.add('scale-0', 'opacity-0');
                backdrop.classList.add('hidden');
            }
        }

        // Check if there are validation errors after form submission
        window.onload = function() {
            if ({{ $errors->any() ? 'true' : 'false' }}) {
                openForm(); // Open modal if there are validation errors
            }
        };
    </script>

@endsection
