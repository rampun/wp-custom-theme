# WP Custom Theme

WP Custom theme is a wordpress custom theme

## Installation

Clone the project or download zip.



## Directory Structure
```
wp-custom-theme/
├─ lib/
│  ├─ inc/
│  │  ├─ ....
│  │  ├─ helpers.php
│  │  ├─ hooks.php
│  │  ├─ ....
├─ node_modules/
├─ resources/
│  ├─ assets/
│  │  ├─ src/
│  │  │  ├─ js/
│  │  │  ├─ sass/
│  ├─ ...../
├─ template-parts/
│  ├─ ....
├─ .gitignore
├─ style.css
├─ package.json
├─ README.md

```


## Customize the frontend.
First you should get Nodejs installed on your machine.

```bash
# Navigate to theme directory
cd wp-content/themes/custom-theme

# Install the dependencies
npm install

# Start the dev 
npm run start

# Build the assets for production
npm run build

```
  - Customize webpack
  - Include scripts into WordPress
 
## Setup the theme.
  - Declare navigations
  - Declare widget areas (sidebars)
 
## Customize templates
  - Customize the base template
  - Customize the template parts
    - Index views (index.php, archive.php, search.php)
    - Single views (single.php, page.php)

## Inspired by

* Genese