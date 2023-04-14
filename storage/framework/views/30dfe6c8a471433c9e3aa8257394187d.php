<div class="m-1">
    <div class="text-right mb-1 w-full">
        <span class="text-indigo-500">Total rows persisted [<b><?php echo e($fileContent->count()); ?></b>] </span>
    </div>

    <?php $__currentLoopData = $quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div>
            <div class="flex space-x-1">
                <span class="font-bold text-blue italic">"<?php echo e($quote['quote']); ?>"</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="text-gray">by:</span>
                <span class="font-bold text-green"><?php echo e($quote['author']); ?></span>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH /Users/mariacatalinabeznea/wdd/workshop-laravel-zero/resources/views/table-content.blade.php ENDPATH**/ ?>