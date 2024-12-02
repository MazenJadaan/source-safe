@extends('layouts.app')

@section('title', 'All Files')

@section('content')

<div class="p-3 bg-sky-500 w-16 h-16 rounded-full 
            shadow-lg flex items-center justify-center 
            cursor-pointer hover:bg-sky-700 active:bg-sky-700 
            transition duration-200 ms-1
            fixed bottom-2 "
            onclick="openForm()">
    <p class="text-center text-3xl font-bold text-slate-50">
        <i class="fa-solid fa-arrow-up-from-bracket"></i>
    </p>
</div>

<div>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A corporis qui ipsa illo sit molestias explicabo vitae nostrum porro iusto eum ipsam quia ea deleniti, repellendus hic itaque facere impedit.</p>
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
            cursor-pointer hover:bg-red-700	active:bg-sky-700 
            transition duration-200 ms-1
            fixed top-2 right-2"
            onclick="openForm()">
    <p class="text-center text-3xl font-bold text-slate-50">
        <i class="fa-solid fa-xmark"></i>
    </p>
</div>
    <div class="flex flex-col items-center">
        <i class="fa-solid fa-upload text-white text-9xl p-5"></i>
        <p class="font-mono font-semibold text-black text-xl">Upload File</p>
    </div>

    <form class="w-2/3 flex flex-col space-y-4">

        <label class="text-white font-bold" for="file"> Upload Your File Here:</label>
        <input  type="file" 
                id="file" 
                name="file" 
                class="p-2 rounded bg-white text-gray-700"
        >
        
        <label class="text-white font-bold" for="group">Choose The Group:</label>
                <select id="group" 
                        name="group_id" 
                        class="p-2 rounded bg-white text-gray-700"
                >
                    <option value="group1">group1</option>
                    <option value="group2">group2</option>
                    <option value="group3">group3</option>
                </select>
        
                <label class="text-white font-bold" for="status">Choose Status Of The File:</label>
                <select id="status" 
                        name="status" 
                        class="p-2 rounded bg-white text-gray-700"
                >
                    <option value="active">Free</option>
                    <option value="inactive">Reserved</option>
                </select>

                <button type="submit" class="w-20 bg-green-500 hover:bg-green-600 text-white p-2 rounded">
                    Upload
                </button>
        </form>
    </div>
</div>

<script>
    function openForm() {
        const modal = document.getElementById('fileModal');
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
</script>

@endsection