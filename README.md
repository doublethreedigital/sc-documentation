![Banner](https://raw.githubusercontent.com/doublethreedigital/sc-docs.doublethree.digital/master/banner.png)

## Documentation

This repository contains the source code & content for the Simple Commerce documentation site, available at [sc-docs.doublethree.digital](https://sc-docs.doublethree.digital).

## Contributing

If you wish to contribute to the documentation, either for a typo or to fix a small design bug, please submit a pull request. All contributions are welcome (I'm only one person after all!).

The content of the documentation lives in `content/collections/docs`. The `docs` directory has a sub-directory for each version of Simple Commerce. When contributing, please update the latest version of the documentation.

The front-end of the site lives in the `resources/views` directory. The site uses Tailwind CSS and Alpine.js.

## Local Development

1. Fork this repository
2. Run `composer install` to install Composer dependencies
3. Install and compile front-end assets with `npm install && npm run dev`
4. And copy over your new `.env` file... `cp .env.example .env && php artisan key:generate`

## Versioned Docs

You might have noticed that the docs site is split up into versions. This means we can have different versions of documentation for the different versions of Simple Commerce. To allow for this, the site uses Statamic's Multi-site feature, where each version has it's own 'site'.

Here's a checklist for when I need to create a new version of the docs:

* [ ] Create new site in `config/statamic/sites.php`
* [ ] In the CP, copy over all the entries needed for the new version.
* [ ] In the `routes/web.php` file, replace `v2.x` with the new version name.
* [ ] Find and replace for any references to the previous version.
* [ ] Submit a pull request to Algolia DocSearch for new version
* [ ] Add the new version to the front-end version selector
