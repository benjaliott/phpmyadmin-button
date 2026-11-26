<x-filament-panels::page>
    @php($url = \Benjaliott\PhpMyAdminButton\PhpMyAdminButtonPlugin::getPhpMyAdminUrl())

    @if ($url !== null)
        <div>
            <x-filament::button
                tag="a"
                :href="$url"
                target="_blank"
                rel="noopener noreferrer"
            >
                Open phpMyAdmin
            </x-filament::button>
        </div>
    @else
        <p>phpMyAdmin has not been configured. Contact your panel administrator.</p>
    @endif
</x-filament-panels::page>