<?php if(file_exists(public_path($styleFile = 'vendor/artisan-gui/gui.js'))): ?>
    <script defer src="<?php echo e(asset($styleFile)); ?>"></script>
<?php else: ?>
    <script defer>
        <?php include $guiRoot . '/stubs/js/gui.js'; ?>
    </script>
<?php endif; ?><?php /**PATH G:\dev\PlantManager\backend\vendor\infureal\artisan-gui/resources/views/partials/scripts.blade.php ENDPATH**/ ?>