<?php

namespace App\Providers\Filament;

use Filament\Panel;
use Filament\Actions\Action;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;

class AdminPanelProvider extends PanelProvider
{
  public function panel(Panel $panel): Panel
  {
    return $panel
      ->default()
      ->id('admin')
      ->path('admin')
      ->viteTheme('resources/css/filament/admin/theme.css')
      ->login()
      ->colors([
        'primary' => Color::Amber,
      ])
      ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
      ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
      ->pages([
        Dashboard::class,
      ])
      ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
      ->widgets([
        AccountWidget::class,
        FilamentInfoWidget::class,
      ])
      ->middleware([
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        AuthenticateSession::class,
        ShareErrorsFromSession::class,
        VerifyCsrfToken::class,
        SubstituteBindings::class,
        DisableBladeIconComponents::class,
        DispatchServingFilamentEvent::class,
      ])
      ->authMiddleware([
        Authenticate::class,
      ])
      ->userMenuItems([
        'profile' =>  fn(Action $action) => $action
          ->label(auth()->user()->name)
          ->url(fn(): string => EditProfilePage::getUrl())
          ->icon('heroicon-m-user-circle'),
      ])
      ->plugins([
        FilamentEditProfilePlugin::make()
          ->slug('profile')
          ->setTitle('My Profile')
          ->setNavigationLabel('My Profile')
          ->setNavigationGroup('Setting')
          ->setIcon('heroicon-o-user')
          ->setSort(10)
          ->shouldRegisterNavigation(true)
          ->shouldShowDeleteAccountForm(false)
          ->shouldShowSanctumTokens(false)
          ->shouldShowBrowserSessionsForm()
          ->shouldShowAvatarForm(
            value: true,
            directory: 'avatars',
            rules: 'mimes:jpeg,png|max:1024'
          )
      ]);
  }
}
