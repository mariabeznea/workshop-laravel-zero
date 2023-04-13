<div class="m-1">
    <div class="text-right mb-1 w-full">
        <span class="text-indigo-500">Total rows persisted [<b>{{ $fileContent->count() }}</b>] </span>
    </div>

    @foreach($quotes as $quote)
        <div>
            <div class="flex space-x-1">
                <span class="font-bold text-blue italic">"{{ $quote['quote'] }}"</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="text-gray">by:</span>
                <span class="font-bold text-green">{{  $quote['author'] }}</span>
            </div>
        </div>
    @endforeach
</div>