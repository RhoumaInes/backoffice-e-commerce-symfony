<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerMSqNXIE\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerMSqNXIE/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerMSqNXIE.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerMSqNXIE\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerMSqNXIE\App_KernelDevDebugContainer([
    'container.build_hash' => 'MSqNXIE',
    'container.build_id' => 'f027f35b',
    'container.build_time' => 1739207906,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerMSqNXIE');
