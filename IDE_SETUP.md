# IDE Setup & Configuration

This document explains how to configure your IDE for optimal PHP development with this Laravel 11 CMS project.

## Visual Studio Code Setup

### Recommended Extensions

The project includes extension recommendations in `.vscode/extensions.json`. Install them by:

1. Opening VS Code
2. Going to Extensions (Ctrl+Shift+X / Cmd+Shift+X)
3. Typing `@recommended` to filter recommended extensions
4. Click "Install Workspace Recommended Extensions"

**Key Extensions:**
- **Intelephense** - PHP code intelligence (primary)
- **PHP Debug** - XDebug integration for debugging
- **PHP DocBlocker** - Automatic PHP docblock generation
- **PHP Namespace Resolver** - PSR-4 namespace management
- **GitLens** - Git blame and history
- **Tailwind CSS IntelliSense** - CSS framework autocomplete

### Configuration Files

#### `.vscode/settings.json`
- Configures Intelephense for PHP 8.3
- Disables false-positive diagnostics
- Sets up formatting and completion rules
- Excludes vendor and build directories from analysis

#### `.vscode/launch.json`
- Enables XDebug debugging
- Configure your `php.ini` with:
  ```
  xdebug.mode = debug
  xdebug.start_with_request = yes
  xdebug.client_port = 9003
  ```

## Static Analysis

### PHPStan

PHPStan provides static code analysis without false positives.

```bash
# Run analysis
vendor/bin/phpstan analyse

# Generate or update baseline
vendor/bin/phpstan analyse --generate-baseline
```

**Configuration:** `phpstan.neon`
- Uses Larastan for Laravel-aware analysis
- Level 5 for balance between strictness and practicality
- Baseline file for ignoring known non-critical issues

### PHP CS Fixer

Format your code consistently.

```bash
# Check what will be fixed
vendor/bin/php-cs-fixer fix --dry-run

# Apply fixes
vendor/bin/php-cs-fixer fix
```

**Configuration:** `.php-cs-fixer.php`
- Follows PSR-12 standard
- Uses Laravel conventions
- Configured for the `app/`, `routes/`, `config/`, and `database/` directories

## IDE Helper Generation

The Laravel IDE Helper generates autocomplete hints for:
- Facades
- Eloquent models (with relationships and attributes)
- Container bindings

### Generate/Regenerate

```bash
# Generate main helper file
php artisan ide-helper:generate

# Generate model helpers with property hints
php artisan ide-helper:models --write

# Generate Eloquent models documentation
php artisan ide-helper:eloquent
```

These commands are automatically run after `composer install` and `composer update`.

**Generated Files:**
- `_ide_helper.php` - Main framework helper
- `app/Models/_ide_helper_Models.php` - Model-specific helpers (created in models folder)

## Troubleshooting Common Issues

### 1. Intelephense Not Finding Models/Classes

**Solution:**
- Regenerate IDE helpers: `php artisan ide-helper:models --write`
- Reload VS Code: Cmd+Shift+P → "Developer: Reload Window"
- Check that `_ide_helper.php` is in the project root
- Verify PHP 8.3 in `.vscode/settings.json`

### 2. False Positive Errors for Eloquent

**Why it happens:**
- Laravel uses dynamic method resolution for relationships
- `where()`, `get()`, `first()` are generated at runtime

**Solution:**
- These are already configured in `phpstan.neon` to be ignored
- Update baseline if new patterns emerge: `vendor/bin/phpstan analyse --generate-baseline`

### 3. Filament Admin Classes Not Recognized

**Solution:**
- Ensure Filament packages are properly installed
- Run: `php artisan filament:upgrade`
- Regenerate IDE helpers
- Clear PHP cache if applicable

### 4. Namespace Issues

**Solution:**
- Install PHP Namespace Resolver extension
- Use Cmd+Shift+P → "Sort Imports" to auto-organize namespaces
- Check that PSR-4 autoloading is correct in `composer.json`

### 5. IntelliSense Too Aggressive (Many Red Squiggles)

**Solution:**
- Reduce `intelephense.diagnostics.level` in `.vscode/settings.json` (currently set to 1)
- Disable specific diagnostics as needed:
  ```json
  "intelephense.diagnostics.undefinedVariables": false,
  "intelephense.diagnostics.undefinedMethods": false
  ```
- Note: This is already configured optimally in the project

## Code Quality Workflow

### Before Committing

```bash
# 1. Run static analysis
vendor/bin/phpstan analyse

# 2. Fix code style
vendor/bin/php-cs-fixer fix

# 3. Check Laravel conventions
php artisan lint

# 4. Commit only if all pass
git add .
git commit -m "your message"
```

### CI/CD Integration

The project can be integrated with CI/CD to run these checks automatically:

```yaml
# Example GitHub Actions workflow
- name: Run PHPStan
  run: vendor/bin/phpstan analyse

- name: Run PHP CS Fixer
  run: vendor/bin/php-cs-fixer fix --dry-run
```

## Environment-Specific Settings

### Development

- Intelephense diagnostics: Level 1 (minimal false positives)
- XDebug enabled for debugging
- IDE helpers regenerated frequently

### Production

- Use PHPStan in CI/CD pipeline
- Disable IDE helpers (they're only for development)
- Use PHP CS Fixer for code quality gates

## Additional Resources

- [Intelephense Documentation](https://intelephense.com/)
- [PHPStan Documentation](https://phpstan.org/)
- [Larastan Documentation](https://larastan.com/)
- [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper)
- [PHP CS Fixer](https://cs.symfony.com/)

## Notes

- The `.vscode/` directory is committed to ensure team consistency
- Make adjustments only if needed, and communicate with your team
- IDE helpers should be regenerated when models/facades change
