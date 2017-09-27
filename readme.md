# Wearables Research - PHP Web Server

# Deployment
* Push your changes to the remote repository (GitHub):
```
$ git push origin <branch_name>
```
* SSH into `context-aware.sandbox.csun.edu`
```
$ ssh <your_username>@context-aware.sandbox.csun.edu
```
* From your user root, switch to the webserver folder:
```
$ cd /var/www/html
```
* Switch to the root user. You'll be prompted for your password:
```
$ sudo su
```
* Pull from the remote repository. It is currently named `origin`. You'll be prompted for your GitHub login:
```
$ git pull origin <branch_name>
```
