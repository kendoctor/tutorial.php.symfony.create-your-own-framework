<?php $name = $request->get('name', 'world'); ?>

Hello <?php echo htmlspecialchars($name, ENT_QUOTES, 'utf-8'); ?>

