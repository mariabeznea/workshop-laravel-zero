<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'message'
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'message'
]); ?>
<?php foreach (array_filter(([
    'message'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div class="flex space-x-1">
    <p class="bg-red-600 text-white"><?php echo e($message); ?></p>
</div><?php /**PATH /Users/mariacatalinabeznea/wdd/workshop-laravel-zero/resources/views/error.blade.php ENDPATH**/ ?>