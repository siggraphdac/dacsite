# New DAC Site
This is a repo for a storing a new WordPress installation for the SIGGRAPH DAC. The wp_data and db_data allows for persistent storage. Most importantly, the WordPress theme used here is located in **wp_data/wp-content/themes/dacsite**.

## Requirements

- [Git](https://git-scm.com/)
- [Docker](https://git-scm.com/)

### On Mac
Install Homebrew: 
```bash
/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
```

Install Git
```bash
brew install git
```

Install Docker
```bash
brew install docker
```

### On Windows
Just download the Git and Docker executables from the requirements links above and use the included "Git BASH" to run the following commands. 

## Running
Download the **dacsite** repository from GitHub.

```bash
git clone https://github.com/siggraphdac/dacsite
```

Move into the **dacsite** directory.

```bash
cd dacsite
```

Make sure Docker is running, then start a Docker Swarm.

```bash
docker swarm init
```
Afterwards, deploy the WordPress stack.

```bash
docker stack deploy dacsite -c stack.yml
```

Finally, you should be able to open a browser window and navigate to http://127.0.0.1:8080.

Optionally, if you have docker-compose installed you can use: 

```bash
docker-compose -f stack.yml up -d
```

Then use the following helpful commands to manage.

- `docker-compose down`
- `docker-compse ps`
- `docker-compose logs -f`


## Editing
If you use Visual Studio Code you can run the following to open up a new session.

```bash
code .
```

The theme and plugins used are under the wp-content in the wp_data directory.

## Upgrading or Modifying the Stack
If you are updating the Wordpress stack file volume settings run:

```bash
docker service rm dacsite_wordpress && docker volume rm dacsite_wp_data && docker stack deploy dacsite -c stack.yml
```

If you are upgrading or modifying the Wordpress or MySQL do the following to completely rebuild the stack:

- `docker service rm dacsite_mysql`
- `docker service rm dacsite_wordpress`
- `docker volume rm dacsite_db_data`
- `rm -rf wp_data/*`
- `docker stack deploy dacsite -c stack.yml --with-registry-auth`

Or all in one command:

```bash
docker swarm leave --force && rm -rf wp_data/* && docker volume prune && docker swarm init && docker stack deploy dacsite -c stack.yml
```

## Troubleshooting
On a Mac, to see what what files exist within a volume use the following to start up a new container and mount the volumes folder from the Docker Virtual Machine.

`docker run --rm -it -v /var/lib/docker/volumes:/docker -w="/docker" alpine:latest sh`

Enable debugging for wordpress:

`define( 'WP_DEBUG', true );`

## To Do 

See here: https://docs.google.com/document/d/1MGRi53u1CFQJFQCkJc3RUtYT83Rg7vH42fousrdK-c8