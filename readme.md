# Installation

- Clone `git clone https://github.com/abdullahalnahhal/simpleSys`.
- `composer install`.
- Copy `.env (copy).example` file to be `.env`.
- `php artisan key:generate`.
- open your `.env` file then set the DB configuration :
	- `DB_DATABASE`
	- `DB_USERNAME`
	- `DB_PASSWORD`
- `php artisan migrate:fresh --seed`
- >There May be issue in file streaming so :
	- `sudo chmod -R 777 ../simpleSys`
- >There may be issue in enabling the rewrite mode So:
	- `sudo a2enmod rewrite`
	- `sudo systemctl restart apache2`

# Usage

- There Two Users With Two Roles Only
	>Super Admin : which can control all actions
	- **Name** : Super Admin.
	- **Email** : sadmin@admin.com.
	- **Password** : admin.
	- >User : Which can control on updating his info and view others only
		- **Name** : Simple User.
		- **Email** : user@admin.com.
		- **Password** : user.

## Over View

You Will see side bar with dashboard and users that shows the users list

## Contents

### Resources And Views

- There Two Directories in `resources/views`.
	- >`app` : which contains the core files of the app ( pages ).
		- Each page has a directory, while each page has main scripts[ form - index - view ].
	- >`layout`: which contains layouts and frequent files such as [ footer - header - tables - dropdowns - ... etc ]>
## Files
- **App/Http/Controllers** : Which Has controllers [ HomeController - UsersControllers ].
- **App/Http/Requests** : Which has requests validations [UsersRequest - UsersUpdateRequests].
- **App/Models** : Which has  DB Models [ Roles ].
- **App/Policies** : Which has user authorization policies for users action.
- **App/helpers** : Which has common methods that used through app.
- **routes/web** : routing the non authenticated or general routes.
- **routes/users** : routing the users routes.
