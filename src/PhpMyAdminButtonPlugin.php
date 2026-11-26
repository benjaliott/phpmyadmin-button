<?php

namespace Benjaliott\PhpMyAdminButton;

use App\Contracts\Plugins\HasPluginSettings;
use Filament\Contracts\Plugin;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Panel;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class PhpMyAdminButtonPlugin implements Plugin, HasPluginSettings
{
    public function getId(): string
    {
        return 'phpmyadmin-button';
    }

    public function register(Panel $panel): void
    {
        if ($panel->getId() !== 'server') {
            return;
        }

        $panel->discoverPages(
            plugin_path($this->getId(), 'src/Filament/Server/Pages'),
            'Benjaliott\\PhpMyAdminButton\\Filament\\Server\\Pages'
        );
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function getSettingsFormData(): array
    {
        return ['phpmyadmin_url' => self::getPhpMyAdminUrl()];
    }

    public function getSettingsForm(): array
    {
        return [
            TextInput::make('phpmyadmin_url')
                ->label('phpMyAdmin URL')
                ->placeholder('https://db.example.com/phpmyadmin/')
                ->helperText('Use an HTTPS URL without credentials or login tokens.')
                ->required()
                ->rules(['url:https'])
                ->maxLength(2048),
        ];
    }

    public function saveSettings(array $data): void
    {
        $url = trim((string) ($data['phpmyadmin_url'] ?? ''));

        if (! self::isValidUrl($url)) {
            throw ValidationException::withMessages([
                'phpmyadmin_url' => 'Enter a valid HTTPS URL without credentials.',
            ]);
        }

        $path = self::settingsPath();
        File::ensureDirectoryExists(dirname($path));
        File::replace($path, $url);

        Notification::make()
            ->title('phpMyAdmin URL saved')
            ->success()
            ->send();
    }

    public static function getPhpMyAdminUrl(): ?string
    {
        $path = self::settingsPath();

        if (! File::isFile($path) || ! File::isReadable($path)) {
            return null;
        }

        $url = trim(File::get($path));

        return self::isValidUrl($url) ? $url : null;
    }

    private static function settingsPath(): string
    {
        return storage_path('app/phpmyadmin-button/url.txt');
    }

    private static function isValidUrl(string $url): bool
    {
        if (strlen($url) > 2048 || filter_var($url, FILTER_VALIDATE_URL) === false) {
            return false;
        }

        $parts = parse_url($url);

        return is_array($parts)
            && strtolower($parts['scheme'] ?? '') === 'https'
            && ! empty($parts['host'])
            && ! array_key_exists('user', $parts)
            && ! array_key_exists('pass', $parts);
    }
}