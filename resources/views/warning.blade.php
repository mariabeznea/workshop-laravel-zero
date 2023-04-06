@props([
    'message'
])

<div class="flex space-x-1 text-center">
    <span class="text-white uppercase font-bold">Warning:</span> <p class="bg-yellow-700 text-black font-bold"> {{ $message }}</p>
</div>