Sequoia Capital Base Theme
===

Base Theme is a custom basic WordPress theme, which includes foundation basic grid system and some basic customizer settings which are required in almost all projects.

### Base theme is compatible with

1. Simple WordPress single site
2. WordPress Multisite (Sub-dir and Sub-domain)
3. WordPress-VIP-Go
4. WordPress / WordPress VIP-Go coding standards
5. PHP autoloader
6. Following standard Namespacing
7. Assets build using Webpack
8. Dynamic POT file generation

Base Theme Structure
---------------

```bash
.
├── assets              # Theme Assets
│   ├── build           # Build Assets
│   │   ├── css
│   │   └── js
│   ├── fonts           # Custom Fonts
│   │   └── open-sans
│   └── src
│       ├── js
│       └── sass
├── inc
│   ├── classes         # Theme main functions
│   │   ├── post-types  # Register custom post types
│   │   └── taxonomies  # Register custom taxonomies
│   ├── helpers         # Helper functions
│   └── traits          # Traits
├── languages           # Pot file
├── page-templates      # Custom page templates
└── template-parts      # Template parts
```

Getting Started
---------------

### Prerequisite

Please make sure you installed below software/packages/tools globally before moving forward,

1. Dart Sass - https://sass-lang.com/install
2. PHPCS - https://github.com/squizlabs/PHP_CodeSniffer
3. WordPress Coding Standards - https://github.com/WordPress/WordPress-Coding-Standards
4. VIP Coding Standard (for WP VIP project only) - https://github.com/Automattic/VIP-Coding-Standards

After cloning repo run following command,

```bash
npm install

# if throw error in console, try below command
npm install --legacy-peer-deps
```

#### Compile Assets

```
npm run dev       # During development
npm run prod      # Generate production ready minified assets
```

#### Other Commands

```bash
# Generate pot files
npm run pot

# Lint CSS, JS and PHP
npm run lint:css
npm run lint:js
```

#### Theme Standards

Check the code quality for the current theme.
Run following command from theme directory `wp-content/themes/base-theme/`

```bash
# Test with default phpcs.xml file config
phpcs --standard=phpcs.xml ./

# Test against VIP Coding Standard
phpcs -d memory_limit=1024M --standard=WordPress-VIP-Go,WordPressVIPMinimum -s --ignore=vendor,node_modules,tests,apigen,predis,build ./
```

_Cheers!_ 👍
