# Showilist
> Your show tracking pal 

This is my final project for my dev class. <br>
Showilist is built on Laravel 12 and Livewire 3, and the data is powered by <u><a href="themoviedb.org">themoviedb.org</a></u> <br>
The goal for this project was to build a simple and responsive way to manage what shows you are watching, being able to add them to your list, apply statuses to the show and to give a star rating 1-10 based on what you think <br>

# Installing / Getting started

## Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- Any Laravel supported database
- A TMDB API key

## Installation steps

### **Clone the repo**
```bash
git clone https://github.com/TBB-Marcus/Showilist.git
cd Showilist
```

### **Install PHP & JavaScript dependencies**
```bash
composer install
npm install
```

### **Copy the environment file and set your variables**
```bash
cp .env.example .env
```
Here its important to set the TMDB_READ_ACCESS_TOKEN and your API key <br>
You also need to do the common Laravel things like setting up your database and putting the credentials into the .env

### **Generate an application key**
```bash
php artisan generate
```

### **Run database migrations**
```bash
php artisan migrate
```

> Congrats! you have now installed the project

# Starting the development server
To start the development server you need to serve the website through artisan, and you need to need to start the node development server
```bash
php artisan serve
```
In a different console, run:
```bash
npm run dev
```
<br>

# Features
What can showilist do?
- Dynamically retrieve shows from the TMDB Api, letting you know whats trending at the moment
- Store a unique list per user of their TV Shows, this feature comes with an array of statuses:
    - Planning
    - Watching
    - Paused
    - Completed
    - Dropped
- Rate shows 1-10
- Filter your showlist based on status
- Find new shows to watch throught he embedded rating from TMDB letting you know whats good
<br>

# Links
- Project homepage: https://github.com/TBB-Marcus/Showilist
- Clone link: https://github.com/TBB-Marcus/Showilist.git
- themovidedb: https://www.themoviedb.org/
- Issue tracker: https://github.com/TBB-Marcus/Showilist/issues
