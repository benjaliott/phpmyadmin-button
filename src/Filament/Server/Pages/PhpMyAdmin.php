<?php

namespace Benjaliott\PhpMyAdminButton\Filament\Server\Pages;

use Filament\Pages\Page;

class PhpMyAdmin extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'tabler-database';

    protected static ?string $navigationLabel = 'phpMyAdmin';

    protected static ?string $title = 'phpMyAdmin';

    protected static ?int $navigationSort = 90;

    protected string $view = 'phpmyadmin-button::filament.server.pages.php-my-admin';
}
