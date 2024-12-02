<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="css/all.min.css">


<div class="p-3 bg-sky-500 w-16 h-16 rounded-full 
            shadow-lg flex items-center justify-center 
            cursor-pointer hover:bg-sky-700 active:bg-sky-700 
            transition duration-200 ms-60
            fixed lg:bottom-2 md:bottom-24"
            onclick="openForm()">
    <p class="text-center text-lg font-bold	text-slate-50 select-none"> + </p>
</div>


<div id="fileModal" 
    class="p-5 bg-blue-200 rounded-md mt-36 mx-auto
    md:w-1/2 md:h-1/2 lg:w-64 lg:h-64 xl:w-2/4 xl:h-4/6 
    fixed inset-0 flex items-center justify-center shadow-lg 
    transform scale-0 opacity-0 transition-all duration-300">
    <i class="fa-solid fa-upload"></i>  
</div>

<script>
    function openForm() {
        const modal = document.getElementById('fileModal');
        if (modal.classList.contains('scale-0')) {
            modal.classList.remove('scale-0', 'opacity-0');
            modal.classList.add('scale-100', 'opacity-100');
        } else {
            modal.classList.remove('scale-100', 'opacity-100');
            modal.classList.add('scale-0', 'opacity-0');
        }
    }
</script>