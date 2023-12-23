@props(['disabled' => false, 'type' => 'text', 'placeholder' => ''])

@php
    $classes = ($disabled ?? false)
                ? 'bg-light-bg-secondary dark:dark-bg-primary text-light-text-primary dark:text-dark-text-primary'
                : 'rounded shadow-sm bg-light-bg-primary dark:bg-dark-bg-primary text-light-text-primary dark:text-dark-text-primary focus:outline-none focus:ring-4 ring-offset-2 ring-offset-light-bg-primary dark:ring-offset-dark-bg-primary focus:ring-light-accent dark:focus:ring-dark-accent';

    switch($type) {
        case 'file':
           $additionalClasses=' text-md cursor-pointer';
            break;
        case 'text':
            $additionalClasses=' pl-2';
            break;
        case 'password':
            $additionalClasses=' pl-2';
            break;
        default:
            $additionalClasses='';
            break;
    }

    $classes .= $additionalClasses
@endphp

<input {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['type' => $type, 'class' => $classes, 'placeholder' => $placeholder]) }}>