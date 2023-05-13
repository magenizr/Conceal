[![Magenizr Plus](https://images2.imgbox.com/11/6b/yVOOloaA_o.gif)](https://account.magenizr.com)
---

# Conceal

Disable all customer export functions and mask personal information such as email and phone number.

![Magenizr Conceal - Backend](https://images2.imgbox.com/23/3e/OOXy6Aa5_o.png)

**Note**

A paid version with further security enhancements will be available early December, 2022.

## System Requirements

- Magento 2.3.x, 2.4.x
- PHP 5.6.x, 7.x

## Installation (Composer 2)

1. Update your composer.json `composer require "magenizr/magento2-conceal":"1.0.0" --no-update`
2. Use `composer update magenizr/magento2-conceal --no-install` to update your composer.lock file.

```
Updating dependencies
Lock file operations: 1 install, 1 update, 0 removals
  - Locking magenizr/magento2-conceal (1.0.0)
```

3. And then `composer install` to install the package.

```
Installing dependencies from lock file (including require-dev)
Verifying lock file contents can be installed on current platform.
Package operations: 1 install, 0 update, 0 removals
  - Installing magenizr/magento2-conceal (1.0.0): Extracting archive
```

4. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_Conceal --clear-static-content
php bin/magento setup:upgrade
```

## Installation (Manually)

1. Download the code.
2. Extract the downloaded tar.gz file. Example: `tar -xzf Magenizr_Conceal_1.0.0.tar.gz`.
3. Copy the code into `./app/code/Magenizr/Conceal/`.
4. Enable the module and clear static content.

```
php bin/magento module:enable Magenizr_Conceal --clear-static-content
```

## Features

* Mask email addresses and phone numbers in `Customers > All Customers`
* Disable table export in `Customers > All Customers`
* Disable export in `System > Data Transfer > Export`

## Usage

Enable or disable feature via console. By default it is enabled.

```
php bin/magento magenizr:conceal:config --status enable
php bin/magento magenizr:conceal:config --status disable
```

## Support
If you have any issues with this extension, open an issue on [GitHub](https://github.com/magenizr/Magenizr_AdminUser/issues).

## Purchase

This module is available for free on [GitHub](https://github.com/magenizr).

## Contact

Follow us on [GitHub](https://github.com/magenizr), [Twitter](https://twitter.com/magenizr)
and [Facebook](https://www.facebook.com/magenizr).

## History
===== 1.0.0 =====
* First release

## License

[OSL - Open Software Licence 3.0](https://opensource.org/licenses/osl-3.0.php)
