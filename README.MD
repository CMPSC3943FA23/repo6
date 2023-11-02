# Hobby Harmony  
Hobby Harmony is a generalized asset tracker for personal use within the context of any hobby that involves a large collection.  
One of its key features will eventually be its generic and customizable nature, but at the beginning, it's likely going to be designed around retro computing hardware.  
## A note on Bootstrap use  
For consistency's sake, it is recommended to use the version of Bootstrap 5 included in our repository.  
You can include it like this:  
```html
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="bootstrap/js/bootstrap.min.js"></script>
```
Other versions of Bootstrap 5 will probably work fine, but using the one included in our repository will help things run a bit faster and maximize consistency between different pages.  
## File Prefix Explanation  
### `create_`  
Forms for creating new database entries.  
### `db_`  
These files manipulate or access the database directly, and are intended for internal or development use.  
The final product will only make limited use of these files.  
### `edit_`  
Forms for editing existing database entries.  
### `retr_`  
Scripts that retrieve information from the database.  
### `show_`  
Pages that display data.  
### `submit_`  
Scripts that add new information to the database.  
## File Index  
### `/bootstrap/`
The Bootstrap library and all of its files, for use by Hobby Harmony.  
### `/config/`  
Configuration files for Hobby Harmony and its various features.  
#### `/config/db_cfg.default.php`  
Database connection settings.  
### `/include/`  
PHP include files for common elements across multiple pages.  
### `/prototype/`  
A pseudo-functional prototype, mainly for Bootstrap 5 syntax reference.  
Go here if you need to see how Bootstrap-based pages are written.  
### `/sql/`  
Some SQL working files.  
None of these serve a functional purpose in the finished product.  
### `/create_asset.html`  
Used to be `/asset_create.html`, but has been changed to a less ambiguous naming convention.  
This is the asset creation form. It submits to `submit_asset.php`, which then sends the data to the database.  
### `/bootstrap-example.html`  
A very simple HTML page that also serves as Bootstrap 5 reference.  
### `/db_init.php`  
A script to create the database and its tables.  
### `/db_view.html`  
This page will render the current database contents.  
It is read-only and is not intended to be used in the final product.  
### `/retr_assets.php`  
Used to be `/asset_list.php`, but has been changed to a less ambiguous naming convention.  
Pulls a list of every asset from the database and returns it as JSON.  
This script is intended to be requested via AJAX.  
### `retr_categories.php`  
Pulls a list of user-defined categories and returns it as JSON.  
### `/submit_asset.php`  
Used to be `/asset_submit.php`, but has been changed to a less ambiguous naming convention.
Send HTML form submissions to this script to add them to the database.  