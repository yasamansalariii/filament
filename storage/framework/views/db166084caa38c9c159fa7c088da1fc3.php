<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.layout.base','data' => ['livewire' => $livewire]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-panels::layout.base'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['livewire' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($livewire)]); ?>
    <?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
        'after' => null,
        'heading' => null,
        'subheading' => null,
    ]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
        'after' => null,
        'heading' => null,
        'subheading' => null,
    ]); ?>
<?php foreach (array_filter(([
        'after' => null,
        'heading' => null,
        'subheading' => null,
    ]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

    <div class="fi-simple-layout flex min-h-screen items-center">
        <?php if(filament()->auth()->check()): ?>
            <div
                class="absolute end-0 top-0 flex h-16 items-center gap-x-4 pe-4 md:pe-6 lg:pe-8"
            >
                <?php if(filament()->hasDatabaseNotifications()): ?>
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(Filament\Livewire\DatabaseNotifications::class, ['lazy' => true]);

$__html = app('livewire')->mount($__name, $__params, 'bz0KDpW', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                <?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.user-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-panels::user-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="fi-simple-main-ctn w-full">
            <main
                class="fi-simple-main mx-auto my-16 w-full bg-white px-6 py-12 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 sm:max-w-lg sm:rounded-xl sm:px-12"
            >
                <?php echo e($slot); ?>

            </main>
        </div>

        <?php echo e(\Filament\Support\Facades\FilamentView::renderHook('panels::footer')); ?>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Sadaf\Desktop\new_fila\vendor\filament\filament\src\/../resources/views/components/layout/simple.blade.php ENDPATH**/ ?>