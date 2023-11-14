<?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $getFieldWrapperView()] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\DynamicComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['field' => $field,'class' => 'relative z-0']); ?>
	<?php
		$textareaID = 'tiny-editor-' . str_replace(['.', '#', '$'], '', $getId());
	?>

    <div
		x-data="{ state: $wire.<?php echo e($applyStateBindingModifiers("\$entangle('{$getStatePath()}')")); ?>, initialized: false }"
		x-load-css="[<?php echo \Illuminate\Support\Js::from(\Filament\Support\Facades\FilamentAsset::getStyleHref('tiny-css', package: 'amidesfahani/filament-tinyeditor'))->toHtml() ?>]"
        x-load-js="[<?php echo \Illuminate\Support\Js::from(\Filament\Support\Facades\FilamentAsset::getScriptSrc($getLanguageId(), package: 'amidesfahani/filament-tinyeditor'))->toHtml() ?>]"
        x-init="(() => {
            $nextTick(() => {
				tinymce.init({
					selector: '#<?php echo e($textareaID); ?>',
					language: '<?php echo e($getInterfaceLanguage()); ?>',
					language_url: 'https://cdn.jsdelivr.net/npm/tinymce-i18n@23.10.9/langs6/<?php echo e($getInterfaceLanguage()); ?>.min.js',
					directionality: '<?php echo e($getDirection()); ?>',
					
					toolbar_sticky: <?php echo e($getToolbarSticky() ? 'true' : 'false'); ?>,
					toolbar_sticky_offset: 64,
					statusbar: false,
					promotion: false,
		
					max_height: <?php echo e($getMaxHeight()); ?>,
					min_height: <?php echo e($getMinHeight()); ?>,

					<?php if($darkMode() == 'media'): ?>
					skin: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : ''),
					content_css: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : ''),
					<?php elseif($darkMode() == 'class'): ?>
					skin: (document.querySelector('html').getAttribute('class').includes('dark') ? 'oxide-dark' : 'oxide'),
					content_css: (document.querySelector('html').getAttribute('class').includes('dark') ? 'dark' : 'default'),
					<?php elseif($darkMode() == 'force'): ?>
					skin: 'oxide-dark',
					content_css: 'dark',
					<?php elseif($darkMode() == false): ?>
					skin: 'oxide',
					content_css: 'default',
					<?php else: ?>
					skin: (window.matchMedia('(prefers-color-scheme: dark)').matches || document.querySelector('html').getAttribute('class').includes('dark') ? 'oxide-dark' : 'oxide'),
					content_css: (window.matchMedia('(prefers-color-scheme: dark)').matches || document.querySelector('html').getAttribute('class').includes('dark') ? 'dark' : 'default'),
					<?php endif; ?>

					plugins: '<?php echo e($getPlugins()); ?>',
		
					toolbar: '<?php echo e($getToolbar()); ?>',
					toolbar_mode: 'sliding',
		
					menubar: <?php echo e($getShowMenuBar() ? 'true' : 'false'); ?>,
					menu: {
						file: { title: 'File', items: 'newdocument restoredraft | preview | export print | deleteallconversations' },
						edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall | searchreplace' },
						view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen | showcomments' },
						insert: { title: 'Insert', items: 'image link media addcomment pageembed template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor tableofcontents | insertdatetime' },
						format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat' },
						tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | a11ycheck code wordcount' },
						table: { title: 'Table', items: 'inserttable | cell row column | advtablesort | tableprops deletetable' },
						help: { title: 'Help', items: 'help' }
					},
		
					relative_urls: <?php echo e($getRelativeUrls() ? 'true' : 'false'); ?>,
					remove_script_host: <?php echo e($getRemoveScriptHost() ? 'true' : 'false'); ?>,
					convert_urls: <?php echo e($getConvertUrls() ? 'true' : 'false'); ?>,
		
					setup: function (editor) {
						if(!window.tinySettingsCopy) {
                            window.tinySettingsCopy = [];
                        }

                        if (!window.tinySettingsCopy.some(obj => obj.id === editor.settings.id)) {
                            window.tinySettingsCopy.push(editor.settings);
                        }

						editor.on('blur', function(e) {
							state = editor.getContent()
						});
		
						editor.on('init', function(e) {
							if (state != null) {
							    editor.setContent(state)
							}
						});
		
						editor.on('OpenWindow', function(e) {
							target = e.target.container.closest('.fi-modal')
							if (target) target.setAttribute('x-trap.noscroll', 'false')
						});
		
						editor.on('CloseWindow', function(e) {
							target = e.target.container.closest('.fi-modal')
							if (target) target.setAttribute('x-trap.noscroll', 'isOpen')
						});

						function putCursorToEnd() {
                            editor.selection.select(editor.getBody(), true);
                            editor.selection.collapse(false);
                        }

						$watch('state', function(newstate) {
                            if (editor.container && newstate !== editor.getContent()) {
                                editor.resetContent(newstate || '');
                                putCursorToEnd();
                            }
                        });
					},

					images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                        if (!blobInfo.blob()) return

						const finishCallback = () => {
							$wire.getFormComponentFileAttachmentUrl('<?php echo e($getStatePath()); ?>').then((url) => {
								if (!url) {
									reject('error')
									return
								}
								resolve(url)
							})
						}

						const errorCallback = () => {}

						const progressCallback = (e) => {
							progress(e.detail.progress)
						}

						$wire.upload(`componentFileAttachments.<?php echo e($getStatePath()); ?>`, blobInfo.blob(), finishCallback, errorCallback, progressCallback)
                    }),

					automatic_uploads: true,
					<?php echo e($getCustomConfigs()); ?>

				});
            });
        })()"
        x-cloak
        wire:ignore
    >
        <?php if (! ($isDisabled())): ?>
			<input
                id="<?php echo e($textareaID); ?>"
				type="hidden"
                x-ref="tinymce"
                placeholder="<?php echo e($getPlaceholder()); ?>"
            >
        <?php else: ?>
            <div
                x-html="state"
                class="block w-full max-w-none rounded-lg border border-gray-300 bg-white p-3 opacity-70 shadow-sm transition duration-75 prose dark:prose-invert dark:border-gray-600 dark:bg-gray-700 dark:text-white"
            ></div>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>

<?php if (! $__env->hasRenderedOnce('91c5354a-0dd5-4cf2-9a19-896690d5341c')): $__env->markAsRenderedOnce('91c5354a-0dd5-4cf2-9a19-896690d5341c');
$__env->startPush('scripts'); ?>
<script>
window.addEventListener('beforeunload', (event) => {
    if (tinymce.activeEditor.isDirty()) {
        event.preventDefault();
		// Included for legacy support, e.g. Chrome/Edge < 119
		event.returnValue = '<?php echo e(__("Are you sure you want to leave?")); ?>';
    }
});
</script>
<?php $__env->stopPush(); endif; ?><?php /**PATH C:\Users\Sadaf\Desktop\new_fila\vendor\amidesfahani\filament-tinyeditor\src\/../resources/views/tiny-editor.blade.php ENDPATH**/ ?>