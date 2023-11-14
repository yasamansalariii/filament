<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'alias' => null,
    'class' => '',
    'icon' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'alias' => null,
    'class' => '',
    'icon' => null,
]); ?>
<?php foreach (array_filter(([
    'alias' => null,
    'class' => '',
    'icon' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $icon = ($alias ? \Filament\Support\Facades\FilamentIcon::resolve($alias) : null) ?: $icon;
?>

<?php if(is_string($icon)): ?>
    <?php echo e(svg($icon, $class, array_filter($attributes->getAttributes()))); ?>
<?php else: ?>
    <div <?php echo e($attributes->class($class)); ?>>
        <?php echo e($icon ?? $slot); ?>

    </div>
<?php endif; ?>
<?php /**PATH C:\Users\Sadaf\Desktop\new_fila\vendor\filament\support\src\/../resources/views/components/icon.blade.php ENDPATH**/ ?>