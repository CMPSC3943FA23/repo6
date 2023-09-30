# Hobby Harmony  
Hobby Harmony is a generalized asset tracker for personal use within the context of any hobby that involves a large collection.  
One of its key features will eventually be its generic and customizable nature, but at the beginning, it's likely going to be designed around retro computing hardware.  
## A note on Bootstrap use  
For consistency's sake, it is recommended to use the version of Bootstrap 5 included in our repository.  
This includes `bootstrap/css/bootstrap.min.css` and `bootstrap/js/bootstrap.min.js`.  
Other versions will probably work fine, but using the one included in our repository will help things run a bit faster and maximize consistency between different pages.  
## File Index  
### `/bootstrap/`
The Bootstrap library and all of its files, for use by Hobby Harmony.  
### `/config/`  
Configuration files for Hobby Harmony and its various features.  
#### `/config/db_cfg.default.php`  
Database connection settings.  
### `/prototype/`  
A pseudo-functional prototype, mainly for Bootstrap 5 syntax reference.  
### `/sql/`  
Some SQL working files.  
None of these serve a functional purpose in the finished product.  
### `/asset_submit.php`  
Direct form submissions to this script to add them to the database.  
### `/bootstrap-example.html`  
A very simple HTML page that also serves as Bootstrap 5 reference.  
### `/db_init.php`  
A script to create the database and its tables.  
### `/db_view.php`  
This page will render the current database contents.  
It's read-only and is not intended to be used in the final product.