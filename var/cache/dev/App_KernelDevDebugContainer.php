<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container5mBK0qs\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container5mBK0qs/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container5mBK0qs.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container5mBK0qs\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container5mBK0qs\App_KernelDevDebugContainer([
    'container.build_hash' => '5mBK0qs',
    'container.build_id' => '1fb7b4e0',
    'container.build_time' => 1724784196,
], __DIR__.\DIRECTORY_SEPARATOR.'Container5mBK0qs');
