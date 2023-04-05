@props([
    'message'
])

<div class="flex space-x-1 mt-1">
    <span class="text-lime-500 font-bold">{{ $message }}</span>
    <span class="flex-1 content-repeat-[.] text-gray"></span>
</div>