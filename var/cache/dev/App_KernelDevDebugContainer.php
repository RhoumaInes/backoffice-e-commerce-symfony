<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerOv5cxIs\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerOv5cxIs/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerOv5cxIs.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerOv5cxIs\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerOv5cxIs\App_KernelDevDebugContainer([
    'container.build_hash' => 'Ov5cxIs',
    'container.build_id' => '8d2bbd93',
    'container.build_time' => 1726412174,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerOv5cxIs');
