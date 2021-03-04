## project

- Project is getting data from the gov API and is saving the CSV file to local storage Y/m/d structure folders.
- Filename is being generated by using the UNIXTIMESTAMP to avoid duplicate filenames. 
- Once downloaded, the CSV file is being parsed and saved into the DB

## Command line call

- The command:
```sh
path/to/php artisan job:getdata
```
